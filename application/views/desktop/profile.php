<style>
    .btnSubmit {
        background-color: #005EB8;
    }

    a {
        
    }

    .btnProfile {
        color: #007bff;
        text-decoration: underline;
        cursor: pointer;
    }

    .btnProfile:hover {
        color: #007bff;
        text-decoration: underline;
    }

    .btnProfile:focus {
        color: #005EB8;
        text-decoration: underline;
    }

    .btnAddr {
        color: #007bff;
        text-decoration: underline;
        cursor: pointer;
    }


    .btnAddr:hover {
        color: #007bff;
        text-decoration: underline;
    }

    .btnAddr:focus {
        color: #005EB8;
        text-decoration: underline;
    }


    .card-header-divider::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        border-top: 1px solid #dee2e6;
        z-index: -1;
    }

    .card-header-divider .left-content,
    .card-header-divider .right-content {
        position: relative;
        z-index: 1;
        background-color: #fff;
        padding: 0 10px;
    }

    */

    /* .login .container-2 {
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: 1px solid #717171;
  position: relative;
  margin: 0 0 25px 2px;
  padding: 12px 23px 17px 23px;
  width: fit-content;
  box-sizing: border-box;
} */
    .btn {
        line-height: 32px;
    }

    .form-control {
        line-height: 32px;
        height: 48px;
        width: 100%;
    }
</style>
<script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-10" >
            <div class="card" style="border:0px;">
                <div class="card-body" id="profile-div" style="border: 1px solid #E2E2E2;">
                    <form action="#" method="post" id="profile-form">

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">ชื่อผู้ใช้:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $profile[0]['username'] ?>" required disabled>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">อีเมล:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $profile[0]['email'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">เบอร์โทร:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $profile[0]['phone'] ?>" required disabled>
                            </div>
                            <div class="col-sm-2">
                                <span class="btnProfile" id="btnEditProfile" onclick="goToChangeProfile()">เปลี่ยนข้อมูลส่วนบุคคล</span>
                                <span class="btnProfile" id="btnCancleEditProfile" style="display: none;" onclick="goToUndoChangeProfile()">ยกเลิกการแก้ไขข้อมูล</>
                            </div>
                        </div>
                        <div class="form-group mt-3" align="center" style="display: none;" id="divSaveProfile">
                            <button type="submit" class="btn btn-primary btn-block btnSubmit col-md-8">บันทึก</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <?php

        function getAddr($value, $province, $amphur, $districts, $addr)
        {
            $addr_name = empty($value['address_name']) ? "-" : $value['address_name'];
            $addr_name = empty($value['name']) ? "-" : $value['name'];
            $province_name = "-";
            $keyP = array_search($value['province_id'], array_column($province, 'id'));

            if (is_numeric($keyP)) {
                $province_name = $province[$keyP]['name_th'];
            }

            $amphur_name = "-";
            $keyA = array_search($value['amphur_id'], array_column($amphur, 'id'));
            if (is_numeric($keyA)) {
                $amphur_name = $amphur[$keyA]['name_th'];
            }
            $district_name = "-";
            $keyD = array_search($value['district_id'], array_column($districts, 'id'));
            if (is_numeric($keyD)) {
                $district_name = $districts[$keyD]['name_th'];
            }
            $zip_code = empty($value['zipcode']) ? "-" : $value['zipcode'];
            if($value['addr_type'] == '2'){
                $tax_type = empty($value['tax_type']) ? "" : $value['tax_type'];
                $tax_desc = "";
                if($tax_type == '1'){
                    $tax_desc = "บุคคลธรรมดา";
                }else if($tax_type == '2'){
                    $tax_desc = "นิติบุคคล";
                }
                $addr .= " ประเภทภาษี: " . $tax_desc . "  ";
            }
            $addr .= " ชื่อสถานที่: " . $addr_name;
           
            // if($value['addr_type'] == 1){
                $home_no = empty($value['home_no']) ? "-" : $value['home_no'];
                $building = empty($value['building']) ? "-" : $value['building'];
                $road = empty($value['road']) ? "-" : $value['road'];
                $addr .= " บ้านเลขที่/หมู่: " . $home_no;
                $addr .= " ตึก/อาคาร/หมู่บ้าน: " . $building;
                $addr .= " ถนน: " . $road;
            //}
            $phone = empty($value['phone']) ? "-" : $value['phone'];
            $addr .= " เบอร์: " .$phone;
            $addr .= " จังหวัด: " . $province_name;
            $addr .= " เขต: " . $amphur_name;
            $addr .= " แขวง: " . $district_name;
            $addr .= " รหัสไปรษณีย์: " . $zip_code;

            return $addr;
        }
        ?>
        <div class="col-md-10">
            <div class="card" style="border:0px;">
                <div class="card-body pb-0 " id="address-div">


                    <form action="#" method="post" id="address-form">
                        <div class="addr-div p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;display:none;">
                            <h6>แก้ไขที่อยู่จัดส่ง</h6>
                        </div>
                        <?php include_once('address_current.php');?>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card" style="border:0px;">
                <div class="card-body pt-0" id="address-tax-div" style="margin-top:0px;">
                    
                    <form action="#" method="post" id="address-tax-form">
                    <div class="addr-tax-div p-2" style="background: rgba(0, 94, 184, 0.1);border: 1px solid #E2E2E2;display:none;">
                            <h6>แก้ไขที่อยู่ขอใบกำกับภาษี</h6>
                        </div>
                        <?php include_once('address_company.php');?>


                    </form>

                </div>
            </div>
        </div>


    </div>
</div>
<script>
    var base_url = "<?= base_url(); ?>";
    var province = '<?php echo json_encode($province) ?>';
    province = JSON.parse(province);



    var amphur = '<?php echo json_encode($amphur) ?>';
    amphur = JSON.parse(amphur);

    var profile = '<?php echo !empty($profile) ? json_encode($profile) : "0"; ?>';
    profile  = JSON.parse(profile);

    var AddressValue = '<?php echo !empty($addr_array) ? json_encode($addr_array) : "0"; ?>';
    AddressValue = JSON.parse(AddressValue);

    var AddressValueTax = '<?php echo !empty($addr_tax_array) ? json_encode($addr_tax_array) : "0"; ?>';
    AddressValueTax = JSON.parse(AddressValueTax);
</script>
<script src="<?= base_url('./assete/js/handleDropdown.js'); ?>"></script>

<?php
// print_r($addr_array);exit();
?>

<script>
            var isChange = '<?php echo isset($_GET['isChange']) ? $_GET['isChange']: 0?>';
    $(document).ready(function() {

        populateProvinceSelect();
        populateProvinceCompSelect();



    });
    window.onload = function() {
        // โค้ด JavaScript ที่คุณต้องการเรียกใช้งานหลังจากที่หน้าเว็บโหลดเสร็จสมบูรณ์

        // ใช้ setTimeout เพื่อเรียกใช้ฟังก์ชันหลังจากผ่านไปเวลาที่กำหนด (ในที่นี้คือ 3000 มิลลิวินาทีหรือ 3 วินาที)

        // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
        setInitAddrValue(AddressValue);
        setInitAddrValueTax(AddressValueTax , profile);


        if(isChange != '0'){
            if(isChange == "1"){
                goToChangeAddr();
            }else if(isChange == '2'){
                goToChangeAddrTax();
            }
        }
    };

    function setInitAddrValue(AddressValue) {

        if (AddressValue.addr != undefined) {
            $("#name").val(AddressValue.name);
            $("#home_no").val(AddressValue.home_no);
            $("#building").val(AddressValue.building);
            $("#road").val(AddressValue.road);
            $("#addr").val(AddressValue.addr);
            //$("#province").val(AddressValue.province_id).trigger('change');
            document.getElementById('province').value = AddressValue.province_id;
            document.getElementById('province').dispatchEvent(new Event('change'));

            document.getElementById('district').value = AddressValue.amphur_id;
            document.getElementById('district').dispatchEvent(new Event('change'));


            setTimeout(function() {
                // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
                setsub(AddressValue)
            }, 2000);


            // $("#zipcode").val(AddressValue.zipcode);


        }



    }

    function setsub(AddressValue) {

        document.getElementById('subdistrict').value = String(AddressValue.district_id);
        document.getElementById('subdistrict').dispatchEvent(new Event('change'));



    }

    function onchangeTaxType(value){
        if(value == '2'){
            $("#passport_div").hide();
        }else{
            $("#passport_div").show();
        }
    }
    function setInitAddrValueTax(AddressValue , profile) {
      
        if (AddressValue.addr != undefined) {
            
            if(AddressValue.tax_type != null){
                $("input[name=tax_type][value='"+AddressValue.tax_type+"']").prop("checked",true);
                onchangeTaxType(AddressValue.tax_type);
            }
            $("#home_no_comp").val(AddressValue.home_no);
            $("#building_comp").val(AddressValue.building);
            $("#road_comp").val(AddressValue.road);
            if(AddressValue.tax_type == '1'){  
                $("#passport_number").val(AddressValue.passport_number);
            }
            $("#fullnameComp").val(AddressValue.name);

            $("#tax_id").val(profile[0].tax_id);

            $("#phoneComp").val(AddressValue.phone);

            $("#addrComp").val(AddressValue.addr);
            //$("#province").val(AddressValue.province_id).trigger('change');
            document.getElementById('provinceComp').value = AddressValue.province_id;
            document.getElementById('provinceComp').dispatchEvent(new Event('change'));

            document.getElementById('districtComp').value = AddressValue.amphur_id;
            document.getElementById('districtComp').dispatchEvent(new Event('change'));


            setTimeout(function() {
                // โค้ดที่คุณต้องการให้ทำงานหลังจากผ่านไปเวลาที่กำหนด
                setsubtax(AddressValue)
            }, 2000);


            // $("#zipcode").val(AddressValue.zipcode);


        }



    }

    function setsubtax(AddressValue) {

        document.getElementById('subdistrictComp').value = String(AddressValue.district_id);
        document.getElementById('subdistrictComp').dispatchEvent(new Event('change'));



    }

    function goToUndoChangeProfile() {
        $("#profile-form input").prop('disabled', true);
        $("#divSaveProfile").hide();

        $("#btnEditProfile").show();
        $("#btnCancleEditProfile").hide();

        $("#address-div").show();
        $("#address-tax-div").show();
    }


    function goToChangeProfile() {
        $("#profile-form input").removeAttr("disabled");
        $("#divSaveProfile").show();
        $("#btnEditProfile").hide();
        $("#btnCancleEditProfile").show();

        $("#address-div").hide();
        $("#address-tax-div").hide();
    }

    function goToChangeAddrTax() {

        $("#btnCancleEditAddrTax").show();
        $("#btnEditAddrTax").hide();


        $("#address-div").hide();
        $("#profile-div").hide();

        $(".addr-div").hide();
        $(".addr-tax-div").show();
    }

    function goToUndoChangeAddrTax() {
        $("#btnCancleEditAddrTax").hide();
        $("#btnEditAddrTax").show();


        $("#address-div").show();
        $("#profile-div").show();

        $(".addr-div").hide();
        $(".addr-tax-div").hide();


    }

    function goToChangeAddr() {

        $("#btnCancleEditAddr").show();
        $("#btnEditAddr").hide();

        $("#address-tax-div").hide();
        $("#profile-div").hide();


        $(".addr-div").show();


    }

    function goToUndoChangeAddr() {
        $("#btnCancleEditAddr").hide();
        $("#btnEditAddr").show();


        $("#address-tax-div").show();
        $("#profile-div").show();

        $(".addr-div").hide();


    }
    $('#address-tax-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

        // Additional data can be appended to the FormData object if needed
        // formData.append('key', 'value');

        $.ajax({
            url: base_url + 'Profile/edit_address_tax',
            type: "POST",
            dataType: 'json',
            data: formData, // Use FormData object as the data
            contentType: false, // Prevent jQuery from setting contentType
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                console.log(response);
                if (response.status == "success") {

                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-weight:bold;">แก้ไขที่อยู่ขอใบกำกับภาษี</span>',
                        html: 'บันทึกข้อมูลสำเร็จ',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if(isChange == "2"){
                                window.location.href = "./payment";
                            }else{
                                location.reload(); // โหลดหน้าเว็บใหม่
                            }
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">บันทึกข้อมูลไม่สำเร็จ</span>',
                        html: response.message
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#address-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

        // Additional data can be appended to the FormData object if needed
        // formData.append('key', 'value');

        $.ajax({
            url: base_url + 'Profile/edit_address',
            type: "POST",
            dataType: 'json',
            data: formData, // Use FormData object as the data
            contentType: false, // Prevent jQuery from setting contentType
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                console.log(response);
                if (response.status == "success") {

                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-weight:bold;">แก้ไขที่อยู่จัดส่ง</span>',
                        html: 'บันทึกข้อมูลสำเร็จ',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                         

                            if(isChange == "1"){
                                window.location.href = "./payment";
                            }else{
                                location.reload(); // โหลดหน้าเว็บใหม่
                            }
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">บันทึกข้อมูลไม่สำเร็จ</span>',
                        html: response.message
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#profile-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData($(this)[0]); // Wrap the form in jQuery and pass it to FormData

        // Additional data can be appended to the FormData object if needed
        // formData.append('key', 'value');

        $.ajax({
            url: base_url + 'Profile/edit_user',
            type: "POST",
            dataType: 'json',
            data: formData, // Use FormData object as the data
            contentType: false, // Prevent jQuery from setting contentType
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                console.log(response);
                if (response.status == "success") {

                    Swal.fire({
                        icon: 'success',
                        title: '<span style="font-weight:bold;">แก้ไขข้อมูลส่วนบุคคล</span>',
                        html: 'บันทึกข้อมูลสำเร็จ',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // โหลดหน้าเว็บใหม่
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">บันทึกข้อมูลไม่สำเร็จ</span>',
                        html: response.message
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>