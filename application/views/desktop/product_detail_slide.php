<div class="header d-flex flex-column align-items-center">
    </div>

<div class="col-lg-8 col-md-9" style="padding-left: 0; padding-right: 0;">
    <div id="owl-carousel-gallery-demo" class="owl-carousel owl-theme product-main-slider">
        </div>
    
    <div class="owl-controls-bottom">
        </div> 

    <div id="owl-carousel-thumbnails" class="owl-carousel owl-theme thumbnail-carousel">
        </div>
</div>

<style>

.owl-controls-bottom {
    position: relative; /* สำคัญ: เพื่อให้ .owl-controls-inner อ้างอิงได้ */
    display: flex;
    justify-content: center; /* จัด Inner Wrapper ให้อยู่ตรงกลาง */
    align-items: center;
    margin-top: 15px;
    height: 30px; 
    width: 100%;
}
.owl-controls-bottom .owl-controls-inner {
 
    width: auto; 
    position: relative; /* ให้ Arrows ในนี้อ้างอิงตำแหน่งได้ */
    display: flex;
    justify-content: center; /* จัดให้ Dots อยู่ตรงกลาง */
    align-items: center;
}

.owl-controls-bottom .owl-controls-inner .owl-nav {
  
    position: absolute !important; 
    z-index: 40; 
 
    width: 300px; 
    top:-10px !important;
   
    left: 50%;
    transform: translateX(-50%);
    
    display: flex;
    justify-content: space-between; 
    align-items: center;
    top: 0;

    margin: 0 !important; 
    padding: 0;
}
.owl-controls-bottom .owl-dots {
  
    margin: 0 !important;
    padding: 0; 
    z-index: 30; 
    
    display: flex; 
    justify-content: center;
}


.product-main-slider.owl-carousel .owl-nav {
    display: none !important;
}


.owl-controls-bottom .owl-nav button {
    width: 30px;
    height: 30px;
    background: transparent !important;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    color: #555;
    margin: 0;
    padding: 0;
    transition: all 0.2s;
    flex-shrink: 0; 
}
.owl-prev span{
    font-size: 20px;
}
.owl-next span{
    font-size: 20px;
}

.owl-controls-bottom .owl-dots {

    margin: 0;
   padding: 0 5px; 
    z-index: 20; 
    display: flex; 
   
    justify-content: center;
}
button.owl-dot{
     border:none;
    background-color: white;
}

.owl-controls-bottom .owl-dots .owl-dot span {
    width: 10px !important; 
    height: 10px !important; 
    margin: 0 4px !important; 
    border-radius: 50% !important; 
    background: #ccc !important; 
    display: block !important; 
}

.owl-controls-bottom .owl-dots .owl-dot.active span {
    background: #2D8EEA !important; 
}






/* 💡 New CSS for dynamic setup (Ensure correct column size) */
.product-main-slider.owl-carousel {
    max-width: 100%; /* ให้เต็มพื้นที่ column */
    margin: 0;
}
.thumbnail-carousel.owl-carousel {
    max-width: 100%;
    margin: 10px 0 0;
}
.owl-carousel-item img {
    height: 400px; /* กำหนดความสูงรูปภาพหลัก */
    width: 100%;
    object-fit: cover;
}
#owl-carousel-thumbnails .owl-carousel-item img {
    height: 80px; /* รูปย่อ */
    width: 100%;
    object-fit: cover;
}

</style>

<script>
// 💡 Note: คุณต้องแน่ใจว่าได้รวมไฟล์ LightGallery JS และ CSS ไว้ใน Template หลักแล้ว

/**
 * ฟังก์ชันหลักในการสร้าง Owl Carousel Gallery (Main Slider + Thumbnails)
 * ฟังก์ชันนี้จะถูกเรียกจาก products.php (drawcontens)
 * @param {Array} imageData - Array ของ Object รูปภาพ {id, path} ที่มาจาก get_product_images
 * @param {string} base_url - Base URL ของเว็บไซต์
 */
function buildCarouselGallery(imageData, base_url) {
    
    let $mainSlider = jQuery('#owl-carousel-gallery-demo');
    let $thumbnailSlider = jQuery('#owl-carousel-thumbnails');

    if (imageData.length === 0) {
        $mainSlider.html('<p>ไม่พบรูปภาพ</p>');
        $thumbnailSlider.empty();
        return;
    }

    let mainHTML = '';
    let thumbHTML = '';

    // 1. สร้าง HTML Markup แบบ Dynamic
    jQuery.each(imageData, function(index, item) {
        let imageUrl = base_url + '/' + item.path + '?random=' + Math.random();
        
        // HTML สำหรับ Main Slider (รูปใหญ่)
        mainHTML += `
            <a data-lg-size="1600-1200"
               class="owl-carousel-item"
               data-src="${imageUrl}"
            >
                <img class="img-responsive" src="${imageUrl}" alt="Slide ${index + 1}" />
            </a>
        `;

        // HTML สำหรับ Thumbnail Slider (รูปย่อ)
        thumbHTML += `
            <div class="owl-carousel-item" data-slide-index="${index}">
                <img class="img-responsive" src="${imageUrl}" alt="Thumb ${index + 1}" />
            </div>
        `;
    });

    // 2. ล้างข้อมูลเก่าและใส่ HTML ใหม่
    // ใช้ try/catch เพื่อป้องกัน error ถ้า Owl Carousel ยังไม่ได้ถูกสร้าง
    try {
        $mainSlider.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-theme');
        $thumbnailSlider.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-theme thumbnail-carousel');
    } catch (e) { /* ignore */ }
    
    $mainSlider.html(mainHTML).addClass('owl-carousel owl-theme product-main-slider');
    $thumbnailSlider.html(thumbHTML).addClass('owl-carousel owl-theme thumbnail-carousel');

    // 3. Initialise/Re-initialise Carousels
    let mainCarousel = $mainSlider.owlCarousel({
       items: 1,
        nav: true,          // เปิด Arrows
        dots: true,         // เปิด Dots
        loop: true,
        margin: 10,
     
      
        onInitialized: function(event) {
          // 💡 NEW: เมื่อ Carousel ถูกสร้างเสร็จแล้ว ให้ย้ายปุ่มควบคุมเข้าไปใน Container
          const $controlsBottom = jQuery('.owl-controls-bottom');
          
          // 💡 NEW: สร้าง div ภายในเพื่อห่อหุ้ม Arrows และ Dots
          const $controlsInner = jQuery('<div class="owl-controls-inner"></div>');
          
     // ตรวจสอบและย้าย Arrows (owl-nav)
     const $owlNav = $mainSlider.find('.owl-nav').first();
     if ($owlNav.length) {
       $controlsInner.append($owlNav);
     }
     
     // ตรวจสอบและย้าย Dots (owl-dots)
     const $owlDots = $mainSlider.find('.owl-dots').first();
     if ($owlDots.length) {
       $controlsInner.append($owlDots);
     }
          
          // เพิ่ม div ห่อหุ้มทั้งหมดลงใน Container หลัก
          $controlsBottom.append($controlsInner);
          // ซิงค์รูปย่อแรก
          $thumbnailSlider.find(`[data-slide-index="0"] img`).addClass('selected');
          // init LightGallery (ถ้ามี)
          // initLightGallery($mainSlider);
    },
        onTranslated: syncSliders 
    });

    let thumbnailCarousel = $thumbnailSlider.owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        items: 5,
        responsive: {
            0: { items: 3, margin: 5 },
            600: { items: 5 },
            1000: { items: 5 }
        }
    });
    
    // 4. ตั้งค่าเหตุการณ์ Click บน Thumbnails
    $thumbnailSlider.on('click', '.owl-carousel-item', function() {
        let index = jQuery(this).data('slide-index');
        // เปลี่ยนสไลด์หลัก
        mainCarousel.trigger('to.owl.carousel', [index, 300, true]); 
    });

    /**
     * ฟังก์ชันซิงค์เมื่อสไลด์หลักเปลี่ยน
     */
    function syncSliders(event) {
        let current = event.item.index;
        // คำนวณ index ที่ถูกต้อง
        let relativeIndex = event.relatedTarget.relative(current); 
        
        // ล้างสถานะ active และเน้นรูปย่อที่ถูกเลือก
        $thumbnailSlider.find('img').removeClass('selected');
        $thumbnailSlider.find(`[data-slide-index="${relativeIndex}"] img`).addClass('selected');
        
        // ซิงค์ตำแหน่งของ thumbnail slider
        thumbnailCarousel.trigger('to.owl.carousel', [relativeIndex, 300, true]);
    }
}
</script>