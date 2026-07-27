<style>
		iframe{width: 100% !important; min-height: auto !important;}
	</style>
<!-- #BeginEditable "bodytag" -->
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-blog set-bg" data-setbg="<?=base_url('assete/theme/img/register-bg.jpg')?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ตรวจสอบลงทะเบียนสินค้า</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

	<section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
					<h4>ลูกค้าที่ต้องการลงทะเบียนสินค้าใหม่ด้วยตัวเอง กรุณาสแกน QR Code</h4>
					<img src="<?=base_url('assete/theme/img/L_gainfriends_qr.png')?>">
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="contact__form">
                        <form  method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <input type="text" name="register_code"  id="register_code" value="" class="form-control" required="required" placeholder="กรอกหมายเลขบิล / เลขบัตรประชาชน / เบอร์โทรศัพท์">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <button type="submit" class="site-btn" style="width: 100%;">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 mb-5 mb-lg-0"  id="product-regis-position" style="text-align: center; margin-top: 1rem;">
                        
                    </div>
				</div>
			</div>
		</div>
	</section>
	
<!-- #EndEditable -->


<script>
	 var base_url = "<?=base_url();?>";
    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
        $.ajax({
            url:base_url+'Main/get_register_product_results', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(data){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                var content = '';
                if(data.datas.length > 0){
                    var val = data.datas[0];
                    content += '<div class="img-data-info">';
                    content += '<div>';

                    if(val.name != '' && val.name != null){
                        content += '<h5>'+val.name+'</h5>';
                    }
                    if(val.link != '' && val.link != null){
                        content += '<p><a href="'+val.link+'" target="_blank">คู่มือการใช้งาน </a></p>';
                    }
                    if(val.file_path != '' && val.file_path != null){
                        content += '<p><a href="'+val.file_path+'" target="_blank">คู่มือการใช้งาน</a></p>';
                    }
                    if(val.detail != '' && val.detail != null){
                        content += val.detail;
                    }
                    content += '</div>';
                    content += '</div>';
                }
                $('#product-regis-position').html(content);
            }
        });
    });
</script>