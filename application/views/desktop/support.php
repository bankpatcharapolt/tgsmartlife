	
<!-- #BeginEditable "bodytag" -->
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-blog set-bg" data-setbg="<?=base_url('assete/theme/img/support-bg.jpg')?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>บริการช่วยเหลือ</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

	
	<!-- career Section -->
	<section class="support">
        <div class="container">
            <div class="row">
				<div class="col-lg-3 mb-5 mb-lg-0">
					<a href="tg-help">
						<div class="mb-4 support__details card">
							<img src="<?=base_url('assete/theme/img/icon/step.png')?>" width="50" height="50">
							<h5>ขั้นตอนการสั่งซื้อสินค้า</h5>
						</div>
					</a>
                </div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<a href="service-center">
						<div class="mb-4 support__details card">
							<img src="<?=base_url('assete/theme/img/icon/enterprise.png')?>" width="50" height="50">
							<h5>ศูนย์บริการ TG smart life</h5>
						</div>
					</a>
                </div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<a href="product-data-center">
						<div class="mb-4 support__details card">
							<img src="<?=base_url('assete/theme/img/icon/data.png')?>" width="50" height="50">
							<h5>ศูนย์รวมข้อมูลผลิตภัณฑ์</h5>
						</div>
					</a>
                </div>
				<div class="col-lg-3 mb-5 mb-lg-0">
					<a href="register-product">
						<div class="mb-4 support__details card">
							<img src="<?=base_url('assete/theme/img/icon/regis.png')?>" width="50" height="50">
							<h5>ตรวจสอบลงทะเบียนสินค้า</h5>
						</div>
					</a>
                </div>
			</div>
		</div>
	</section>
	<!-- career Section End -->
	
	<section class="career">
        <div class="container">
            <div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<h5 class="career__contact__h5">CONTACT US</h5>
					<div class="mb-4 career__contact">
						<p id="company_email"><i class="fa fa-envelope" aria-hidden="true"></i> smartliftj@gmail.com</p>
						<p id="company_contact"><i class="fa fa-mobile" aria-hidden="true"></i> 063-746-6851, 083-928-8765</p>
					</div>
				</div>
			</div>
		</div>
	</section>

<!-- #EndEditable -->
<script>
	var base_url = "<?=base_url();?>";
    drawgenerals(base_url);
    function drawgenerals(base_url){
        //###  ressults ###//
        var results = get_general_results(base_url);
		console.log(results);
        if(results.datas.length > 0){
            var conpany_contact = '';
            $.each( results.datas, function( key, val ) {
                switch (val.method) {
                    case 'companyname':break;
                    case 'callcenter':
                        if(val.text != '' && val.text != null){
                            conpany_contact += ' '+val.text;
                        }
                    break;
                    case 'servicenumber':
                        if(val.text != '' && val.text != null){
                            conpany_contact += ' '+val.text;
                        }
                    break;
                    case 'emailcompany':
                        if(val.text != '' && val.text != null){
                            var html = '<i class="fa fa-envelope" aria-hidden="true"></i> '+val.text;
                            $('.career .career__contact #company_email').html(html);
                        }
                    break;
                    case 'taxidentification':break;
                    case 'facebook': break;
                    case 'line': break;
                    default:break;
                }
                
            });
            $('.career .career__contact #company_contact').html('<i class="fa fa-mobile" aria-hidden="true"></i> '+conpany_contact);
        }
    }
    function get_general_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_general_results', //ทำงานกับไฟล์นี้
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
</script>