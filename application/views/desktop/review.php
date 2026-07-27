 <!-- Breadcrumb Section Begin -->
 <style>
     .blog__item__review {
         text-align: center;
         margin-bottom: 15px;
         font-size: 26px;
         font-weight: 600;
     }

     .blog__item__review span {
         color: #005eb8;
     }

     .filter_cate {
         text-align: center;
         margin-bottom: 45px;
     }

     .blog_review_box {
         display: flex;
         padding: 1em;
         background: #f5f5f5;
         border-radius: 5px;
         margin-bottom: 25px;
     }

     .blog_review_box p {
         font-size: 14px;
         font-family: "Prompt", sans-serif;
         color: #3d3d3d;
         font-weight: 400;
         margin-bottom: 0;
         line-height: 1.8;
     }

     .review_strong {
         font-size: 16px;
         color: #005eb8;
         display: block;
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

     .filter_cate {
	text-align: center;
	margin-bottom: 45px;
}

.filter_cate li {
	color: #b7b7b7;
	font-size: 24px;
	font-weight: 700;
	list-style: none;
	display: inline-block;
	margin-right: 88px;
	cursor: pointer;
}

.filter_cate li:last-child {
	margin-right: 0;
}

.filter_cate li.active {
	color: #111111;
}
 </style>
 <!-- Breadcrumb Section Begin -->
 <section class="breadcrumb-blog set-bg" data-setbg="<?= base_url('assete/theme/img/breadcrumb-bg.jpg') ?>">
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
             <div class="col-lg-12">
                 <ul class="filter_cate"></ul>
             </div>
         </div>
         <div class="row product__filter"></div>

         <div style='margin-top: 10px;' id='pagination'></div>
     </div>
     
 </section>

 <!-- Blog Section End -->

 <script>
     var base_url = "<?= base_url(); ?>";
     var category_id = "";
     var active_label = "";
     var rowno = 1;
     $('#pagination').on('click', 'a', function(e) {
         e.preventDefault();
         rowno = $(this).attr('data-ci-pagination-page');

         $("#pagination").html('');
         drawcontens(base_url, category_id, rowno ,active_label);

     });


     function setBg() {
         var bg = $('.set-bg');
         $.each(bg, function(index, value) {

             $(this).data('setbg');
             $(this).css('background-image', 'url(' + $(this).attr("data-setbg") + ')');
             // $('.set-bg').css('background-image', 'url(' + bg + ')');
         });
     }
    
     drawcontens(base_url, '', rowno , active_label);
 
     function filterSelection(c = null, name = null) {
         c = c == undefined || c == null ? "" : c;
         name = name == null ? "ทั้งหมด" : name;
         $(".li_cate").removeClass("active");
         active_label = c;
         if (name != null && name != undefined) {
            //  $("#cateLabel").html(name);
         } else {
             name = 'ทั้งหมด';
         } 
         category_id = c;
         drawcontens(base_url, c, 0 , active_label)
     }

     function drawcontens(base_url, category_id, rowno , active_label) {
       
         //###  category ###//
         var product_category = get_product_category(base_url);
         var cate = '';
        console.log(product_category);
         if (product_category.datas.length > 0) {
             var Active = "";
           
             var all_active_status = active_label == "" ? "active" : "";
             cate += '<li class="li_cate '+all_active_status+' "  id="cate_all" onclick="filterSelection()">ทั้งหมด</li>';
             $.each(product_category.datas, function(key, val) {
                Active =  active_label == val.id ? "active" : "";
                cate += '<li class="li_cate '+Active+'" id="cate_'+val.id+'" onclick="filterSelection(' + val.id + ' , \'' + val.name + '\')">' + val.name + '</li>';
             });
             var active_other =  active_label == 999 ? "active" : "";
             cate += '<li  class="'+active_other+'" onclick="filterSelection(999)">อื่นๆ</li>';
         }
         var cate_position = '.filter_cate';
         $(cate_position).html(null);
         $(cate_position).html(cate);

         //###  ressults ###//
         var results = get_results(base_url, category_id, rowno);
         var contents = '';
         if (results.datas.length > 0) {
             $.each(results.datas, function(key, val) {
                 contents += '<div class="col-12 mix filtercate' + val.product_cate + '">';
                 contents += '<a href="' + base_url + 'review_detail/' + val.id + '">';
                 contents += '<div class="blog_review_box">';
                 var imgs = (val.picture != '') ? base_url + val.picture + '?random=' + Math.random() : base_url + '/uploads/DocumentTh.png';
                 contents += '<img src="' + imgs + '" class="mr-2 rounded" alt="" width="100" height="100"> ';
                 contents += '<p>' + val.sub_header + '<strong class="review_strong">' + val.topic + '</strong> </p>';
                 contents += '</div>';
                 contents += '</a>';
                 contents += '</div>';
             });
             var position = '.product__filter';
             $(position).html(null);
             $(position).html(contents);
            
            // setBg();
             console.log(results.pagination);
             $('#pagination').html(results.pagination);

             console.log(results);
         }else{
            var position = '.product__filter';
            $(position).html(null);
         }

        
     }
     // function drawcontens(base_url , category_id , rowno){

     //     //###  category ###//
     //     var product_category = get_product_category(base_url);
     //     var cate = '';
     //     if(product_category.datas.length > 0){
     //         cate += '<li class="active" data-filter="*">ทั้งหมด</li>';
     //         $.each( product_category.datas, function( key, val ) {
     //             cate += '<li  data-filter=".filtercate'+val.id+'">'+val.name+'</li>';
     //         });
     //         cate += '<li  data-filter=".filtercate99999">อื่นๆ</li>';
     //     }
     //     var cate_position = '.filter_cate';
     //     $(cate_position).html(null);
     //     $(cate_position).html(cate);

     //     //###  ressults ###//
     //     var results = get_results(base_url);
     //     var contents = '';
     //     if(results.datas.length > 0){
     //         $.each( results.datas, function( key, val ) {
     //             contents += '<div class="col-12 mix filtercate'+val.product_cate+'">';
     //             contents += '<a href="'+base_url+'review_detail/'+val.id+'">';
     //             contents += '<div class="blog_review_box">';
     //             var imgs = (val.picture != '')? base_url+val.picture+'?random='+Math.random(): base_url+'/uploads/DocumentTh.png';
     //             contents += '<img src="'+imgs+'" class="mr-2 rounded" alt="" width="100" height="100"> ';
     //             contents += '<p>'+val.sub_header+'<strong class="review_strong">'+val.topic+'</strong> </p>';
     //             contents += '</div>';
     //             contents += '</a>';
     //             contents += '</div>';
     //         });
     //         var position = '.product__filter';
     //         $(position).html(null);
     //         $(position).html(contents);
     //     }
     // }
     function get_results(base_url, category_id = null, rowno = null) {
   
         var res = null;
         $.ajax({
             url: base_url + 'Main/get_review_results_paginate/' + rowno,  //ทำงานกับไฟล์นี้
             data: {
                 category_id: category_id,
                 rowno: rowno
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
 </script>