<style>
	iframe{width: 100% !important; min-height: auto !important; display:block;}

	.rp-section { background: #f7f8fa; padding: 50px 0 70px; }
	.rp-card {
		background: #ffffff;
		border: 1px solid #ebebeb;
		border-radius: 10px;
		padding: 32px;
		box-sizing: border-box;
	}
	.rp-card h4, .rp-card h5 {
		font-family: 'Nunito Sans', sans-serif;
		color: #111111;
	}

	/* QR: แผงพับเก็บได้ เปิดมาแสดงตามปกติ แล้วยุบอัตโนมัติเมื่อค้นหาสำเร็จและมีแผนที่ขึ้น
	   เพื่อให้ส่วนแผนที่ได้ความกว้างเต็มหน้า */
	.rp-qr-toggle { margin-bottom: 20px; }
	.rp-qr-head {
		display: flex; align-items: center; justify-content: space-between; gap: 12px;
		background: #ffffff; border: 1px solid #ebebeb; border-radius: 10px;
		padding: 16px 24px; cursor: pointer; user-select: none;
	}
	.rp-qr-head span { font-size: 15px; font-weight: 700; color: #111111; }
	.rp-qr-chevron { transition: transform .2s ease; flex-shrink: 0; }
	.rp-qr-toggle.is-collapsed .rp-qr-chevron { transform: rotate(-90deg); }
	.rp-qr-body {
		overflow: hidden; max-height: 500px; transition: max-height .25s ease, opacity .2s ease;
		opacity: 1;
	}
	.rp-qr-toggle.is-collapsed .rp-qr-body { max-height: 0; opacity: 0; }
	.rp-qr-card { text-align: center; margin-top: 12px; }
	.rp-qr-card h4 {
		font-size: 16px;
		font-weight: 700;
		margin-bottom: 20px;
		line-height: 1.5;
	}
	.rp-qr-card img { max-width: 200px; width: 100%; }

	.rp-search-label {
		font-size: 13px;
		font-weight: 700;
		color: #5C5C5C;
		text-transform: uppercase;
		letter-spacing: .04em;
		margin-bottom: 12px;
		display: block;
	}
	.rp-search-row { display: flex; gap: 10px; flex-wrap: wrap; }
	.rp-search-row input[type="text"] {
		flex: 1 1 220px;
		height: 50px;
		border: 1px solid #e1e1e1;
		border-radius: 6px;
		padding: 0 16px;
		font-size: 15px;
		color: #111111;
	}
	.rp-search-row .site-btn {
		height: 50px;
		border-radius: 6px;
		padding: 0 28px;
		flex: 0 0 auto;
	}

	.rp-loading { display: none; align-items: center; gap: 10px; color: #5C5C5C; font-size: 14px; margin-top: 20px; }
	.rp-loading.is-active { display: flex; }
	.rp-spinner {
		width: 18px; height: 18px; border-radius: 50%;
		border: 2px solid #e1e1e1; border-top-color: #005eb8;
		animation: rp-spin .7s linear infinite;
	}
	@keyframes rp-spin { to { transform: rotate(360deg); } }

	.rp-empty {
		margin-top: 20px; padding: 18px 20px; border-radius: 8px;
		background: #f7f8fa; border: 1px dashed #e1e1e1;
		color: #5C5C5C; font-size: 14px;
	}

	.rp-result-card { margin-top: 20px; }
	.rp-result-card h5 { font-size: 20px; font-weight: 700; margin-bottom: 14px; }
	.rp-manual-links { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
	.rp-manual-links a {
		display: inline-flex; align-items: center; gap: 6px;
		font-size: 13px; font-weight: 700; color: #005eb8;
		background: #eaf2fb; border-radius: 20px; padding: 7px 16px;
		text-decoration: none;
	}
	.rp-manual-links a:hover { background: #dbe9f8; }
	.rp-detail { color: #5C5C5C; font-size: 14px; line-height: 1.7; text-align: left; }

	.rp-map-card { margin-top: 24px; border-radius: 10px; overflow: hidden; border: 1px solid #ebebeb; }
	.rp-map-card iframe { height: 640px; border: none; }
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

	<section class="rp-section">
        <div class="container">

			<!-- QR: พับเก็บได้ เริ่มต้นแบบยุบไว้ก่อน (กดหัวข้อเพื่อเปิดดูได้ตลอด) จะยุบอัตโนมัติอีกครั้งถ้าค้นหาเจอและมีแผนที่ขึ้น -->
			<div class="rp-qr-toggle is-collapsed" id="rp-qr-toggle">
				<div class="rp-qr-head" id="rp-qr-head">
					<span>ลูกค้าที่ต้องการลงทะเบียนสินค้าใหม่ด้วยตัวเอง กรุณาสแกน QR Code</span>
					<svg class="rp-qr-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 9l6 6 6-6" stroke="#5C5C5C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</div>
				<div class="rp-qr-body">
					<div class="rp-card rp-qr-card">
						<img src="<?=base_url('assete/theme/img/L_gainfriends_qr.png')?>">
					</div>
				</div>
			</div>

			<div class="rp-card">
				<span class="rp-search-label">ค้นหาข้อมูลสินค้าที่ลงทะเบียนไว้</span>
				<form method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
					<div class="rp-search-row">
						<input type="text" name="register_code" id="register_code" value="" required="required" placeholder="กรอกหมายเลขบิล">
						<button type="submit" class="site-btn">ค้นหา</button>
					</div>
				</form>
				<div class="rp-loading" id="rp-loading">
					<span class="rp-spinner"></span>กำลังค้นหาข้อมูล...
				</div>

				<div id="product-regis-position"></div>
				<div id="register-map-position"></div>
			</div>
		</div>
	</section>

<!-- #EndEditable -->


<script>
	 var base_url = "<?=base_url();?>";
	 var SERVICE_MANAGEMENT_URL = "<?=addslashes($service_management_url ?? ''); ?>";

	 // เปิด/ปิดแผง QR เองได้ตลอด (กดที่หัวแถบ)
	 document.getElementById('rp-qr-head').addEventListener('click', function() {
	     document.getElementById('rp-qr-toggle').classList.toggle('is-collapsed');
	 });

    //### save form ###//
    $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
        e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
        var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object

        $('#product-regis-position').html('');
        $('#register-map-position').html('');
        $('#rp-loading').addClass('is-active');

        $.ajax({
            url:base_url+'Main/get_register_product_results', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
            type:'post',
            dataType: 'json',
            data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
            contentType: false,
            processData: false,
            success:function(data){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                $('#rp-loading').removeClass('is-active');
                var content = '';
                if(data.datas.length > 0){
                    // กรอบข้อมูลสินค้า (ชื่อ/คู่มือ/รายละเอียด) ซ่อนไว้ตามที่ขอ — ไม่ต้องสร้าง content ส่วนนี้อีก
                } else {
                    content = '<div class="rp-empty">ไม่พบข้อมูลการลงทะเบียนสินค้า กรุณาตรวจสอบหมายเลขบิล</div>';
                }
                $('#product-regis-position').html(content);

                // แผนที่ (อ่านอย่างเดียว บิลเดียว ไม่ต้อง login) — แสดงใต้แถวปุ่มค้นหา
                // ใช้ map_token ที่เซิร์ฟเวอร์ออกให้ตอนค้นหาสำเร็จ (ผูกกับบิลนั้นบิลเดียว หมดอายุ 6 วัน)
                // หมายเหตุ: ไม่ใส่หัวข้อ "แผนที่ลูกค้า" ซ้ำตรงนี้ เพราะหน้า /map ที่ embed มา
                // (จากระบบ service_management) มีแถบหัวข้อ "แผนที่ลูกค้า" ของตัวเองอยู่แล้วด้านในสุด
                if (data.map_token && SERVICE_MANAGEMENT_URL) {
                    var mapUrl = SERVICE_MANAGEMENT_URL.replace(/\/$/, '') + '/map?token=' + encodeURIComponent(data.map_token);
                    var $mapCard = $('<div>', { class: 'rp-map-card' });
                    var $iframe  = $('<iframe>', { src: mapUrl, loading: 'lazy' });
                    $mapCard.append($iframe);
                    $('#register-map-position').html($mapCard);

                    // มีแผนที่ขึ้นแล้ว ยุบแผง QR อัตโนมัติให้แผนที่ได้ความกว้างเต็มจอ (กดเปิดกลับได้เสมอ)
                    document.getElementById('rp-qr-toggle').classList.add('is-collapsed');
                }
            },
            error: function() {
                $('#rp-loading').removeClass('is-active');
                $('#product-regis-position').html('<div class="rp-empty">เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง</div>');
            }
        });
    });

    // แผนที่ (iframe จากระบบ service_management) ส่งข้อความมาบอกถ้าค้นบิลนี้แล้วไม่มีข้อมูล
    // การให้บริการเลยในระบบนั้น (ถึงจะเจอบิลฝั่งนี้ก็ตาม) — โชว์ "ไม่พบข้อมูล" ที่หน้านี้แทน iframe เปล่าๆ
    // เช็ค origin ของข้อความให้ตรงกับระบบ service_management ที่ตั้งค่าไว้เท่านั้น กันข้อความจากที่อื่นปลอมมา
    window.addEventListener('message', function(event) {
        if (!SERVICE_MANAGEMENT_URL) return;
        var expectedOrigin;
        try { expectedOrigin = new URL(SERVICE_MANAGEMENT_URL).origin; } catch (e) { return; }
        if (event.origin !== expectedOrigin) return;
        if (event.data && event.data.source === 'tg_customer_map' && event.data.status === 'no_data') {
            $('#register-map-position').html('<div class="rp-empty">ไม่พบข้อมูลการให้บริการของหมายเลขบิลนี้ในระบบ</div>');
        }
    });
</script>