 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-blog set-bg" data-setbg="<?=base_url('assete/theme/img/breadcrumb-bg.jpg')?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>KNOWLEDGE</h2>
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
            <!-- <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/blog/blog-1.jpg')?>"></div>
                        <div class="blog__item__text">
                            <span><img src="<?=base_url('assete/theme/img/icon/calendar.png')?>" alt=""> October 01, 2022</span>
                            <h5>งานแสดงสินค้า TG SMART LIFE 2022</h5>
                            <a href="blog-detail.html">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/blog/blog-2.jpg')?>"></div>
                        <div class="blog__item__text">
                            <span><img src="<?=base_url('assete/theme/img/icon/calendar.png')?>" alt="">October 02, 2022</span>
                            <h5>ทีจี สมาร์ท ไลฟ์ ออนทัวร์ ช็อปสนั่น ส่งท้ายปี</h5>
                            <a href="blog-detail.html">Read More</a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/blog/blog-3.jpg')?>"></div>
                        <div class="blog__item__text">
                            <span><img src="<?=base_url('assete/theme/img/icon/calendar.png')?>" alt="">November 05, 2022</span>
                            <h5>ทีจี สมาร์ท ไลฟ์ บูธ @ เทสโก้โลตัส สุขาภิบาล 1</h5>
                            <a href="blog-detail.html">Read More</a>
                        </div>
                    </div>
                </div>
            </div> -->
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
                    
                    contents += '<div class="col-lg-4 col-md-6 col-sm-6 mix filtercate'+val.product_cate+'"">';
                    contents += '<div class="blog__item">';

                    var imgs = (val['path'] != '')? base_url+val.picture+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
                    contents += '<div class="blog__item__pic set-bg" data-setbg="'+imgs+'"></div>';
                    contents += '<div class="blog__item__text">';
                    contents += '<span><img src="'+base_url+'assete/theme/img/icon/calendar.png" alt=""> '+val.created+'</span>';
                    contents += '<h5>'+val.topic+'</h5>';
                    contents += '<a href="'+base_url+'knowledge_detail/'+val.id+'">Read More</a>';
                    contents += '</div>';
                    contents += '</div>';
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
                url: base_url+'Main/get_knowledge_results', //ทำงานกับไฟล์นี้
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