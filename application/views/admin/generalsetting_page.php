<!----  Call Center ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Call Center<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="callcenter-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Topic</label>
                            <input class="form-control" type="text" name="callcenter" id="callcenter" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!----  Contact number ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Service number<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="servicenumber-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Contact number</label>
                            <input class="form-control" type="text" name="servicenumber" id="servicenumber" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!----  Company name ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Company name<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="companyname-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Company name</label>
                            <input class="form-control" type="text" name="companyname" id="companyname" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!----  Email Company ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Email Company<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="emailcompany-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Email</label>
                            <input class="form-control" type="text" name="emailcompany" id="emailcompany" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!---- taxpayer identification number ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>เลขประจำตัวผู้เสียภาษี<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="taxidentification-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">เลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control" type="text" name="taxidentification" id="taxidentification" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!---- Facebook number ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Facebook<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="facebook-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">เลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control" type="text" name="facebook" id="facebook" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!---- Line number ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Line<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="line-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">เลขประจำตัวผู้เสียภาษีอากร</label>
                            <input class="form-control" type="text" name="line" id="line" value="">
                            <!-- <textarea class="form-control" rows="3" id="text" name="text"></textarea> -->
                        </div>
                        <div class="col-md-3">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="padding: 27px 0 0 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_generalsetting");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!---- End Content ------>
<script>

    var base_url = $('input[name="base_url"]').val();
    //CKEDITOR.replace('details');
    //CKEDITOR.replace('detail', {height  : '500px',});
    
    //### Collcenter  FORM ###//
    drawcallcenterform(base_url);
    function drawcallcenterform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_callcenter_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'callcenter'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#callcenter-form #action').val('update');
            $('form#callcenter-form #id').val(res.datas[0].id);
            $('form#callcenter-form #callcenter').val(res.datas[0].text);
            $('form#callcenter-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#callcenter-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/callcenter_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });

    //### Service number FORM ###//
    drawservicenumberform(base_url);
    function drawservicenumberform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_servicenumber_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'servicenumber'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#servicenumber-form #action').val('update');
            $('form#servicenumber-form #id').val(res.datas[0].id);
            $('form#servicenumber-form #servicenumber').val(res.datas[0].text);
            $('form#servicenumber-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#servicenumber-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/servicenumber_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });
    //### Company name  FORM ###//
    drawcompanynameform(base_url);
    function drawcompanynameform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_companyname_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'companyname'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#companyname-form #action').val('update');
            $('form#companyname-form #id').val(res.datas[0].id);
            $('form#companyname-form #companyname').val(res.datas[0].text);
            $('form#companyname-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#companyname-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/companyname_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });
    
    
    //### Email Company FORM ###//
    drawemailcompanyform(base_url);
    function drawemailcompanyform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_emailcompany_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'emailcompany'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#emailcompany-form #action').val('update');
            $('form#emailcompany-form #id').val(res.datas[0].id);
            $('form#emailcompany-form #emailcompany').val(res.datas[0].text);
            $('form#emailcompany-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#emailcompany-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/emailcompany_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });

    //### taxpayer identification FORM ###//
    drawtaxidentificationform(base_url);
    function drawtaxidentificationform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_taxidentification_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'taxidentification'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#taxidentification-form #action').val('update');
            $('form#taxidentification-form #id').val(res.datas[0].id);
            $('form#taxidentification-form #taxidentification').val(res.datas[0].text);
            $('form#taxidentification-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#taxidentification-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/taxidentification_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });
    
    //### Facebook FORM ###//
    drawfacebookform(base_url);
    function drawfacebookform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_facebook_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'facebook'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#facebook-form #action').val('update');
            $('form#facebook-form #id').val(res.datas[0].id);
            $('form#facebook-form #facebook').val(res.datas[0].text);
            $('form#facebook-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#facebook-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/facebook_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });
    
    //### Line FORM ###//
    drawlineform(base_url);
    function drawlineform(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Product/get_line_onc', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'line'
            },  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        if(res.datas.length > 0){
            $('form#line-form #action').val('update');
            $('form#line-form #id').val(res.datas[0].id);
            $('form#line-form #line').val(res.datas[0].text);
            $('form#line-form #active').val(res.datas[0].active).change();
        }
    }
    $("form#line-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Product/line_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
                // $("#loading-spinner").hide();
                // if(response.status){
                //     window.location.href = response.datas;
                //     //Swal.fire({ icon: 'success',  text: response.massege });
                // }else{
                //     Swal.fire({ icon: 'warning',  text: response.massege });
                // }
            }
        });
    });
</script>
    