<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ข้อมูลการติดต่อจา หน้าเว็บ <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" name="action" value="update">
                <input type="hidden" name="id" id="id" value="<?=$id;?>">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">ชื่อ</label>
                            <input type="text" class="form-control" name="name" id="name" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">เบอร์โทร</label>
                            <input type="text" class="form-control" name="tel" id="name" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">อีเมล์</label>
                            <input type="text" class="form-control" name="email" id="email" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">เนื้อหาการติดต่อ</label>
                            <textarea class="form-control" rows="5" id="massege" id="massege" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="0">ยังไม่ดำเนินการ</option>
                                <option value="1" class="active">ดำเนินการเรียบร้อย</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_webcontact");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
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

    //###  FORM ###//
    drawform(base_url);
    function drawform(base_url){
        var results = get_results(base_url);
        if(results){
            $('form#action-form #name').val(results.datas[0].name);
            $('form#action-form #tel').val(results.datas[0].tel);
            $('form#action-form #email').val(results.datas[0].email);
            $('form#action-form #massege').val(results.datas[0].massege);
            $('form#action-form #active').val(results.datas[0].active).change();
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Other/get_webcontact_once', //ทำงานกับไฟล์นี้
            data: {
                "id" : $('form#action-form #id').val()
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
        return res;
    }

    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Other/webcontact_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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
    