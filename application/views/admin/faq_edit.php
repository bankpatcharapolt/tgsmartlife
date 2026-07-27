<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>คำถามที่พบบ่อย<small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div> 

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="edit-form">
                <input type="hidden" name="method" value="update">
                <input type="hidden" name="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">หมวดหมู่หลัก</label>                            
                            <select class="form-control" name="faq_main_id"  id="faq_main_id" >
                                <?php 
                                foreach($faq_main as $key =>$value){
                                ?>
                                    <option value="<?php echo $value['id']?>"><?php echo $value['topic'];?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-md-6 ">
                            <label class="control-label">หัวข้อย่อย</label>
                            <input type="text" class="form-control" name="topic" id="topic" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="desc">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="desc" name="desc"></textarea>
                        </div>
                    </div>
                    
                
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_career");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
                            <button id="save-btn" class="btn btn-info text-center" style="" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo $id;?>"/>
            </form>
        </div>
    </div>
</div>
<!---- End Content ------>
<script>
    var product_id = '<?php echo $id?>';
    var base_url = $('input[name="base_url"]').val();
    //CKEDITOR.replace('desc');
    CKEDITOR.replace('desc', {height  : '500px',});
    //### save form ###//

     

    drawform(base_url);
    function drawform(base_url){
        // แปลง JSON string เป็น JavaScript object
        var results = get_result_faq(base_url);
        console.log(results);
    
        if(results){
        
            $('form#edit-form #faq_main_id').val(results.datas[0].faq_main_id).change();
            $('form#edit-form #topic').val(results.datas[0].topic);
            $('form#edit-form #desc').val(results.datas[0].desc).change();
        }
    }

function get_result_faq(base_url){
        var res = null;
        $.ajax({
            url: base_url+'/admin/Faq/get_faq_onc', //ทำงานกับไฟล์นี้
            data: {
                "id" :product_id
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


    $("form#edit-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        $.ajax({
            url:base_url+'admin/Faq/faq_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                window.location.href = response.datas;
               
            }
        });
    });
</script>
    