<!-- ที่อยู่จัดส่ง -->
<?php if(!isset($register_page)){?>
<div class="form-group row">
                            <?php 
                            if(!isset($_GET['isChange'])){
                            ?>
                            <label for="address-tax" class="col-sm-10 col-form-label">ที่อยู่สำหรับขอใบกำกับภาษี :<?php
                                                                                                                      $addr = "";


                                                                                                                    foreach ($address as $addrk => $value) {
                                                                                                                        if ($value['addr_type'] == 2) {
                                                                                                                            $addr = getAddr($value, $province, $amphur, $districts, $addr);
                                                                                                                        }
                                                                                                                    }
                                                                                                                    echo $addr;

                                                                                                                    ?></label>
                            <div class="col-sm-2">
                                <span class="btnAddr" id="btnEditAddrTax" onclick="goToChangeAddrTax()">เปลี่ยน</span>
                                <span class="btnAddr" id="btnCancleEditAddrTax" onclick="goToUndoChangeAddrTax()" style="display:none;">ยกเลิกการแก้ไข</span>

                            </div>
                            <?php }?>
                        </div>
<?php } ?>
                        <div class="addr-tax-div " style="display:<?php echo !isset($register_page) ? "none":"block";?>;">
                        <?php if(!isset($register_page)){?>
                            <?php
                            $addr_tax_array = [];
                            foreach ($address as $addrkk => $v) {

                                if ($v['addr_type'] == 2) {
                                    $addr_tax_array = $v;
                                }
                            }
                            

                            ?>
                            <?php } ?>
                            <div class="form-group">
                                <label >รูปแบบใบกำกับภาษี</label><br>
                                <input type="radio" name="tax_type" style="cursor:pointer;" value="1" id="taxIndividual" onchange="onchangeTaxType('1')">
                                <label for="taxIndividual" style="cursor:pointer;">บุคคลธรรมดา</label><br>
                                <input type="radio" name="tax_type" style="cursor:pointer;" value="2" id="taxCorpotation" onchange="onchangeTaxType('2')">
                              <label for="taxCorpotation" style="cursor:pointer;">นิติบุคคล</label>
                            </div>
                            <!-- เพิ่มช่องกรอกข้อมูล -->
                            <div class="form-group">
                                <label for="fullnameComp">ชื่อ/สกุล/ชื่อบริษัท*</label>
                                <input type="text" class="form-control address_company" id="fullnameComp" name="fullnameComp" placeholder="กรอกชื่อ/สกุล/ชื่อบริษัท" required>
                            </div>
                            <div class="form-group">
                                <label for="home_no">บ้านเลขที่ / หมู่*</label>
                                <input type="text" class="form-control address_company" id="home_no_comp" name="<?php echo isset($register_page) ? "home_no_comp" : "home_no"?>" placeholder="บ้านเลขที่ / หมู่" required>
                            </div>
                            <div class="form-group">
                                <label for="building">ตึก/อาคาร/หมู่บ้าน*</label>
                                <input type="text" class="form-control address_company" id="building_comp" name="<?php echo isset($register_page) ? "building_comp" : "building"?>" placeholder="ตึก/อาคาร/หมู่บ้าน" required>
                            </div>
                            <div class="form-group">
                                <label for="road">ถนน*</label>
                                <input type="text" class="form-control address_company" id="road_comp" name="<?php echo isset($register_page) ? "road_comp" : "road"?>" placeholder="ถนน" required>
                            </div>
                            <div class="form-group">
                                <label for="tax_id">เลขที่ผู้เสียภาษี*</label>
                                <input type="text" class="form-control address_company" id="tax_id" name="tax_id" placeholder="กรอกเลขที่ผู้เสียภาษี" required>
                            </div>
                            <div class="form-group" id="passport_div">
                                <label for="passport_number">Passport Number</label>
                                <input type="text" class="form-control address_company" id="passport_number" name="passport_number" placeholder="Passport Number">
                            </div>
                            <div class="form-group">
                                <label for="phoneComp">เบอร์โทร</label>
                                <input type="text" class="form-control address_company" id="phoneComp" name="phoneComp" placeholder="กรอกเบอร์โทร" required>
                            </div>
                            <div class="form-group">
                                <label for="addrComp">ที่อยู่</label>
                                <input type="text" class="form-control address_company" id="addrComp" name="addrComp" placeholder="กรอกที่อยู่" required>
                            </div>
                            <!-- เพิ่มช่องกรอกข้อมูล -->

                            <!-- เพิ่มเลือกตำบล/แขวง, อำเภอ/เขต, จังหวัด -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-2">
                                        <label for="provinceComp" class=" col-md-12 " style="padding-left:0px;">จังหวัด</label>
                                        <select class="form-control address_company" id="provinceComp" name="provinceComp" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มจังหวัดอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="districtComp" class=" col-md-12" style="padding-left:0px;">อำเภอ/เขต</label>
                                        <select class="form-control address_company" id="districtComp" name="districtComp" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มอำเภอ/เขตอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="subdistrictComp" class=" col-md-12" style="padding-left:0px;">ตำบล/แขวง</label>
                                        <select class="form-control address_company" id="subdistrictComp" style="margin-bottom: 8px;" name="subdistrictComp" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มตำบล/แขวงอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>
                                <!-- เพิ่ม input รหัสไปรษณีย์ -->
                                <div class="col">
                                    <div class="form-group">
                                        <label for="zipcodeComp">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control address_company" id="zipcodeComp" name="zipcodeComp" placeholder="กรอกรหัสไปรษณีย์" required>
                                    </div>
                                </div>
                            </div>

                            <?php if(!isset($register_page)){?>
                            <div class="form-group mt-3" align="center" id="divSaveAddr">
                                <button type="submit" class="btn btn-primary btn-block btnSubmit col-md-6">บันทึก</button>
                            </div>
                            <?php }?>
                        </div>