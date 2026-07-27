<!-- #BeginEditable "bodytag" -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css"> -->
    <!-- <script src="http://flaviusmatis.github.io/simplePagination.js"></script> -->

    
	<!-- <script src="<?=base_url('assete/Any-Content-Pagination-Plugin-For-jQuery-paginga/paginga.jquery.js')?>"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
   
    <style>
        .category-loader-spin {
            width: 40px;
            height: 40px;
            opacity: 1; 
            display: block;
            width: 13px; 
            height: 13px;
            border-radius: 60px;
            margin-left: 8px;
            margin-top: 6px;
            animation: loader 0.8s linear infinite;
            -webkit-animation: loader 0.8s linear infinite;
        }
        .category-active{border-bottom: 3px solid #e53637;}
        .show { display: block; }
        .product__item__text h6{
            font-size: 13px;
        }
        .product__item__text .sale_price{
            color: #b7b7b7;
            font-size: 15px;
            font-weight: 400;
            margin-left: 10px;
            text-decoration: line-through;
        }
        .product__item__text h6 {
            margin-bottom: 5px;
        }
        
		/* * {font-family: sans-serif; }  */
		.items div  { /* border: 1px solid gray; margin: 5px; padding: 10px; */ }
		/* .pager div { float: left; border: 1px solid #e5e5e5; margin: 5px; padding: 10px; border-radius: 3px;}
		.pager div.disabled { opacity: 0.25; }
		.pager .pageNumbers a {display: inline-block; padding: 0 10px; color: gray; }
		.pager .pageNumbers a.active {color: orange; }
		.pager {overflow: hidden; }
		.paginate-no-scroll .items div { height: 250px; } */


        .simple-pagination ul {
            margin: 0 0 20px;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        .simple-pagination li {
            display: inline-block;
            margin-right: 5px;
        }

        .simple-pagination li a,
        .simple-pagination li span {
            color: #666;
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #EEE;
            background-color: #FFF;
            box-shadow: 0px 0px 10px 0px #EEE;
        }

        .simple-pagination .current {
            color: #FFF;
            background-color: #FF7182;
            border-color: #FF7182;
        }

        .simple-pagination .prev.current,
        .simple-pagination .next.current {
            background: #e04e60;
        }
	</style>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>ผลิตภัณฑ์</h4>
                        <div class="breadcrumb__links">
                            <a href="<?=base_url()?>">หน้าแรก</a>
                            <span>สินค้าทั้งหมด</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseProduct">ประเภทสินค้า</a>
                                    </div>
                                    <div id="collapseProduct" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <button class="btn drawcategory-btn" id="drawcategory-0"  style="display: flex;" data-caetegory-id = "0" onclick="eventCategory(0, 'drawcategory-0')">
                                                    <div class="drawcategorylabel drawcategory-label-0 category-active">สินค้าทั้งหมด</div> 
                                                    <div class="spin-area loader-spin-area-0 "></div>
                                                </button>
                                                <?php foreach($category as $item){?>
                                                    <button class="btn drawcategory-btn" id="drawcategory-<?=$item->id?>"  style="display: flex;" data-caetegory-id = "<?=$item->id?>" onclick="eventCategory(<?=$item->id?>, 'drawcategory-<?=$item->id?>')">
                                                        <div class="drawcategorylabel drawcategory-label-'+val.id+' "><?=$item->name?></div> 
                                                        <div class="spin-area loader-spin-area-'<?=$item->id?>' "></div>
                                                    </button>
                                                <?php }  ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 ">
                    <div class="row  product-contents">
                    </div>
                    <!-- <div id="pagination-area">
                        <div id="pagination-containers" class="light-theme simple-pagination">
                            <ul>
                                <li class="active"><span class="current prev">«</span></li>
                                <li class="active"><span class="current">1</span></li>
                                <li><a href="#page-2" class="page-link">2</a></li>
                                <li><a href="#page-3" class="page-link">3</a></li>
                                <li><a href="#page-4" class="page-link">4</a></li>
                                <li><a href="#page-5" class="page-link">5</a></li>
                                <li class="disabled"><span class="ellipse">…</span></li>
                                <li><a href="#page-19" class="page-link">19</a></li>
                                <li><a href="#page-20" class="page-link">20</a></li>
                                <li><a href="#page-2" class="page-link next">»</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <div id="pagination-area"></div>
                </div>
            </div>
        </div>
    </section>
<!-- #EndEditable -->
<script>
    var base_url = "<?=base_url();?>";
    
    $('.drawcategory-btn .category-loader-spin').css({"display": "none"});
    
    drawcontens(base_url, '');
    // paginationed('#pagination-container');
    function drawcontens(base_url,category_id){
        //###  ressults ###//
        var results = get_results(base_url,category_id);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {
                contents += '<div class="col-lg-4 col-md-6 col-sm-12 item">';
                contents += '<a href="'+base_url+'product_detail/'+val.id+'" style="color: #111111;">';
                contents += '<div class="product__item">';
                //contents += '<div class="product__item__pic set-bg" data-setbg="'+base_url+'/'+val.thumnal+'?random='+Math.random()+'" style="background-image: url('+base_url+'/'+val.thumnal+'?random='+Math.random()+');">';
                contents += '<div class="product__item__pic set-bg" data-setbg="'+base_url+'/'+val.thumnal+'" style="background-image: url('+base_url+'/'+val.thumnal+');">';
                
                //### product tag ###//
                if(val.tag != null && val.tag != ''){
                    var tag_top = 10;
                    var tag_styles = 'style="background: '+val.backgroundcolor+'; top: '+tag_top+'px;"';
                    contents += '<span class="label" '+tag_styles+'>'+val.tag_name+'</span>';
                    tag_top += 25;
                }
                // contents += '<ul class="product__hover">';
                // contents += '<li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>';
                // contents += '<li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>';
                // contents += '</ul>';
                contents += '</div>';
                contents += '<div class="product__item__text">';
                contents += '<h6>'+val.name+'</h6>';
                // contents += '<div class="add-cart add-cart-online">';
                // contents += '<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>';
                // contents += '<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>';
                // contents += '</div>';
                var price_html = '';
                if((val.saleprice != null && val.saleprice != '') && val.saleprice > 0){
                    price_html = '<span>ราคา  <b class="h6 fw-7 text-danger">'+addCommas(val.saleprice)+' บาท</b></span><span class="sale_price">฿'+addCommas(val.price)+'<span>';
                }else{
                    price_html = '<span>ราคา  <b class="h6 fw-7 text-danger">'+addCommas(val.price)+' บาท</b></span>';
                }
                contents += price_html;
                contents += '</div>';
                contents += '</div>';
                contents += '</a>';
                contents += '</div>';
            });

            var position = '.product-contents';
            $(position).html(null);
            $(position).html(contents);
        }

        $('.drawcategory-btn .spin-area').removeClass('category-loader-spin');
        $('#pagination-area').html('<div id="pagination-container"></div>');
        paginationed('#pagination-container');
    }
    function get_results(base_url,category_id){
        var res = null;
        $.ajax({
            url: base_url+'Main/get_products_results', //ทำงานกับไฟล์นี้
            data: {'category_id':category_id},  //ส่งตัวแปร
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
    function eventCategory(id, element) {
        $('#'+element).parent().find('.spin-area').removeClass('category-loader-spin');
        $('#'+element).parent().find('.drawcategorylabel').removeClass('category-active');
        $('#'+element).parent().find('.loader-spin-area-'+id).addClass('category-loader-spin');
        $('#'+element).parent().find('.drawcategory-label-'+id).addClass('category-active');
        drawcontens(base_url, id);
        //paginationed('#pagination-container');
    }
    
    // paginationed('#pagination-container');
    function paginationed(element) {
        var items = $(".product-contents .item");
        var numItems = items.length;
        var perPage = 1;
        items.slice(perPage).hide();
        $(element).pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
    }

</script>