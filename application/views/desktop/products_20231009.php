<!-- #BeginEditable "bodytag" -->

    <style>
        .filterDiv { display: none; }
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
		.pager div { float: left; border: 1px solid #e5e5e5; margin: 5px; padding: 10px; border-radius: 3px;}
		.pager div.disabled { opacity: 0.25; }
		.pager .pageNumbers a {display: inline-block; padding: 0 10px; color: gray; }
		.pager .pageNumbers a.active {color: orange; }
		.pager {overflow: hidden; }
		.paginate-no-scroll .items div { height: 250px; }
    </style>
    <!-- Breadcrumb Section Begin -->
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
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
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
                                                <div id="myBtnContainer">
                                                    <!-- <button class="btn active" onclick="filterSelection('all')">สินค้าทั้งหมด</button>
                                                    <button class="btn" onclick="filterSelection('air-purifier-0-1-micron')">เครื่องฟอกอากาศไอออน 0.1 ไมครอน</button>
													<button class="btn" onclick="filterSelection('water-purifier-hot-cold')">เครื่องกรองน้ำระบบ ร้อน เย็น</button>
													<button class="btn" onclick="filterSelection('ro-water')">เครื่องกรองน้ำระบบ RO</button>
													<button class="btn" onclick="filterSelection('alkaline')">เครื่องกรองน้ำอัลคาไลน์</button>
                                                    <button class="btn" onclick="filterSelection('cooker')">เตาแม่เหล็กไฟฟ้า 2 หัว</button>
													<button class="btn" onclick="filterSelection('cookware')">ภาชนะ Luxury ชุดหม้อฝาแก้วสีฟ้า</button>
													<button class="btn" onclick="filterSelection('all')">สินค้า PREMIUMS</button>
													<button class="btn" onclick="filterSelection('all')">โปรโมชั่น</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTags">Tags</a>
                                    </div>
                                    <div id="collapseTags" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">เครื่องครัว</a>
                                                <a href="#">ผลิตภัณฑ์ครัวเรือน</a>
                                                <a href="#">เครื่องฟอกอากาศ</a>
                                                <a href="#">เตาแม่เหล็กไฟฟ้า</a>
                                                <a href="#">เครื่องฟอกอากาศ</a>
                                                <a href="#">อุปกรณ์ไฟฟ้า</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 paginate">
                    <div class="row items product-contents">
						<!-- <div class="col-lg-6 col-md-6 col-sm-6 filterDiv air-purifier-0-1-micron">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-6.jpg')?>">
									<span class="label">New!</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เครื่องฟอกอากาศไอออน 0.1 ไมครอน</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">43,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 filterDiv water-purifier-hot-cold">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-7.jpg')?>">
									<span class="label">New!</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เครื่องกรองน้ำระบบ ร้อน เย็น</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">43,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 filterDiv air-purifier">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-1.jpg')?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เครื่องฟอกอากาศ</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">43,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 filterDiv ro-water">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-4.jpg')?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เครื่องกรองน้ำระบบ RO</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">39,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 filterDiv alkaline">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-2.jpg')?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เครื่องกรองน้ำอัลคาไลน์</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">43,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 filterDiv cooker">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-3.jpg')?>">
									<span class="label">New!</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>เตาแม่เหล็กไฟฟ้า 2 หัว</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">39,999.00 บาท</b></span>
								</div>
                            </div>
                        </div>
						<div class="col-lg-6 col-md-6 col-sm-6 filterDiv cookware">
                            <div class="product__item sale">
                                <div class="product__item__pic set-bg" data-setbg="<?=base_url('assete/theme/img/product/product-5.jpg')?>">
									<span class="label">Sale!</span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/heart.png')?>" alt=""></a></li>
                                        <li><a href="#"><img src="<?=base_url('assete/theme/img/icon/search.png')?>" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
									<h6>ภาชนะ Luxury ชุดหม้อฝาแก้ว</h6>
									<div class="add-cart add-cart-online">
										<a href="#" class="add-cart-shopee"><img src="<?=base_url('assete/theme/img/shopee-logo.png')?>" alt=""></a>
										<a href="#" class="add-cart-lazada"><img src="<?=base_url('assete/theme/img/lazada-logo.png')?>" alt=""></a>
									</div>
									<span>ราคา  <b class="h5 fw-7 text-danger">39,999.00 บาท</b></span>
								</div>
                            </div>
                        </div> -->
                    </div>
                    <div class="pager">
                        <div class="firstPage" style="cursor: pointer;">&laquo;</div>
                        <div class="previousPage" style="cursor: pointer;">&lsaquo;</div>
                        <div class="pageNumbers" style="cursor: pointer;"></div>
                        <div class="nextPage" style="cursor: pointer;">&rsaquo;</div>
                        <div class="lastPage" style="cursor: pointer;">&raquo;</div>
                    </div>
                </div>
                <script>
                </script>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
<!-- #EndEditable -->
   
<script>

    var base_url = "<?=base_url();?>";
    drawcontens(base_url, '');
    function drawcontens(base_url,category_id){
        //###  ressults ###//
        var results = get_results(base_url,category_id);
        var contents = '';
        if(results.datas.length > 0){
            $.each( results.datas, function( key, val ) {
                contents += '<div class="col-lg-4 col-md-6 col-sm-12 filterDiv product-cate-'+val.category+' ">';
                contents += '<a href="'+base_url+'product_detail/'+val.id+'" style="color: #111111;">';
                contents += '<div class="product__item">';
                contents += '<div class="product__item__pic set-bg" data-setbg="'+base_url+'/'+val.thumnal+'?random='+Math.random()+'">';
                
                //### product tag ###//
                if(val.tag != null && val.tag != ''){
                    // var products_tags = get_products_tag(base_url, val.tag);
                    // if(products_tags.datas.length > 0){
                        var tag_top = 10;
                        //$.each( products_tags.datas, function( key, tag ) {
                            var tag_styles = 'style="background: '+val.backgroundcolor+'; top: '+tag_top+'px;"';
                            contents += '<span class="label" '+tag_styles+'>'+val.tag_name+'</span>';
                            tag_top += 25;
                       // });
                    //}
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

    //## drawproductcategory ##//
    drawproductcategory(base_url);
    function drawproductcategory(base_url){
        //###  category ###//
        var product_category = get_product_category(base_url);
        var cate = '';
        if(product_category.datas.length > 0){
            var filter_all = "'product-cate-all'";
            cate += '<button class="btn active" onclick="filterSelection('+filter_all+')">สินค้าทั้งหมด</button>';
            $.each( product_category.datas, function( key, val ) {
                var filter_class = "'product-cate-"+val.id+"'";
                cate += '<button class="btn" onclick="filterSelection('+filter_class+')">'+val.name+'</button>';
            });
        }
        var cate_position = '#collapseProduct #myBtnContainer';
        $(cate_position).html(null);
        $(cate_position).html(cate);

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

    //## filter product by category ##//
    filterSelection("product-cate-all");
    function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "product-cate-all") c = "";
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
        }
    }
    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
        }
    }
    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);     
            }
        }
        element.className = arr1.join(" ");
    }
    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
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

	//$(".paginate").pagination({});
</script>