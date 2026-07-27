<!-- ที่อยู่จัดส่ง -->
<?php if(!isset($register_page)){?>
<div class="form-group row">
                        <?php 
                            if(!isset($_GET['isChange'])){
                            ?>
                            <label for="address"  class="col-sm-10 col-form-label"><span id="label_address_current">ที่อยู่จัดส่ง:</span><?php
                                                                                                $addr = "";
                               
                                                                                                foreach ($address as $addrk => $value) {
                                                                                                    if ($value['addr_type'] == 1) {
                                                                                                        $addr = getAddr($value, $province, $amphur, $districts, $addr);
                                                                                                    }
                                                                                                }
                                                                                                
                                                                                                echo $addr;

                                                                                                ?></label>
                            <div class="col-sm-2">
                                <span class="btnAddr" id="btnEditAddr" onclick="goToChangeAddr()">เปลี่ยน</span>
                                <span class="btnAddr" id="btnCancleEditAddr" onclick="goToUndoChangeAddr()" style="display:none;">ยกเลิกการแก้ไข</span>

                            </div>
                            <?php } ?>
                        </div>
<?php } ?>
                        <div class="addr-div " style="display:<?php echo !isset($register_page) ? "none":"block"?>;">
                            <?php if(!isset($register_page)){?>
                            <?php
                            $addr_array = [];
                            foreach ($address as $addrkk => $v) {

                                if ($v['addr_type'] == 1) {
                                    $addr_array = $v;
                                }
                            }

                            ?>
                            <?php } ?>
                            <div class="form-group">
                                <label for="name">ชื่อสถานที่</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อสถานที่">
                            </div>
                            <div class="form-group">
                                <label for="home_no">บ้านเลขที่ / หมู่*</label>
                                <input type="text" class="form-control" id="home_no" name="home_no" placeholder="บ้านเลขที่ / หมู่" required>
                            </div>
                            <div class="form-group">
                                <label for="building">ตึก/อาคาร/หมู่บ้าน*</label>
                                <input type="text" class="form-control" id="building" name="building" placeholder="ตึก/อาคาร/หมู่บ้าน" required>
                            </div>
                            <div class="form-group">
                                <label for="road">ถนน*</label>
                                <input type="text" class="form-control" id="road" name="road" placeholder="ถนน" required>
                            </div>
                            <div class="form-group">
                                <label for="addr">ที่อยู่*</label>
                                <input type="text" class="form-control" id="addr" name="addr" placeholder="กรอกที่อยู่" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">เบอร์โทรศัพท์ติดต่อ</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์ติดต่อ">
                            </div>
                            <!-- เพิ่มเลือกตำบล/แขวง, อำเภอ/เขต, จังหวัด -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-2">
                                        <label for="province" class=" col-md-12 " style="padding-left:0px;">จังหวัด</label>
                                        <select class="form-control" id="province" name="province" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มจังหวัดอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="district" class=" col-md-12" style="padding-left:0px;">อำเภอ/เขต</label>
                                        <select class="form-control" id="district" name="district" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มอำเภอ/เขตอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="subdistrict" class=" col-md-12" style="padding-left:0px;">ตำบล/แขวง</label>
                                        <select class="form-control" id="subdistrict" style="margin-bottom: 8px;" name="subdistrict" required>
                                            <option value="">กรุณาเลือก</option>

                                            <!-- เพิ่มตำบล/แขวงอื่น ๆ ตามต้องการ -->
                                        </select>
                                    </div>
                                </div>
                                <!-- เพิ่ม input รหัสไปรษณีย์ -->
                                <div class="col">
                                    <div class="form-group">
                                        <label for="zipcode">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="กรอกรหัสไปรษณีย์" required>
                                    </div>
                                </div>
                            </div>
                            <?php if(!isset($register_page)){?>
                            <div class="form-group mt-3" align="center" id="divSaveAddr">
                                <button type="submit" class="btn btn-primary btn-block btnSubmit col-md-6">บันทึก</button>
                            </div>
                            <?php }?>
                        </div>

