<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>TG Smart life Service<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="edit-form">
                <input type="hidden" name="action" id="action"value="insert">
                <input type="hidden" name="id" id="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">Topic</label>
                            <input type="text" class="form-control" name="topic" id="topic" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="15" id="detail" name="detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 col-sm-4">
                            <label for="amphurs">สถานะ</label>
                            <select class="form-control" name="active"  id="active" required="required" >
                                <option value="1" class="active">เปิด ใช้งาน</option>
                                <option value="0">ปิด ใช้งาน</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <!-- <a id="back-btn" href="<?=base_url("admin_career");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a> -->
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
    CKEDITOR.replace('detail', {height  : '500px',});
    
    //###  FORM ###//
    drawform(base_url);
    function drawform(base_url){
        var results = get_results(base_url);
        console.log(results);
       
        if(results.datas.length > 0){
            $('form#edit-form #action').val('update');
            $('form#edit-form #id').val(results.datas[0].id);
            $('form#edit-form #topic').val(results.datas[0].topic);
            $('form#edit-form #detail').val(results.datas[0].detail).change();
            $('form#edit-form #active').val(results.datas[0].active).change();
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Others/get_tgsmartlifeservice', //ทำงานกับไฟล์นี้
            data: {
                "method" : 'tgsmartlifeservice'
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
    $("form#edit-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        
        $.ajax({
            url:base_url+'admin/Others/actions_tgsmartlifeservice', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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
    