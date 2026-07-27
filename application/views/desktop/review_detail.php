<!-- #BeginEditable "bodytag" -->
<style>
    .blog-details-gallery, .image-position{
        min-width: 100%;

    }
    iframe{
        max-width: 100%;
    }
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Review</h4>
                    <div class="breadcrumb__links">
                        <a href="<?=base_url();?>">หน้าแรก</a>
                        <a href="<?=base_url('review');?>">รีวิว</a>
                        <span>BigC กัลปพฤกษ์</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Blog Details tg Begin -->
<section class="blog-tg" style="padding-bottom: 60px;">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__tg__text">
                    <h2>BigC กัลปพฤกษ์</h2>
                    <span>BigC กัลปพฤกษ์</span>
                    <ul>
                        <li>July 01, 2023</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details tg End -->




<!-- Blog Details Section Begin -->
<section class="blog-details spad" style="margin-top: 0%;">
    <div class="container">
        <div class="row">
        <div class="blog-details-gallery justify-content-center">
            <div class="d-flex flex-column detail-position"></div>
            <!-- <div class="d-flex flex-column">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img01.jpg">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img02.jpg">
            </div>
            <div class="d-flex flex-column">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img03.jpg">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img04.jpg">
            </div> -->
        </div>
        </div>
    </div>
</section>

<!-- #EndEditable -->
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
        <div class="blog-details-gallery justify-content-center">
            <div class="d-flex flex-column image-position"></div>
            <!-- <div class="d-flex flex-column">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img01.jpg">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img02.jpg">
            </div>
            <div class="d-flex flex-column">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img03.jpg">
                <img class="img-fluid" src="img/blog/bigc-kanlapaphruek/bigc-kanlapaphruek-img04.jpg">
            </div> -->
        </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<script>
    var base_url = "<?=base_url();?>";
    
    drawcontens(base_url);
    function drawcontens(base_url){

        
        //###  ressults ###//
        var results = get_results(base_url);
        var contents = '';
        if(results.datas.length > 0){
            //### link ###//
            $('.breadcrumb-option .breadcrumb__links span').html(results.datas[0].topic);
            
            //### .blog-tg ###//
            $('.blog-tg .blog__tg__text h2').html(results.datas[0].topic);
            $('.blog-tg .blog__tg__text span').html(results.datas[0].sub_header);
            $('.blog-tg .blog__tg__text ul li').html(results.datas[0].created);
        }

        //###  images ###//
        var review_images = get_review_images(base_url);
        var img = '';
        if(review_images.datas.length > 0){
            img += '<div class="row">';
            $.each( review_images.datas, function( key, val ) {
                img += '<div class="col-md-6">';
                // img += '<img class="img-fluid" src="'+base_url+'/'+val.path+'?random='+Math.random()+'" style="width: 100%; height: auto;">';
                img += '<img class="img-fluid" src="'+base_url+'/'+val.path+'?random='+Math.random()+'" style="width: 350px; height: auto;">'; // add on 20231021 
                img += '</div>';
            });
            img += '</div>';
        }
        var image_position = '.image-position';
        $(image_position).html(null);
        $(image_position).html(img);

        //###  detail ###//
        if(results.datas.length > 0){
            //### link ###//
            $('.blog-details .detail-position').html(results.datas[0].detail);
        }
    }
    function get_results(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_review_once', //ทำงานกับไฟล์นี้
            data: {'id':"<?=$id;?>"},  //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async:false,
            success: function(data, status) {
                res = data;
                console.log(data);
            },
            error: function(xhr, status, exception) { 
                //console.log(xhr);
            }
        });
        return res;
    }
    function get_review_images(base_url){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_review_images', //ทำงานกับไฟล์นี้
            data: {'id':"<?=$id;?>"},  //ส่งตัวแปร
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