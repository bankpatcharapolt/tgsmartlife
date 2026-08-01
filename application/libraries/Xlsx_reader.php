<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Xlsx_reader.php — อ่านไฟล์ .xlsx แบบเบาๆ ไม่ต้องพึ่ง library ภายนอก (ไม่ต้องมี Composer/
 * PhpSpreadsheet) ใช้ ZipArchive + SimpleXML ที่ PHP มีในตัวอยู่แล้ว (ต้องเปิด extension
 * zip กับ xml/simplexml ในเซิร์ฟเวอร์ — ปกติเปิดอยู่แล้วโดย default เกือบทุกที่)
 *
 * รองรับ: sheet แรกของไฟล์เท่านั้น, ค่าตัวหนังสือ/ตัวเลข/shared string/inline string
 * ไม่รองรับ: สูตรคำนวณที่ซับซ้อน, หลาย sheet, การจัดรูปแบบ/สไตล์
 */
class Xlsx_reader {

    /**
     * อ่านไฟล์ .xlsx คืนค่าเป็น array 2 มิติ [แถว][คอลัมน์] (0-indexed ทั้งคู่)
     * แถว/คอลัมน์ที่ไม่มีข้อมูลจะเป็น string ว่าง '' ไม่ใช่ null เพื่อให้ใช้งานง่ายขึ้น
     * โยน Exception ถ้าเปิด/อ่านไฟล์ไม่ได้ (ให้ผู้เรียกใช้ try/catch เอง)
     */
    public function read($file_path) {
        if (!class_exists('ZipArchive')) {
            throw new Exception('เซิร์ฟเวอร์นี้ไม่ได้เปิดใช้งาน PHP extension "zip" กรุณาติดต่อผู้ดูแลระบบ');
        }

        $zip = new ZipArchive();
        if ($zip->open($file_path) !== TRUE) {
            throw new Exception('ไม่สามารถเปิดไฟล์ .xlsx ได้ (ไฟล์อาจเสียหายหรือไม่ใช่ไฟล์ .xlsx จริง)');
        }

        // 1) sharedStrings.xml — ตารางข้อความที่ใช้ซ้ำ (ไฟล์ที่มีแต่ตัวเลขอาจไม่มีไฟล์นี้เลย)
        $shared = [];
        $sharedXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedXml !== FALSE) {
            $sharedObj = @simplexml_load_string($sharedXml, 'SimpleXMLElement', LIBXML_NOCDATA);
            if ($sharedObj !== FALSE && isset($sharedObj->si)) {
                foreach ($sharedObj->si as $si) {
                    if (isset($si->t)) {
                        $shared[] = (string) $si->t;
                    } else {
                        // rich text แบบมีหลาย run (<r><t>...) ต้องต่อข้อความจากทุก run
                        $text = '';
                        if (isset($si->r)) {
                            foreach ($si->r as $r) { $text .= (string) $r->t; }
                        }
                        $shared[] = $text;
                    }
                }
            }
        }

        // 2) หาไฟล์ sheet แรก
        $sheetPath = $this->_first_sheet_path($zip);
        if (!$sheetPath) {
            $zip->close();
            throw new Exception('ไม่พบ sheet ในไฟล์ .xlsx');
        }
        $sheetXml = $zip->getFromName($sheetPath);
        $zip->close();
        if ($sheetXml === FALSE) {
            throw new Exception('ไม่สามารถอ่านข้อมูล sheet ได้');
        }

        $sheetObj = @simplexml_load_string($sheetXml, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($sheetObj === FALSE || !isset($sheetObj->sheetData)) {
            throw new Exception('รูปแบบไฟล์ sheet ไม่ถูกต้อง');
        }

        $rows = [];
        foreach ($sheetObj->sheetData->row as $rowXml) {
            $rowIndex = ((int) $rowXml['r']) - 1; // เลขแถวใน xlsx นับจาก 1
            if ($rowIndex < 0) { continue; }
            $rowData = [];
            foreach ($rowXml->c as $cellXml) {
                $ref = (string) $cellXml['r']; // เช่น "C5"
                if ($ref === '') { continue; }
                $colIndex = $this->_col_letter_to_index($ref);
                $type = (string) $cellXml['t']; // 's'=shared string, 'inlineStr', '' หรืออื่นๆ = ตัวเลข/สูตร

                if ($type === 's') {
                    $idx = (int) $cellXml->v;
                    $value = $shared[$idx] ?? '';
                } elseif ($type === 'inlineStr') {
                    $value = isset($cellXml->is->t) ? (string) $cellXml->is->t : '';
                } elseif (isset($cellXml->v)) {
                    $value = (string) $cellXml->v;
                } else {
                    $value = '';
                }
                $rowData[$colIndex] = $value;
            }
            $rows[$rowIndex] = $rowData;
        }

        if (empty($rows)) { return []; }

        // เติมช่องว่างให้ครบเป็นตาราง 2 มิติสี่เหลี่ยมผืนผ้า (แถว/คอลัมน์ที่ไม่มีข้อมูลใน xml
        // จะไม่มี key อยู่ ต้องเติม '' ให้เอง ไม่งั้น index จะเลื่อนไม่ตรงคอลัมน์จริง)
        $maxCol = 0;
        foreach ($rows as $r) {
            if (!empty($r)) { $maxCol = max($maxCol, max(array_keys($r))); }
        }
        $maxRow = max(array_keys($rows));

        $result = [];
        for ($r = 0; $r <= $maxRow; $r++) {
            $line = [];
            for ($c = 0; $c <= $maxCol; $c++) {
                $line[$c] = $rows[$r][$c] ?? '';
            }
            $result[] = $line;
        }
        return $result;
    }

    private function _first_sheet_path($zip) {
        if ($zip->locateName('xl/worksheets/sheet1.xml') !== FALSE) {
            return 'xl/worksheets/sheet1.xml';
        }
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);
            if (preg_match('#^xl/worksheets/sheet\d+\.xml$#', $name)) {
                return $name;
            }
        }
        return null;
    }

    private function _col_letter_to_index($ref) {
        preg_match('/^([A-Z]+)/', $ref, $m);
        $letters = $m[1] ?? 'A';
        $col = 0;
        for ($i = 0; $i < strlen($letters); $i++) {
            $col = $col * 26 + (ord($letters[$i]) - ord('A') + 1);
        }
        return $col - 1;
    }
}
