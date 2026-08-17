<!-- #BeginEditable "bodytag" -->

<style>
    
  
     @media (max-width: 991.98px) { /* Tablet and below */
            .addtocart {
                height: auto;
            }
        }
        .addtocart{
            background-color: #005EB8;
            color: #fff;
            border-radius: unset;
            height: auto;
            font-size: inherit; /* ให้ไอคอนเท่ากับขนาดของปุ่ม */
        }

        .numberCart{
            width: 45px;
            height: 29px;
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
            height: 29px;
                 padding-bottom: 4px;
        padding-top:2px;
            border-radius: unset;
            border: 1px solid #A4A4A4;  
            box-sizing: border-box;
            background-color: #FFF;

        }

        .value-button:hover {
        cursor: pointer;
        }

    .btn-subcate.active {
        text-decoration: underline;
    }

    .filterDiv {
        display: none;
    }

    .show {
        display: block;
    }

    .product__item__text h6 {
        font-size: 13px;
    }

    .product__item__text .sale_price {
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
    .items div {
        /* border: 1px solid gray; margin: 5px; padding: 10px; */
    }

    .pager div {
        float: left;
        border: 1px solid #e5e5e5;
        margin: 5px;
        padding: 10px;
        border-radius: 3px;
    }

    .pager div.disabled {
        opacity: 0.25;
    }

    .pager .pageNumbers a {
        display: inline-block;
        padding: 0 10px;
        color: gray;
    }

    .pager .pageNumbers a.active {
        color: orange;
    }

    .pager {
        overflow: hidden;
    }

    .paginate-no-scroll .items div {
        height: 250px;
    }

    .btnCate .active {
        color: red;
    }

    .pagination {
        /*display: inline-block;*/
    }

    .pagination a {
        color: black;
        background-color: paleturquoise;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    li.active {
        background-color: burlywoord !important;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option body-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <span style="color: #2F2F2F;

font-size: 16px;
font-style: normal;
font-weight: 700;
line-height: normal;">ผลิตภัณฑ์</span>
                    <div class="breadcrumb__links">
                        <a href="<?= base_url() ?>">หน้าแรก</a>
                        <span id="cateLabel">สินค้าทั้งหมด</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<!-- Shop Section Begin -->
<section class="shop spad  body-padding" style="">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__accordion">

                        <div class="accordion" id="accordionExample">
                            <div id="collapseProduct">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 paginate" style="">
                <div class="row items product-contents ">

                </div>

                <!-- backup old pagination-->
                <!-- <div id="" class="pager">
                        <div class="firstPage" style="cursor: pointer;">&laquo;</div>
                        <div class="previousPage" style="cursor: pointer;">&lsaquo;</div>
                        <div class="pageNumbers" style="cursor: pointer;"></div>
                        <div class="nextPage" style="cursor: pointer;">&rsaquo;</div>
                        <div class="lastPage" style="cursor: pointer;">&raquo;</div>
                    </div> -->


                <div style='margin-top: 10px;' id='pagination'></div>
            </div>
            <script>
              function updateCartButtonTextByWrap() {

    const buttons = document.querySelectorAll('.addtocart');
    
    buttons.forEach(button => {
        const cartTextSpan = button.querySelector('.carttext');
        
        if (cartTextSpan) {
       
            let originalText = cartTextSpan.getAttribute('data-original-text');
            if (!originalText) {
                originalText = 'เพิ่มไปยังรถเข็น'; // ตั้งค่าเริ่มต้น
                cartTextSpan.setAttribute('data-original-text', originalText);
            }

      
            cartTextSpan.textContent = originalText;
           
            const originalStyle = cartTextSpan.style.whiteSpace;
            cartTextSpan.style.whiteSpace = 'nowrap';
          
            const singleLineHeight = cartTextSpan.offsetHeight; 
         
            cartTextSpan.style.whiteSpace = originalStyle; // คืนค่า style เดิม หรือปล่อยให้ว่าง

            const currentHeight = cartTextSpan.offsetHeight;

            if (currentHeight > singleLineHeight + 2) { 
             
                cartTextSpan.textContent = '+';
           
                button.classList.add('cart-compact'); 
            } else {
         
                cartTextSpan.textContent = originalText;
           
                button.classList.remove('cart-compact');
            }
        }
    });
}

window.onload = updateCartButtonTextByWrap;
window.onresize = updateCartButtonTextByWrap;

            </script>
        </div>
    </div>
</section>

   <!-- new product spread version -->
     <?php $this->load->view('desktop/product_interest'); ?>
<!-- Shop Section End -->
<!-- #EndEditable -->

<script src="<?=base_url('assete/js/add_to_cart.js?d=202608171430')?>"></script>
<script>


</script>

<script>
    var base_url = "<?= base_url(); ?>";
    // Detect pagination click
    var sub_category_id = "";
    var rowno = 1;
    var getcategoryId = '<?php echo isset($_GET["category_id"]) ? $_GET["category_id"] : "0"?>';
    
    // Call the function
    createAccordion('shop__sidebar__accordion');
  // ... โค้ดส่วนบน (createAccordion, drawproductsubcategory ถูกเรียก) ...

// 💡 NEW: ตรวจสอบและเรียกใช้ filterSelection โดยใช้ setTimeout

    function createAccordion(parentId) {

        var results = get_product_category(base_url);
        console.log(results);
        if (results.datas.length > 0) {
            $.each(results.datas, function(index, value) {
                const accordionHtml = `
                    <div class="accordion" id="accordion_${value.id}">
                        <div class="card">
                            <div class="card-heading">
                                <a data-toggle="collapse" data-target="#collapse_${value.id}">${value.name}</a>
                            </div>
                            <div id="collapse_${value.id}" class="collapse show" data-parent="#accordion_${value.id}">
                                <div class="card-body">
                                    <div class="shop__sidebar__categories">
                                        <div id="myBtnContainer_${value.id}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $("." + parentId).append(accordionHtml);
            });

            let productSubCate = get_product_subcategory(base_url);
            drawproductsubcategory(base_url)



        }
    }

    function drawproductsubcategory(base_url) {
        //###  category ###//
        var product_category = get_product_subcategory(base_url);
        console.log(product_category);
        // var cate = '';
        if (product_category.datas.length > 0) {
            var filter_all = "'product-cate-all'";
      
            $.each(product_category.datas, function(key, val) {
                console.log(val);
                var filter_class = "'product-cate-" + val.cate_id + "'";

                var cate = '<button class="btn btn-subcate" id="btn_' + val.id + '" onclick="filterSelection(' + val.id + ' , \'' + val.subcategory_name + '\' , ' + val.id + ')">' + val.subcategory_name + '</button>';
                var cate_position = `#collapse_${val.cate_id} #myBtnContainer_${val.cate_id}`;
                $(cate_position).append(cate);

            });
            var cateAllPosition = '#collapseProduct';
            var cateAll = '<button class="btn  btn-subcate active" id="btn_all" style="font-weight: bold;text-align: left;padding-left: 0;margin-bottom:10px;" onclick="filterSelection()">สินค้าทั้งหมด</button>';
            $(cateAllPosition).append(cateAll);

            // $(cate_position).html(null);
            // $(cate_position).html(cate);
        }



        if (getcategoryId != "0") {

        setTimeout(function() {
            
        
            const buttonSelector = "#btn_" + getcategoryId;
            
            if ($(buttonSelector).length) {
            
                $(buttonSelector).trigger("click");
                
            } else {
                console.warn(`Button ${buttonSelector} not found after timeout.`);
            }
            
        }, 0);
        
    }

    }

    function drawproductcategory(base_url) {
        //###  category ###//
        var product_category = get_product_category(base_url);
        var cate = '';
        if (product_category.datas.length > 0) {
            var filter_all = "'product-cate-all'";
            cate += '<button class="btn active" onclick="filterSelection()">สินค้าทั้งหมด</button>';
            $.each(product_category.datas, function(key, val) {
                var filter_class = "'product-cate-" + val.id + "'";
                cate += '<button class="btn" onclick="filterSelection(' + val.id + ' , \'' + val.name + '\' , ' + val.cate_id + ')">' + val.name + '</button>';
            });
        }
        var cate_position = '#collapseProduct #myBtnContainer';
        $(cate_position).html(null);
        $(cate_position).html(cate);

    }



    function setBg() {
        var bg = $('.set-bg');
        $.each(bg, function(index, value) {

            $(this).data('setbg');
            $(this).css('background-image', 'url(' + $(this).attr("data-setbg") + ')');
            // $('.set-bg').css('background-image', 'url(' + bg + ')');
        });
    }


    drawcontens(base_url, '', rowno);

    function drawcontens(base_url, sub_category_id, rowno) {


        //###  ressults ###//
        var results = get_results(base_url, sub_category_id, rowno);
        console.log(results);
        var contents = '';

        if (results.datas.length > 0) {


            // alert(results.pagination);
            $.each(results.datas, function(key, val) {

                // contents += '<div class="col-lg-4 col-md-6 col-sm-12 filterDiv product-cate-'+val.category+' ">';   // backup old logic 20231008
                contents += '<div class="col-lg-4 col-md-6 col-sm-12  product-cate-' + val.category + ' ">';
                contents += '<a href="' + base_url + 'product_detail/' + val.id + '" style="color: #111111;">';
                contents += '<div class="product__item">';
                contents += '<div class="product__item__pic set-bg" data-setbg="' + base_url + '/' + val.thumnal + '?random=' + Math.random() + '">';

                //### product tag ###//
                if (val.tag != null && val.tag != '') {

                    var tag_top = 10;
                    var tag_styles = 'style="background: ' + val.backgroundcolor + '; top: ' + tag_top + 'px;"';
                    contents += '<span class="label" ' + tag_styles + '>' + val.tag_name + '</span>';
                    tag_top += 25;

                }
                contents += '</div>';
                contents += '<div class="product__item__text">';
                contents += '<h6>' + val.name + '</h6>';
                var price_html = '';
                if ((val.saleprice != null && val.saleprice != '') && val.saleprice > 0) {
                    price_html = '<span class=" fw-7 " style="color: #2F2F2F;font-size: 20px;font-style: normal;font-weight: 700;line-height: normal;">฿' + addCommas(val.saleprice) + '</span><span class="sale_price">฿' + addCommas(val.price) + '<span>';
                } else {
                    price_html = '<span class=" fw-7 " style="color: #2F2F2F;font-size: 20px;font-style: normal;font-weight: 700;line-height: normal;">฿' + addCommas(val.price) + '</span>';
                }
                contents += price_html;
                contents += '</div>';
                contents += '</div>';
                contents += '</a>';

                  // เพิ่ม input เพิ่มจำนวนสินค้า 
                  contents += `<div class="form-increase d-flex align-items-center">
                <button class="value-button btn btn-light " id="decrease_${val.id}" onclick="decreaseValue(${val.id})" value="Decrease Value">-</button>
                <input type="number" id="number_${val.id}" class="numberCart form-control " value="1" style=" margin: 0;">
                <button class="value-button btn btn-light " id="increase_${val.id}" onclick="increaseValue(${val.id})" value="Increase Value">+</button>
                <button style="height:34px;" class="btn btn-primary ml-4 ml-md-auto addtocart d-flex align-items-center" onclick="addToCart(${val.id} , this)"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
  <path d="M12.1836 14.8631C12.7248 14.8631 13.1636 14.3892 13.1636 13.8046C13.1636 13.22 12.7248 12.7461 12.1836 12.7461C11.6424 12.7461 11.2036 13.22 11.2036 13.8046C11.2036 14.3892 11.6424 14.8631 12.1836 14.8631Z" fill="black" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M5.64992 14.8631C6.19114 14.8631 6.62992 14.3892 6.62992 13.8046C6.62992 13.22 6.19114 12.7461 5.64992 12.7461C5.10868 12.7461 4.66992 13.22 4.66992 13.8046C4.66992 14.3892 5.10868 14.8631 5.64992 14.8631Z" fill="black" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M2.71 2.16132H13.8167L12.51 9.92357H4.01667L2.71 2.16132ZM2.71 2.16132C2.60111 1.69088 2.05667 0.75 0.75 0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M12.51 9.92383H4.01666H2.86076C1.69501 9.92383 1.07666 10.4751 1.07666 11.3351C1.07666 12.1952 1.69501 12.7465 2.86076 12.7465H12.1833" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg><span class="carttext">เพิ่มไปยังรถเข็น</span></button>
            
            
                </div>`;

                contents += '</div>';
            });
            var position = '.product-contents';
            $(position).html(null);
            $(position).html(contents);
            setBg();
            $('#pagination').html(results.pagination);
            console.log(results.pagination);

        } else {
            var position = '.product-contents';
            $(position).html(null);
            $('#pagination').html(null);

        }
    }
 
    function filterSelection(c, name = null, sub_category_id = null) {
   
        c = c == undefined || c == null ? "" : c;
        if (name != null && name != undefined) {
            $("#cateLabel").html(name);
        } else {
            name = 'สินค้าทั้งหมด';
            $("#cateLabel").html(name);
        }
        $(".btn-subcate").removeClass("active");
        let activeClassSelector = c != '' && c != null ? c : "all";
        $("#btn_" + activeClassSelector).addClass('active');
        
        sub_category_id  = c;
        drawcontens(base_url, sub_category_id, 0)
    }

    function get_results(base_url, subCate, rowno) {
        var res = null;
      
        $.ajax({
            url: base_url + 'Main/get_products_results/' + rowno, //ทำงานกับไฟล์นี้
            data: {
                'sub_category_id': subCate,
                'rowno': rowno
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
            success: function(data, status) {
                res = data;
                sub_category_id  = subCate;
            },
            error: function(xhr, status, exception) {
                //console.log(xhr);
            }
        });
        return res;
    }

    function get_products_tag(base_url, tag) {
        var res = null;
        $.ajax({
            url: base_url + 'Main/get_products_tag', //ทำงานกับไฟล์นี้
            data: {
                'tag': tag
            }, //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) {
                //console.log(xhr);
            }
        });
        return res;
    }

    //## drawproductcategory ##// backup 20240330
    //drawproductcategory(base_url);


    // backup old logic product category all
    // function drawproductcategory(base_url){
    //     //###  category ###//
    //     var product_category = get_product_category(base_url);
    //     var cate = '';
    //     if(product_category.datas.length > 0){
    //         var filter_all = "'product-cate-all'";
    //         cate += '<button class="btn active" onclick="filterSelection('+filter_all+')">สินค้าทั้งหมด</button>';
    //         $.each( product_category.datas, function( key, val ) {
    //             var filter_class = "'product-cate-"+val.id+"'";
    //             cate += '<button class="btn" onclick="filterSelection('+filter_class+')">'+val.name+'</button>';
    //         });
    //     }
    //     var cate_position = '#collapseProduct #myBtnContainer';
    //     $(cate_position).html(null);
    //     $(cate_position).html(cate);

    // }

    function get_product_category(base_url) {
        var res = null;
        $.ajax({
            url: base_url + 'Main/get_product_category_used', //ทำงานกับไฟล์นี้
            data: '', //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
            success: function(data, status) {
                res = data;
            },
            error: function(xhr, status, exception) {
                //console.log(xhr);
            }
        });
        return res;
    }

    function get_product_subcategory(base_url) {
        var res = null;
        $.ajax({
            url: base_url + 'Main/get_product_subcategory', //ทำงานกับไฟล์นี้
            data: '', //ส่งตัวแปร
            type: "POST",
            dataType: 'json',
            async: false,
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
    //filterSelection("product-cate-all");

    // backup old logic filterselection the new one use by ajax
    // function filterSelection(c) {
    //     var x, i;
    //     x = document.getElementsByClassName("filterDiv");
    //     if (c == "product-cate-all") c = "";
    //     for (i = 0; i < x.length; i++) {
    //         w3RemoveClass(x[i], "show");
    //         if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    //     }
    // }


    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
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
    // var btnContainer = document.getElementById("myBtnContainer");
    // var btns = btnContainer.getElementsByClassName("btn");
    // for (var i = 0; i < btns.length; i++) {
    //     btns[i].addEventListener("click", function(){
    //         var current = document.getElementsByClassName("active");
    //         current[0].className = current[0].className.replace(" active", "");
    //         this.className += " active";
    //     });
    // }

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

    $('#pagination').on('click', 'a', function(e) {
        e.preventDefault();
        rowno = $(this).attr('data-ci-pagination-page');

        $("#pagination").html('');
        
        drawcontens(base_url, sub_category_id, rowno);
    });


    //$(".paginate").pagination({});
</script>