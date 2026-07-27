 <!-- body-padding -->
  <section class="about spad body-padding" style="padding-top: 0px;padding-bottom:20px;">
 <div class="container " style="margin-top:50px;padding-left:0px;padding-right:0px;">
    <span style="color: #2F2F2F;font-family:'Prompt', sans-serif;

font-size: 20px;

font-weight: bold;
line-height: normal;" id="header_product_interest">ผลิตภัณฑ์ที่น่าสนใจ</span>

    <!-- แถวที่ 1 -->
    <div class="row" style="margin-top:20px">

        <div class="col-sm-4" style="cursor:pointer;" onclick="redirectToProducts('4')">
            <div class="product-box">
                <img src="<?=base_url('assete/theme/img/interest_1.png')?>" class="img-responsive">
                <div class="product-title">เครื่องกรองน้ำ</div>
            </div>
        </div>

        <div class="col-sm-4"  style="cursor:pointer;" onclick="redirectToProducts('9')">
            <div class="product-box">
                <img src="<?=base_url('assete/theme/img/interest_2.png')?>" class="img-responsive">
                <div class="product-title">เครื่องฟอกอากาศ</div>
            </div>
        </div>

        <div class="col-sm-4"  style="cursor:pointer;" onclick="redirectToProducts('11')">
            <div class="product-box">
                <img src="<?=base_url('assete/theme/img/interest_3.png')?>" class="img-responsive">
                <div class="product-title">เตาแม่เหล็กไฟฟ้า</div>
            </div>
        </div>

    </div>

    <!-- แถวที่ 2 -->
    <div class="row" style="margin-top:20px;margin-bottom:20px;">

        <div class="col-sm-4"  style="cursor:pointer;" onclick="redirectToProducts('12')">
            <div class="product-box">
                <img src="<?=base_url('assete/theme/img/interest_4.png')?>" class="img-responsive">
                <div class="product-title">Luxury Cookware Set</div>
            </div>
        </div>

        <div class="col-sm-4"  style="cursor:pointer;" onclick="redirectToProducts('10')">
            <div class="product-box">
                <img src="<?=base_url('assete/theme/img/interest_5.png')?>" class="img-responsive">
                <div class="product-title">โซล่าเซลล์</div>
            </div>
        </div>

    </div>
</div>
</section>

<script>
     function redirectToProducts(categoryId){
        window.location.href = "<?= base_url('products?category_id=') ?>" + categoryId;

    }
</script>