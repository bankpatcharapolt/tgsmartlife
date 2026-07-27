
	<style>


.knowledfge-position .col-lg-4 {
    margin-bottom: 20px;
}


@media (min-width: 768px) {
   
    .knowledfge-position .col-lg-4:nth-child(3n+1) {
        padding-left: 0;
    }

  
    .knowledfge-position .col-lg-4:nth-child(3n) {
        padding-right: 0;
    }

 
    .knowledfge-position .col-md-6 {
        padding-left: 15px; /* ค่าเริ่มต้นของ Bootstrap */
        padding-right: 15px; /* ค่าเริ่มต้นของ Bootstrap */
    }
}


@media (max-width: 767.98px) {
  
    .knowledfge-position .col-sm-4 {
        padding-left: 15px; 
        padding-right: 15px; 
    }
    
 
    .knowledfge-position .col-sm-4:nth-child(n) {
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
}

.primary-link-btn {
   
    padding: 6px 12px; 
    
    display: inline-block; 
    text-align: center;
    
    /* สไตล์สี */
    background-color: #3293F0; 
    color: white !important; 
    
    
    font-size: 14px; 
    font-weight: 500;
    

    border: none;
    border-radius: 4px; 
    cursor: pointer;
    transition: background-color 0.3s; 
}

/* สไตล์เมื่อนำเมาส์ไปชี้ */
.primary-link-btn:hover {
    background-color: #005EB8; 
}

 @media (max-width: 600px) {
.slide-padding-container {
 width: 90vw !important;
 max-height: 180px !important;
}
 }

        @media (max-width: 991.98px) { /* Tablet and below */
            .about-sec{
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .container {
                margin-left: 0px !important;
                margin-right: 0px !important;
            }
            .addtocart {
                height: auto;
            }
            .slide-padding-container {
   
        width: 100%; 
        /* height: 350px;  */
        margin: 0; 
    }
            .tg__items {
                /* margin-top: -150px; */
                height: auto !important;

                
            }
        }
.slide-padding-container {
  
    width: 80vw; 
 
    margin: 0 auto; 
  
    padding: 0; 
    box-sizing: border-box;
}


.tg__items {
    height: 400px;
    width: 100%; 
    box-sizing: border-box;

   background-position: center top;
  
    background-size: 100% auto;
   
}
        /* โค้ดส่วนนี้ของคุณถูกต้องแล้วสำหรับการแสดง Dots */
.owl-dots { 
    text-align: center; 
    padding-top: 1px; 
}
.owl-dots button.owl-dot {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    display: inline-block;
    background: #ccc;
    margin: 0 3px;
}
.owl-dots button.owl-dot.active { 
    background-color: #005eb8; 
}
/* ซ่อนปุ่มลูกศร (ซ้าย/ขวา) */
.tg__slider.owl-carousel .owl-nav {
    display: none !important;
}
/* หรือกำหนดให้เป็น: */
.owl-nav {
    display: none !important;
}
/* ... อื่น ๆ ... */
        .addtocart{
            background-color: #005EB8;
            color: #fff;
            border-radius: unset;
            height: auto;
            font-size: inherit; /* ให้ไอคอนเท่ากับขนาดของปุ่ม */
        }

        .numberCart{
            width: 45px;
            height: 40px;
            text-align: center;
            border-radius: unset;
            border: 1px solid #A4A4A4;  
            box-sizing: border-box;
            background-color: #FFF;
        
        }
        div.form-increase {
           position: relative;top: -25px !important;
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none; 
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
        .value-button {
            width: 40px;
            height: 40px;
            border-radius: unset;
            border: 1px solid #A4A4A4;  
            box-sizing: border-box;
            background-color: #FFF;

        }

        .value-button:hover {
        cursor: pointer;
        }

       
        

        /* .tg__items { height: inherit !important;} */
        /* .tg__items{
            width: 100%;
         
            box-sizing: border-box;
            height: 500px;
           
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        } */
        .tg__social { margin-top: inherit !important; }
        .tg__slider.owl-carousel .owl-item.active .tg__text h6 {  top: 0; opacity: 1; }
        .tg__text h6 {
            color: #005eb8;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 28px;
            position: relative;
            top: 100px;
            opacity: 0;
            -webkit-transition: all, 0.3s;
            -o-transition: all, 0.3s;
            transition: all, 0.3s;
        }
        .tg__text h2 {
            color: #111111;
            font-size: 48px;
            font-weight: 700;
            line-height: 58px;
            margin-bottom: 30px;
            position: relative;
            top: 100px;
            opacity: 0;
            -webkit-transition: all, 0.6s;
            -o-transition: all, 0.6s;
            transition: all, 0.6s;
        }
        .tg__text p {
            font-size: 16px;
            line-height: 28px;
            margin-bottom: 35px;
            position: relative;
            top: 100px;
            opacity: 0;
            -webkit-transition: all, 0.9s;
            -o-transition: all, 0.9s;
            transition: all, 0.9s;
        }
        .tg__text .primary-btn { position: relative; top: 100px; opacity: 0; -webkit-transition: all, 1.1s; -o-transition: all, 1.1s; transition: all, 1.1s; }
        .product__item__text .sale_price {  color: #b7b7b7; font-size: 18px; font-weight: 400; margin-left: 10px; text-decoration: line-through; }

        .ftco-section { padding-bottom: 5em; }
        .blog__item__review { text-align: center; margin-bottom: 15px; font-size: 26px; font-weight: 600; }
        .testimony-wrap {
            display: block;
            position: relative;
            padding: 30px 20px;
            border: 1px solid rgba(0, 0, 0, 0.03);
            border-radius: 10px;
            -webkit-box-shadow: 0px 5px 21px -14px rgba(0, 0, 0, 0.14);
            -moz-box-shadow: 0px 5px 21px -14px rgba(0, 0, 0, 0.14);
            box-shadow: 0px 5px 21px -14px rgba(0, 0, 0, 0.14);
            background: #f5f5f5;
        }
        .testimony-wrap .user-img { min-width: 90px; height: 90px; border-radius: 50%; position: relative; }
        .user-img { background-size: cover; background-repeat: no-repeat; background-position: center center; }
        .review_strong {  font-size: 16px; color: #005eb8; display: block; }
        .testimony-wrap .name { font-weight: 500; font-size: 16px; margin-bottom: 0; }

        .banner__item { position: relative; overflow: hidden; }
        .banner__item__pic { float: right; }
        .banner__item__text { position: initial; display: inline-block; margin-top: 20px; }
        .banner__item__text h2 { color: #111111; font-weight: 700; margin-bottom: 10px; font-size: 26px; }


        .owl-nav button {
            position: absolute;
            top: 50%;
            background-color: #000;
            color: #fff;
            margin: 0;
            transition: all 0.3s ease-in-out;
        }
        .owl-nav button.owl-prev { left: 0; background: rgb(255 255 255 / 0%) !important;}
        .owl-nav button.owl-next { right: 0; background: rgb(255 255 255 / 0%) !important;}

        .owl-dots { text-align: center; padding-top: 1px; }
        .owl-dots button.owl-dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            display: inline-block;
            background: #ccc;
            margin: 0 3px;
        }
        .owl-dots button.owl-dot.active { background-color: #005eb8; }
        .owl-dots button.owl-dot:focus { outline: none; }
        .owl-nav button { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255, 255, 255, 0.38) !important; }
        span {position: relative; top: -5px; }
        .owl-nav button:focus { outline: none; }

        .product {padding-top: 50px; }
    </style>
<!-- #BeginEditable "bodytag" -->
    <!-- tg Section Begin -->
    <section class="tg">
        <div class="tg__slider owl-carousel">
            <!-- <div class="tg__items set-bg" data-setbg="<?=base_url('assete/theme/img/tg/tg-1.jpg')?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="tg__text">
                                <h6>New Arrival</h6>
                                <h2>Alkaline Water Purifier</h2>
								<p>เครื่องกรองน้ำอัลคาไลน์ไฟฟ้า เครื่องกรองน้ำอัลคาไลน์ไฟฟ้าแบบไม่มีถังดื่ม RO 4 ขั้นตอน</p>
                                <a href="alkaline-water-purifier-detail.html" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg__items set-bg" data-setbg="<?=base_url('assete/theme/img/tg/tg-2.jpg')?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="tg__text">
                                <h6>New Arrivaln</h6>
                                <h2>Electric Induction Cooker</h2>
                                <p>เตาแม่เหล็กไฟฟ้า2หัว เตาแม่เหล็กไฟฟ้า 2200วัตต์ เตาอินฟราเรด 85-280โวลต์</p>
                                <a href="electric-cooker-detail.html" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
    <!-- tg Section End -->

    <!-- Product Section Begin -->
    <!-- <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">สินค้าแนะนำ</li>
                        <li data-filter=".new-arrivals">สินค้าใหม่</li>
                        <li data-filter=".hot-sales">สินค้ายอดนิยม</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter ml-2 mr-2">
				
            </div>
        </div>
    </section> -->
    <!-- Product Section End -->
     <!-- new product spread version -->
     <?php $this->load->view('desktop/product_interest'); ?>
	  <section class="about spad body-padding" style="padding-top: 0px;padding-bottom:20px;">
	   <div class="container" style="margin-top:50px;padding-left:0px;padding-right:0px;">
    <span style="color: #2F2F2F;font-family:'Prompt', sans-serif;

    font-size: 20px;

    font-weight: bold;
    line-height: normal;">บริการอื่นๆ</span>
    <!-- แถวที่ 1 -->
    <div class="row">

    <div class="col-sm-4"  style="cursor:pointer;margin-top:20px;" onclick="redirectToPage('tg-help')">
            <div >
               
                <div class="product-title">วิธีการสั่งซื้อสินค้า</div>
            </div>
        </div>
        <div class="col-sm-4" style="cursor:pointer;margin-top:20px;" onclick="redirectToPage('register-product')" >
            <div >
          
                <div class="product-title">ตรวจสอบลงทะเบียนประกันสินค้า</div>
            </div>
        </div>

        <div class="col-sm-4"  style="cursor:pointer;margin-top:20px;" onclick="redirectToPage('service_maintain')">
            <div >
              
                <div class="product-title">บริการแจ้งซ่อมบำรุง</div>
            </div>
        </div>

        

    </div>

    <!-- แถวที่ 2 -->
    <div class="row" style="margin-top:20px;margin-bottom:20px;">

        <div class="col-sm-4"  style="cursor:pointer;" onclick="redirectToPage('review')">
            <div >
               
                <div class="product-title">รีวิวจากผู้ใช้งานจริง</div>
            </div>
        </div>


    </div>

</div>
</section>

    <!-- Instagram Section Begin -->
    <section class="about spad body-padding" style="padding-top: 0px;padding-bottom:20px;">
          <div class="container" style="padding-left:0px;padding-right:0px;">
          <span style="color: #2F2F2F;font-family:'Prompt', sans-serif;

    font-size: 20px;

    font-weight: bold;
    line-height: normal;">เกี่ยวกับเรา</span>
    </div>

        <div class="container" style="margin-top:20px">
             
            <div class="row">
                <div class="col-lg-8" style="padding:0px;">
					<div class="about__pic">
						<img src="<?=base_url('assete/theme/img/about/about-us.jpg')?>" alt="">
					</div>
                </div>
                <div class="col-lg-4 about-sec">
                    <div class="about__item">
                        <b>TG SMART LIFE Co., Ltd.</b>
                        <p><b>บริษัท ทีจี สมาร์ท ไลฟ์ จํากัด</b> ดำเนินการธุรกิจประเภท ผลิต และจำหน่าย เครื่องใช้ไฟฟ้าในครัวเรือน ภายใต้แบรนด์ TG Smart Life Smart Home เป็นบริษัทผู้นำทางด้านนวัตกรรมล้ำสมัยจำหน่ายสินค้าประเภทผลิตภัณฑ์มีดังนี้  เครื่องเคหภัณฑ์ครัวเรือน เฟอร์นิเจอร์เครื่องแก้ว เตาแม่เหล็กไฟฟ้า เครื่องครัวสแตนเลสหม้อหุนแรงดันไฟฟ้า เครื่องฟอกอากาศ  เครื่องทําความเย็น เตาอบไมโครเวฟเตารีดไฟฟ้าเครื่องดูดอากาศ   เครื่องใช้ไฟฟ้า อุปกรณ์ไฟฟ้า  แผงโซล่าเชล ผลิตภัณฑ์ได้รับการออกแบบมาเพื่อให้สดคล้องกับชีวิตไลฟ์สไตล์ของคนรุ่นใหม่  เพื่อเป็นการตอบสนองความต้องการของลูกค้าให้ครอบคลุมทุกกลุ่มในรูปแบบ 'Digital Green Revolution'
						</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest body-padding" style="background: #EFEFEF;">
        <div class="container">
            <div class="row">
                 <span style="color: #2F2F2F;font-family:'Prompt', sans-serif;

    font-size: 20px;
        margin-top:20px;
    font-weight: bold;
    line-height: normal;">ข่าวสารและองค์ความรู้</span>
            </div>
            <div class="row knowledfge-position" style="margin-top: 20px;">
               
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

	<section class="ftco-section body-padding" style="margin-top:20px;">
		<div class="container">
			  <span style="color: #2F2F2F;font-family:'Prompt', sans-serif;

    font-size: 20px;

    font-weight: bold;
    line-height: normal;">ริวิวจากลูกค้า</span>
             
        </div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<div class="featured-carousel owl-carousel">
						
                        <div class="item">
                			<div class="testimony-wrap d-flex">
                  				<div class="user-img" style="background-image: url(img/review/profile-review-01.jpg)"></div>
                  				<div class="text pl-4">
                  					<span class="quote d-flex align-items-center justify-content-center">
                      					<i class="ion-ios-quote"></i>
                   	 				</span>
                    				<p>"ฉันใช้ระบบน้ำ Water Purifier UF รุ่น TG SMART LIFE เป็นเวลาหลายปีแล้วและฉันหาว่ามันเป็นเครื่องมือที่สำคัญในบ้านของฉัน! ระบบกรอง UF ทำงานได้อย่างมี ประสิทธิภาพในการกรอง ฉันรู้สึกมั่นใจในคุณภาพของน้ำ"</p>
                    				<p class="name review_strong">คุณ นวลจันทร์ แซ่ตัง</p>
                  				</div>
                			</div>
              			</div>
						<div class="item">
                			<div class="testimony-wrap d-flex">
                  				<div class="user-img" style="background-image: url(img/review/profile-review-02.jpg)"></div>
                  				<div class="text pl-4">
                  					<span class="quote d-flex align-items-center justify-content-center">
                      					<i class="ion-ios-quote"></i>
                   	 				</span>
                    				<p>"ผมใช้ระบบน Water Purifier UF รุ่น TG SMART LIFE ในบ้านของผมมานานหลายเดือนและฉันประทับใจกับประสิทธิภาพที่มันนำเสนอ! น้ำที่ได้มาหลังจากกระบวนการกรองมีรสชาติที่ดีและไม่มีกลิ่นแปลกๆ"</p>
                    				<p class="name review_strong">คุณสกุลยา ยาดี</p>
                  				</div>
                			</div>
              			</div>
						<div class="item">
                			<div class="testimony-wrap d-flex">
                  				<div class="user-img" style="background-image: url(img/review/profile-review-04.jpg)"></div>
                  				<div class="text pl-4">
                  					<span class="quote d-flex align-items-center justify-content-center">
                      					<i class="ion-ios-quote"></i>
                   	 				</span>
                    				<p>"ฉันใช้ระบบน Water Purifier UF รุ่น TG SMART LIFE ในบ้านของฉันมาเป็น เวลาสั้น แต่มันก็ได้แสดงให้ฉันเห็นความสามารถที่ดีในการกรองน ! น้ำ ที่ได้มาหลัง จากกระบวนการกรองมีรสชาติสดชื่นและมีคุณภาพดี"</p>
                    				<p class="name review_strong">คุณ ทมยันต์ อยู่สิน</p>
                  				</div>
                			</div>
              			</div>
						<div class="item">
                			<div class="testimony-wrap d-flex">
                  				<div class="user-img" style="background-image: url(img/review/profile-review-05.jpg)"></div>
                  				<div class="text pl-4">
                  					<span class="quote d-flex align-items-center justify-content-center">
                      					<i class="ion-ios-quote"></i>
                   	 				</span>
                    				<p>เครื่องกรองน้ำ อัลคาไลน์ไฟฟ้ามีระบบกรองที่ออกแบบมาให้มีความสามารถในการก รองน้ำ อย่างไวและมีประสิทธิภาพสูง ด้วยเทคโนโลยีการกรองที่ละเอียดและมีพื้นที่ การกรองมากกว่าเครื่องกรองน้ำ ทั่วไปและมีมาตรฐาน nsf รับรองผลิตภัณฑ์ค่ะ</p>
                    				<p class="name review_strong">คุณละเอียด ศรีนาค</p>
                  				</div>
                			</div>
              			</div>
					</div>
				</div>
			</div>
		</div>
	</section>

     <!-- <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about__pic">
                        <img src="<?=base_url('assete/theme/img/about/all-1.png')?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__item">
    
                        <p> การชำระเงินสินค้าได้หลายช่องทางไม่ว่าจะเป็นออนไลน์หรือออฟไลน์ อาทิ เช่น บัตรเดบิต บัตรเครดิต Mobile Banking, QR Code, True Money Wallet, AliPay, WeChat Pay ,ธนาคารกรุงเทพ,ธนาคารกสิกรไทย,ธนาคารกรุงไทย,ธนาคารทหารไทยธนชาต ,    ธนาคารไทยพาณิชย์ ,ธนาคารกรุงศรีอยุธยา ,ธนาคารเกียรตินาคินภัทร,ธนาคารซีไอเอ็มบีไทย,ธนาคารทิสโก้,ธนาคารยูโอบี ,ธนาคารไทยเครดิต,ธนาคารแลนด์ แอนด์ เฮ้าส์ ,ธนาคารไอซีบีซี (ไทย) ,ธนาคารอาคารสงเคราะห์,ธนาคารออมสิน,ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร ตลอดจน Counter Service ทุกสาขา เรียกว่าเป็นฟังก์ชั่นใหม่ที่ตอบโจทย์ลูกค้าให้สามารถชำระเงินได้สะดวกมากขึ้น  ท่านสามารถผ่อนกันยาวๆสูงสุด 36 เดือน ผ่านบัตร
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<!-- #EndEditable -->


<script src="<?=base_url('assete/js/add_to_cart.js')?>"></script>
  
<script>

 
    var base_url = "<?=base_url();?>";
    addToCartMember(); // add to cart when init this page if get any product on data storage : bp
    

// ฟังก์ชันสำหรับปรับความสูงของสไลด์ทั้งหมด
function adjustAllSlideHeights(base_url) {
    $('.tg__items').each(function() {
        var $slideDiv = $(this);
        var imageUrl = $slideDiv.attr('data-setbg');

        // 1. โหลดรูปภาพผ่าน JS เพื่อให้ได้ขนาดจริง (Natural Dimensions)
        var tempImage = new Image();
        tempImage.onload = function() {
            var naturalWidth = this.naturalWidth;
            var naturalHeight = this.naturalHeight;

            if (naturalWidth > 0 && naturalHeight > 0) {
                // 2. คำนวณสัดส่วน (Aspect Ratio) เป็นเปอร์เซ็นต์
                // สูตร: (ความสูงจริง / ความกว้างจริง) * 100
                var aspectRatioPercentage = (naturalHeight / naturalWidth) * 100;

                // 3. กำหนดความสูงโดยใช้ Padding Top Hack 
                // ซึ่งจะคำนวณความสูงตามความกว้างของ Div แม่ (80vw)
                $slideDiv.css({
                    'padding-top': aspectRatioPercentage + '%',
                    'height': '0' // ยืนยันว่า height เป็น 0 เพื่อให้ padding-top ทำงาน
                });
            }
        };
        // เริ่มโหลดรูปภาพ
        tempImage.src = imageUrl; 
    });
}

// ใช้งานฟังก์ชัน
$(document).ready(function() {
   
      adjustAllSlideHeights(base_url); 
    $(window).resize(function() {
       
         adjustAllSlideHeights(base_url); 
    });
});

    function redirectToPage(page){
         window.location.href = "<?= base_url('') ?>" + page;
    }
    function redirectToProducts(categoryId){
        window.location.href = "<?= base_url('products?category_id=') ?>" + categoryId;

    }
    function redirectToKnowledge(url){
        window.location.href = url;
    }
    draw_tg_slide(base_url);
function draw_tg_slide(base_url){
    //###  ressults ###//
    var results = get_tg_slide_results(base_url);
    console.log(results);
    var contents = '';
    if(results.datas.length > 0){
        $.each( results.datas, function( key, val ) {

            var imgs = (val.path != '')? base_url+val.path+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
            
          
            contents += '<div class="slide-padding-container">'; 

          
            contents += '<div class="tg__items set-bg" data-setbg="'+imgs+'">';
           

            contents += '</div>';
            
            contents += '</div>'; // ปิด Div ครอบ
        });
        var position = '.tg .tg__slider';
        $(position).html(null);
        $(position).html(contents);
    }
}
    function get_tg_slide_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_home_tg_slide_results', //ทำงานกับไฟล์นี้
            data: '',  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                console.log(data);
                res = data;
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        return res;
    }

    //## drawroducts ##//
    drawroducts(base_url);
    function drawroducts(base_url){
        //###  ressults ###//
        var results = get_results(base_url);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {
                // <div class="col-lg-4 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                //     <div class="product__item" onclick="location.href='air-purifier-ozone-detail.html';">
                //         <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-8.jpg')?>">
                //             <span class="label">New!</span>
                //             <ul class="product__hover">
                //                 <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                //                 <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                //             </ul>
                //         </div>
                //         <div class="product__item__text">
				// 			<h6>เครื่องฟอกอากาศระบบสัมผัส</h6>
                //             <span>ราคา  <b class="h5 fw-7 text-danger">54,000.00 บาท</b></span>
                //         </div>
                //     </div>
                // </div>
                
                //### product tag ###//
                var products_tags = get_products_tag(base_url, val.tag);
                var filter_tag = '';
                if(val.tag != null && val.tag != ''){
                    if(products_tags.datas.length > 0){
                        $.each( products_tags.datas, function( key, tag ) {
                            filter_tag += " product-tag-"+tag.id;
                        });
                    }
                }

                contents += '<div class="col-lg-4 col-md-6 col-sm-6 col-md-6 col-sm-6 mix '+filter_tag+' ">';
                contents += '<a href="'+base_url+'product_detail/'+val.id+'" style="color: #111111;">';
                contents += '<div class="product__item">';
                contents += '<div class="product__item__pic set-bg" data-setbg="'+base_url+'/'+val.thumnal+'?random='+Math.random()+'">';
                //### product tag ###//
                if(val.tag != null && val.tag != ''){
                    if(products_tags.datas.length > 0){
                        var tag_top = 10;
                        $.each( products_tags.datas, function( key, tag ) {
                            var tag_styles = 'style="background: '+tag.backgroundcolor+'; top: '+tag_top+'px;"';
                            contents += '<span class="label" '+tag_styles+'>'+tag.name+'</span>';
                            tag_top += 25;
                        });
                    }
                }
                contents += '</div>';

                contents += '<div class="product__item__text">';
                contents += '<h6>'+val.name+'</h6>';
                var price_html = '';
                if((val.saleprice != null && val.saleprice != '') && val.saleprice > 0){
                    price_html = '<span>ราคา  <b class="h5 fw-7 text-danger">'+addCommas(val.saleprice)+' บาท</b></span><span class="sale_price">฿'+addCommas(val.price)+'<span>';
                }else{
                    price_html = '<span>ราคา  <b class="h5 fw-7 text-danger">'+addCommas(val.price)+' บาท</b></span>';
                }
                contents += price_html;

                contents += '</div>';
                contents += '</div>';
                contents += '</a>';

                 // เพิ่ม input เพิ่มจำนวนสินค้า 
                 contents += `<div class="form-increase d-flex align-items-center">
                <button class="value-button btn btn-light mt-auto" id="decrease_${val.id}" onclick="decreaseValue(${val.id})" value="Decrease Value">-</button>
                <input type="number" id="number_${val.id}" class="numberCart form-control mt-auto" value="1" style="margin: 0;">
                <button class="value-button btn btn-light mt-auto" id="increase_${val.id}" onclick="increaseValue(${val.id})" value="Increase Value">+</button>
                <button class="btn btn-primary ml-4 ml-md-auto addtocart d-flex align-items-center" style="height:40px;" onclick="addToCart(${val.id})">เพิ่มไปยังรถเข็น</button>
            </div>`;

            
                contents += '</div>';

                
            });
            var position = '.product .product__filter';
            $(position).html(null);
            
            $(position).html(contents);
        }
    }

   
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_home_products_results', //ทำงานกับไฟล์นี้
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
    function get_products_tag(base_url, tag){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_products_tag', //ทำงานกับไฟล์นี้
            data: {
                'tag':tag
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
  //## drawproducttags ##//
    drawproducttags(base_url);
    function drawproducttags(base_url){
        //###  tag ###//
        var product_tags = get_product_tags(base_url);
        var tags = '';
        if(product_tags.datas.length > 0){
            tags += '<li class="active" data-filter="*">สินค้าทั้งหมด</li>';
            $.each( product_tags.datas, function( key, val ) {
                
                var filter_class = ".product-tag-"+val.id;
                tags += '<li data-filter="'+filter_class+'">'+val.name+'</li>';
            });
        }
        var tags_position = '.product .filter__controls';
        $(tags_position).html(null);
        $(tags_position).html(tags);

    }
    function get_product_tags(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_product_tags_used', //ทำงานกับไฟล์นี้
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
    function addCommas(numberString) {
        numberString += '';
        var x = numberString.split('.'),
            x1 = x[0],
            x2 = x.length > 1 ? '.' + x[1] : '',
            rgxp = /(\d+)(\d{3})/;

        while (rgxp.test(x1)) {
            x1 = x1.replace(rgxp, '$1' + ',' + '$2');
        }

        return x1 + x2;
    }

    //## drawproducttype ##//
    drawproducttype(base_url);
    function drawproducttype(base_url){
        //###  ressults ###//
        var results = get_producttype_results(base_url);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {
                //contents += '<div class="col-lg-7 offset-lg-4">';
                contents += '<div class="col-lg-4">';
                contents += '<div class="banner__item">';
                contents += '<div class="banner__item__pic">';
                var imgs = (val.thumnal != '')? base_url+val.thumnal+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
                contents += '<img src="'+imgs+'" alt="">';
                contents += '</div>';
                contents += '<div class="banner__item__text">';
                contents += '<h2>'+val.name+'</h2>';
                contents += '<a href="'+val.link+'">Shop now</a>';
                contents += '</div>';
                contents += '</div>';
                contents += '</div>';
            });
            var position = '#product-type-position';
            $(position).html(null);
            $(position).html(contents);
        }
    }
    function get_producttype_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_producttype_results', //ทำงานกับไฟล์นี้
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

    //## drawknoeledges ##//
    drawknoeledges(base_url);
    function drawknoeledges(base_url){
    var results = get_knoeledges_results(base_url);
    var contents = '';
    
    if(results.datas.length > 0){
        $.each( results.datas, function( key, val ) {
            var imgs = (val['path'] != '') ? base_url + val.picture + '?random=' + Math.random() : base_url + '/uploads/DocumentTh.png';
            
            contents += '<div class="col-lg-4 col-md-6 col-sm-4" style="cursor:pointer; margin-bottom: 25px;" onclick="redirectToKnowledge(\'' + base_url + 'knowledge_detail/' + val.id + '\')">';
            
            contents += '<div class="knowledge-card" style="position: relative; height: 350px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">';

            contents += '<img src="' + imgs + '" style="width: 100%; height: 100%; object-fit: cover; display: block;">';
        
            contents += '<div class="overlay-text" style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0, 0, 0, 0.6); padding: 15px; color: white; transition: 0.3s;">';
            contents += '<h5 style="color: white; font-size: 16px; margin-bottom: 10px; font-weight: 500; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">' + val.topic + '</h5>';
            contents += '<span class="primary-link-btn" style="font-size: 12px; padding: 4px 10px;">อ่านเพิ่มเติม ></span>';
            contents += '</div>';

            contents += '</div>';
            contents += '</div>'; 
        });
        
        var position = '.knowledfge-position';
        $(position).html(null).html(contents);
    }
}
    /*
    function drawknoeledges(base_url){
    //###  ressults ###//
    var results = get_knoeledges_results(base_url);
    var contents = '';
    
    if(results.datas.length > 0){
        $.each( results.datas, function( key, val ) {
            
            // 💡 1. URL รูปภาพ
            var imgs = (val['path'] != '') ? base_url + val.picture + '?random=' + Math.random() : base_url + '/uploads/DocumentTh.png';
            
            // 💡 2. เพิ่ม margin-bottom: 20px; เข้าไปใน div.col
            contents += '<div class="col-lg-4 col-md-6 col-sm-4" style="cursor:pointer; margin-bottom: 20px;" onclick="redirectToKnowledge(\'' + base_url + 'knowledge_detail/' + val.id + '\')">';
            
            // 💡 3. ใช้ product-box และใส่ Inline Style
            contents += '<div class="product-box" style="height: 350px; background-color: #f0f0f0; border-radius: 4px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; flex-direction: column;">';

            // 💡 4. รูปภาพ
            contents += '<img src="' + imgs + '" style="width: 100%; height: 100%; object-fit: cover; flex-grow: 1;" class="img-responsive">';
            
            // 💡 5. product-title
            contents += '<div class="product-title" style="background:white;padding: 10px 15px; text-align: left; font-weight: 500; font-size: 16px; color: #111; flex-shrink: 0;">';
            contents += '<h5>' + val.topic + '</h5>';
            contents += '<span onclick=redirectToKnowledge("'+base_url+'knowledge_detail/'+val.id+'") style="margin-top:20px;" class="primary-link-btn">อ่านเพิ่มเติม ></span>';
            contents += '</div>';

            contents += '</div>'; // ปิด div.product-box
            contents += '</div>'; // ปิด div.col
            
        });
        
        var position = '.knowledfge-position';
        $(position).html(null);
        $(position).html(contents);
    }
}
    */
// function drawknoeledges(base_url){
//     //###  ressults ###//
//     var results = get_knoeledges_results(base_url);
//     var contents = '';
    
//     if(results.datas.length > 0){
//         $.each( results.datas, function( key, val ) {
            
//             // 💡 1. URL รูปภาพ
//             var imgs = (val['path'] != '') ? base_url + val.picture + '?random=' + Math.random() : base_url + '/uploads/DocumentTh.png';
          
//             contents += '<div class="col-lg-4 col-md-6 col-sm-4 knowledge-wrapper" style="cursor:pointer;" onclick="redirectToKnowledge(\'' + base_url + 'knowledge_detail/' + val.id + '\')">';
            
//             contents += '<div class="product-box" style="height: 350px; background-color: #f0f0f0; border-radius: 4px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; flex-direction: column;">';

//             contents += '<img src="' + imgs + '" style="width: 100%; height: 100%; object-fit: cover; flex-grow: 1;" class="img-responsive">';
       
//             contents += '<div class="product-title" style="background:white;padding: 10px 15px; text-align: left; font-weight: 500; font-size: 16px; color: #111; flex-shrink: 0;">';
//             contents += '<h5>' + val.topic + '</h5>';
//             contents += '<span onclick=redirectToKnowledge("'+base_url+'knowledge_detail/'+val.id+'") style="margin-top:20px;" class="primary-link-btn">อ่านเพิ่มเติม ></span>';
//             contents += '</div>';

//             contents += '</div>'; 
//             contents += '</div>'; 
            
//         });
        
//         var position = '.knowledfge-position';
//         $(position).html(null);
//         $(position).html(contents);
//     }
// }




//     function drawknoeledges(base_url){
//         //###  ressults ###//
//         var results = get_knoeledges_results(base_url);
//         var contents = '';
//         if(results.datas.length > 0){
//             $.each( results.datas, function( key, val ) {
//                 contents += '<div class="col-lg-4 col-md-6 col-sm-6">';
//                 contents += '<div class="blog__item">';

//                 var imgs = (val['path'] != '')? base_url+val.picture+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
//                 contents += '<div class="blog__item__pic set-bg" data-setbg="'+imgs+'"></div>';
//                 contents += '<div class="blog__item__text">';
//                 contents += '<span><img src="'+base_url+'assete/theme/img/icon/calendar.png" alt=""> '+val.created+'</span>';
//                 contents += '<h5>'+val.topic+'</h5>';
//                // contents += '<a href="'+base_url+'knowledge_detail/'+val.id+'" style="background:#3293F0;color:white;">อ่านเพิ่มเติม ></a>';
              
// contents += '<span onclick=redirectToKnowledge("'+base_url+'knowledge_detail/'+val.id+'") class="primary-link-btn">อ่านเพิ่มเติม ></span>';


// contents += '</div>';
//                 contents += '</div>';
//                 contents += '</div>';
//             });
//             var position = '.knowledfge-position';
//             $(position).html(null);
//             $(position).html(contents);
//         }
//     }
   
   
    function get_knoeledges_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_home_knowledge_results', //ทำงานกับไฟล์นี้
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

    //## drawreview ##//
    drawreview(base_url);
    function drawreview(base_url){
        //###  ressults ###//
        var results = get_review_results(base_url);
        console.log(results);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {

                contents += '<div class="item">';
                contents += '<a href="'+base_url+'review_detail/'+val.id+'">';
                contents += '<div class="testimony-wrap d-flex">';
                var imgs = (val.picture != '')? base_url+val.picture+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
                contents += '<div class="user-img" style="background-image: url('+imgs+')"></div>';
                contents += '<div class="text pl-4">';
                contents += '<span class="quote d-flex align-items-center justify-content-center">';
                contents += '<i class="ion-ios-quote"></i>';
                contents += '</span>';
                contents += '<p>'+val.sub_header.slice(0, 75) + '...'+'</p>';
                contents += '<p class="name review_strong">'+val.topic+'</p>';
                contents += '</div>';
                contents += '</div>';
                contents += '</a>';
                contents += '</div>';
            });
            var position = '.featured-carousel';
            $(position).html(null);
            $(position).html(contents);
        }
    }
    function get_review_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_review_results', //ทำงานกับไฟล์นี้
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

    //###  SEO ##//
    //drawseo(base_url);
    function drawseo(base_url){
        var get_seo = get_seo_once(base_url);
        if(get_seo.datas.length > 0){  
            var resulted =   get_seo.datas[0];

            $('head title').html(resulted.seo_title);
            $('head meta[name="keywords"]').attr('content', resulted.seo_keyword);
            $('head meta[name="description"]').attr('content', resulted.seo_description);
            
            $('head meta[property="og:url"]').attr('content', $(location).attr('href'));
            $('head meta[property="og:title"]').attr('content', resulted.seo_title);
            $('head meta[property="og:description"]').attr('content', resulted.seo_description);
            
            // if(reslt.thumnal != null && reslt.thumnal != ''){
            //     $('head meta[property="og:image"]').attr('content', base_url+'/'+reslt.thumnal+'?random='+Math.random());
            // }
        }
    }
    function get_seo_once(base_url, $id){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_seo_once', //ทำงานกับไฟล์นี้
            data: {'id': 1 },  // 1 = home
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