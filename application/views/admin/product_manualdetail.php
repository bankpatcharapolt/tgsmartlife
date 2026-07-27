 <!----  Content ------>
 <style>
     /* Sortable */
 </style>
 <div class="clearfix"></div>
 <div class="col-md-12 col-sm-12  ">
     <div class="x_panel">
         <div class="x_title">
             <h2>เอกสาร/คู่มือสินค้า</h2>
             <input name="base_url" value="<?= base_url(); ?>" type="hidden">
            
             <div class="clearfix"></div>
         </div>

         <div class="x_content">
             <div class="table-responsive">
                 <table id="table" class="table table-striped jambo_table bulk_action sorted_table" style="width:100%; border-spacing: 1px !important;">
                     <thead>
                         <tr class="headings">
                             <th class="column-title" style="width: 1%;">ลำดับ</th>
                             <th class="column-title" style="width: 2%;"></th>
                                <th class="column-title" style="width: 11%;">หมวดหมู่</th>
                             <th class="column-title" style="width: 11%;">รหัสสินค้า</th>
                           
                             <th class="column-title" style="width: 11%;">สินค้า</th>
                             <th class="column-title" style="width: 10%;">เอกสาร/คู่มือสินค้า</th>



                             <th class="column-title no-link last" style="text-align: center;width: 2%;"></th>
                         </tr>
                     </thead>
                     <tbody></tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>

<div class="modal fade" id="editManualModal" tabindex="-1" role="dialog" aria-labelledby="editManualModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editManualModalLabel">แก้ไข/เพิ่มคู่มือสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <form id="productManualForm">
        <input type="hidden" id="product_id_input" name="product_id"> 

        <div class="form-group">
            <h4>เอกสาร/คู่มือสินค้า</h4>
            
            <div id="specCheckboxes">
                <div class="form-check">
    <input class="form-check-input spec-item" style="margin-top:0px;" type="checkbox" 
           value="1" 
           id="specShowStatus" 
           name="is_show_specdetail_status"> 
    <label class="form-check-label" for="specShowStatus">
        ปิด/เปิดใช้งาน (เพื่อให้แสดงผลในหน้าบ้าน)
    </label>
</div>
                
                <h5>กำหนดหัวข้อและรายละเอียดคู่มือ(ใส่ link)</h5>

                <div id="dynamic-fields-container">
                    <div class="form-row input-group mb-2 dynamic-input-row" data-index="0">
                        </div>
                </div>


            </div>
        </div>
    </form>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveSpecBtn">บันทึกการเปลี่ยนแปลง</button>
            </div>
        </div>
    </div>
</div>
 <!---- End Content ------>

 <script>
     var base_url = $('input[name="base_url"]').val();
     drawtable(base_url);



     function drawtable(base_url) {
         var results = get_results(base_url);
         if (results.datas.length > 0) {
             var tr = '';
             $.each(results.datas, function(key, val) {

                 var no = key + 1;
                 tr += '<tr class="even pointer" sort-id="' + val.id + '">';
                 tr += '<td class="a-center " style="vertical-align: inherit;">' + no + '</td>';

                 var imgs = (val.thumnal != '') ? base_url + val.thumnal + '?random=' + Math.random() : base_url + '/uploaded/DocumentTh.png';
                 tr += '<td style="vertical-align: inherit;padding: .2rem;"> <img class="thumnails-premise img-add" src="' + imgs + '" alt="image" style="border: unset; width: 100%;" /></td>';
                         tr += '<td style="vertical-align: inherit;">' + val.cate_name + '</td>';
                 tr += '<td style="vertical-align: inherit;">' + val.productcode + '</td>';
            
                 tr += '<td style="vertical-align: inherit;">' + val.name + '</td>';
              
               
                tr += '<td style="vertical-align: inherit; font-size: 12px;">' + (val.manual_details_html || '-') + '</td>'; 
           

                 tr += '<td class="" style="text-align: center;vertical-align: inherit;">';
                 tr += '<ul class="" style="list-style: none; display: inline-flex; margin-bottom: 0rem; min-width: auto; padding-inline: 0px;">';
                 //tr += '<li><a href="'+base_url+'admin_productdetail_spec_edit/'+val.id+'" class="btn btn-round btn-warning" style="font-size: 11px; padding: 4px 8px;" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';

                 tr += '<li><a href="#" class="btn btn-round btn-warning edit-spec-btn" style="font-size: 11px; padding: 4px 8px;" data-toggle="modal" data-target="#editManualModal" data-id="' + val.id + '" title="แก้ไข"><i class="fa fa-wrench"></i></a></li>';

                 tr += '</ul>';
                 tr += '</td>';
                 tr += '</tr>';
             });
             var tableid = '#table';
             $(tableid + ' tbody').html(null);
             $(tableid + ' tbody').append(tr);
             $(tableid).dataTable({
                 destroy: true,
                 lengthMenu: [
                     [50, 100],
                     [50, 100],
                 ],
                 "aoColumnDefs": [{
                         "bSortable": false,
                         "aTargets": [6]
                     },
                   
                 ]
             });
         }
     }

     function get_results(base_url) {
         var res = null;
         $.ajax({
             url: base_url + 'admin/Product/get_product_manual_detail',
             data: '', //ส่งตัวแปร
             type: "POST",
             dataType: 'json',
             async: false,
             success: function(data, status) {
                 res = data;
             },
             error: function(xhr, status, exception) {
                 //console.log(xhr);
             }
         });
         return res;
     }

  
 </script>


 <script>
     var fieldIndex = 0; // ตั้งค่าตัวนับเริ่มต้น

// ฟังก์ชันสำหรับสร้าง HTML ของ Input Field คู่ใหม่
function createNewFieldRow(index, specId = '', title = '', detail = '') {
    // เพิ่ม hidden input สำหรับเก็บ spec ID (สำหรับข้อมูลเก่า)
    var isNew = specId === '' ? 'style="display:none;"' : ''; 
    var removeStyle = $('.dynamic-input-row').length <= 0 ? 'style="display:none;"' : ''; // ซ่อนปุ่มลบเริ่มต้น

    return `
        <div class="form-row input-group mb-2 dynamic-input-row" data-index="${index}" data-spec-id="${specId}">
            <input type="hidden" class="spec-id-input" name="specs[${index}][id]" value="${specId}">
            <div class="col-5">
                <input type="text" class="form-control spec-title" name="specs[${index}][title]" placeholder="หัวข้อ (เช่น สี)" value="${title}">
            </div>
            <div class="col-6">
                <input type="text" class="form-control spec-detail" name="specs[${index}][detail]" placeholder="รายละเอียด (เช่น แดง, น้ำเงิน)" value="${detail}">
            </div>
            <div class="col-1 input-group-append">
                <button class="btn btn-success add-field-btn" type="button"><i class="fa fa-plus"></i></button>
                <button class="btn btn-danger remove-field-btn" type="button" ${removeStyle}><i class="fa fa-trash"></i></button> 
            </div>
        </div>
    `;
}

// ฟังก์ชันเสริมสำหรับควบคุมปุ่มลบ
function updateRemoveButtonVisibility() {
    if ($('.dynamic-input-row').length > 1) {
         $('.remove-field-btn').show();
    } else {
         $('.remove-field-btn').hide();
    }
}



function loadAndPopulateManual(productId, base_url) {
    // 1. ล้าง Field Index และ Container
    fieldIndex = 0; 
    $('#dynamic-fields-container').empty();

    // 2. ดึงข้อมูลจากเซิร์ฟเวอร์
    $.ajax({
        url: base_url + 'admin/Product/getProductManual', 
        data: { "product_id": productId },
        type: "POST",
        dataType: 'json',
        success: function(response) {
            var specsData = response.specs_data;
            var isChecked = response.is_checked == 1;
            $('#specShowStatus').prop('checked', isChecked); 
            if (response.specs_data && specsData.length > 0) {
            
                $.each(specsData, function(i, spec) {
                    var newRow = createNewFieldRow(i, spec.id, spec.title, spec.detail);
                    $('#dynamic-fields-container').append(newRow);
                    fieldIndex = i + 1; 
                });
            }
            
     
            var emptyRow = createNewFieldRow(fieldIndex);
            $('#dynamic-fields-container').append(emptyRow);
            fieldIndex++;
            
        
            updateRemoveButtonVisibility();

        },
        error: function() { 
            alert('ไม่สามารถดึงคู่มือสินค้าเก่าได้');
     
            var initialRow = createNewFieldRow(fieldIndex);
            $('#dynamic-fields-container').append(initialRow);
            fieldIndex++;
            updateRemoveButtonVisibility();
        }
    });
}
     

     $('#editManualModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var productId = button.data('id'); // ดึง Product ID จากปุ่ม
    var modal = $(this);

    $('#productManualForm')[0].reset(); 
    $('#dynamic-fields-container').empty(); 

  
    modal.find('#product_id_input').val(productId);
    modal.find('.modal-title').text('แก้ไขคู่มือสำหรับสินค้า ID: ' + productId);

    loadAndPopulateManual(productId, base_url);

});


$(document).on('click', '.add-field-btn', function() {
    var newRow = createNewFieldRow(fieldIndex);
    $('#dynamic-fields-container').append(newRow);
    fieldIndex++; 
    updateRemoveButtonVisibility();
});

// **ปรับปรุง Logic ปุ่มลบ (Remove Field)**
$(document).on('click', '.remove-field-btn', function() {
    $(this).closest('.dynamic-input-row').remove();
    // ไม่ต้องอัปเดต fieldIndex เพราะ index ไม่ได้เรียงตามลำดับแล้ว แต่จะส่งทั้งหมดไปให้เซิร์ฟเวอร์จัดการ
    updateRemoveButtonVisibility();
});

$('#saveSpecBtn').on('click', function() {
   var productId = $('#productManualForm #product_id_input').val(); 
    var specsArray = [];
    
   if (!productId || productId.trim() === '') {
        alert('เกิดข้อผิดพลาด: ไม่พบรหัสสินค้า (Product ID) โปรดลองเปิด Modal ใหม่อีกครั้ง');
        return; // หยุดการทำงานถ้าไม่มี Product ID
    }

   
    $('.dynamic-input-row').each(function() {
        var title = $(this).find('.spec-title').val();
        var detail = $(this).find('.spec-detail').val();

        if (title.trim() !== '' || detail.trim() !== '') {
            specsArray.push({
                title: title,
                detail: detail
            });
        }
    });

    console.log('Product ID:', productId);
    console.log('Specifications Data (for AJAX):', specsArray);

    // 5. ส่งข้อมูล specsArray ไปยัง AJAX
    var isShowStatus = $('#specShowStatus').is(':checked') ? 1 : 0;
 
    $.ajax({
        url: base_url + 'admin/Product/save_dynamic_manual', // URL ไปยัง PHP Controller
        data: {
            "product_id": productId,
            "specifications": specsArray,
            "is_show_manualdetail_status": isShowStatus
        },
        type: "POST",
        dataType: 'json',
        success: function(response) {
             if(response.status === 'success') {
                alert('บันทึกคู่มือสินค้าเรียบร้อย');
                $('#editManualModal').modal('hide');
                drawtable(base_url);
              
             } else {
                alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' + response.message);
             }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            alert('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
        }
    });
});


 </script>