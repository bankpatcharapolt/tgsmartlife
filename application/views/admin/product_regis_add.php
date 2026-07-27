<!----  Content ------>
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>ตรวจสอบลงทะเบียนสินค้า <small></small></h2>
            <input name="base_url" value="<?=base_url();?>" type="hidden" >
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
        <form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                <input type="hidden" name="action" value="insert">
                <input type="hidden" name="id" value="">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-6 ">
                            <label class="control-label">Product</label>
                            <select class="form-control" name="product" id="product" required="required" ></select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">หมายเลขบิล</label>
                            <input type="text" class="form-control" name="bill_number" id="bill_number" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">เบอร์โทร ลูกค้า</label>
                            <input type="text" class="form-control" name="tel_cus" id="tel_cus" >
                        </div>
                        <div class="col-md-6 ">
                            <label class="control-label">หมายเลขบัตรประชาชน ลูกค้า</label>
                            <input type="text" class="form-control" name="tel_idcart" id="tel_idcart" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <label class="control-label">Link</label>
                            <textarea class="form-control" rows="3" id="link" name="link"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="active" style="margin-bottom: 0;">PDF</label>
                            <input type="file" class="" name="pdfFile" accept=".pdf" id="pdfFile" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="control-label" for="first-name">รายละเอียด<span class="required">*</span></label>
                            <textarea class="form-control" rows="5" id="detail" name="detail"></textarea>
                        </div>
                    </div>
                
                    <div class="form-group" style="border-top: 1px solid #dee2e6;">
                        <div class="col-12" style="padding: 13px 0;">
                            <a id="back-btn" href="<?=base_url("admin_product_spec");?>" class="btn btn-warning text-center" style="" type="button">กลับ</a>
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
    CKEDITOR.replace('detail', {height  : '500px',});

    //### draw product category  ###//
    drawtProductOption(base_url);
    function drawtProductOption(base_url){
        var results = get_products(base_url);
        if(results.datas.length > 0){   
            var option = '';
            $.each( results.datas, function( key, val ) {
                option += '<option value="'+val.id+'">'+val.name+'</option>';
            });
            //option += '<option value="99999">อื่นๆ</option>';
            var tableid = 'form#action-form #product';
            $(tableid).html(null);
            $(tableid).append(option);
        }
    }
    function get_products(base_url){
        var res = null;
        $.ajax({
            url: base_url+'admin/Product/get_product', //ทำงานกับไฟล์นี้
            data: '',  //ส่งตัวแปร
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
        
        //### pdf File ###//
        if($('form#action-form #pdfFile').val() != ''){
            var inputFiles = $('form#action-form #pdfFile')[0].files; //เป็นการดึงข้อมูลรูปภาพเพื่อเตรียมเช็คไฟล์ก่อนทำงานส่วน Ajax
            fd.append('file',inputFiles); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element
        }
        
        $.ajax({
            url:base_url+'admin/Product/regis_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
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
    