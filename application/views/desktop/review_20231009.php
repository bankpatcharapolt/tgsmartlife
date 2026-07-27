 <!-- Breadcrumb Section Begin -->
 <style>
    .blog__item__review { text-align: center; margin-bottom: 15px; font-size: 26px; font-weight: 600; }
    .blog__item__review span{color: #005eb8;}

    .filter__controls { text-align: center; margin-bottom: 45px; }

    .blog_review_box { display: flex; padding: 1em; background: #f5f5f5; border-radius: 5px; margin-bottom: 25px; }
    .blog_review_box p { font-size: 14px; font-family: "Prompt", sans-serif; color: #3d3d3d; font-weight: 400; margin-bottom: 0; line-height: 1.8; }
    .review_strong { font-size: 16px; color: #005eb8; display: block; }

 </style>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="<?=base_url('assete/theme/img/breadcrumb-bg.jpg')?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>REVIEW</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12"><ul class="filter__controls"></ul></div>
            </div>
            <div class="row product__filter"></div>
        </div>
    </section>
    <!-- Blog Section End -->

    <script>

        var base_url = "<?=base_url();?>";
        drawcontens(base_url);
        function drawcontens(base_url){

            //###  category ###//
            var product_category = get_product_category(base_url);
            var cate = '';
            if(product_category.datas.length > 0){
                cate += '<li class="active" data-filter="*">ทั้งหมด</li>';
                $.each( product_category.datas, function( key, val ) {
                    cate += '<li data-filter=".filtercate'+val.id+'">'+val.name+'</li>';
                });
                cate += '<li  data-filter=".filtercate99999">อื่นๆ</li>';
            }
            var cate_position = '.filter__controls';
            $(cate_position).html(null);
            $(cate_position).html(cate);

            //###  ressults ###//
            var results = get_results(base_url);
            var contents = '';
            if(results.datas.length > 0){
                $.each( results.datas, function( key, val ) {
                    contents += '<div class="col-12 mix filtercate'+val.product_cate+'">';
                    contents += '<a href="'+base_url+'review_detail/'+val.id+'">';
                    contents += '<div class="blog_review_box">';
                    var imgs = (val.picture != '')? base_url+val.picture+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
                    contents += '<img src="'+imgs+'" class="mr-2 rounded" alt="" width="100" height="100"> ';
                    contents += '<p>'+val.sub_header+'<strong class="review_strong">'+val.topic+'</strong> </p>';
                    contents += '</div>';
                    contents += '</a>';
                    contents += '</div>';
                });
                var position = '.product__filter';
                $(position).html(null);
                $(position).html(contents);
            }
        }
        function get_results(base_url){
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
        function get_product_category(base_url){
            var res = null;
            $.ajax({
                url: base_url+'Main/get_product_category_used', //ทำงานกับไฟล์นี้
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