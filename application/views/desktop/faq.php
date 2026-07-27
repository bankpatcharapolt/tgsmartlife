	
<!-- #BeginEditable "bodytag" -->
   <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-blog set-bg" data-setbg="<?=base_url('assete/theme/img/career-bg.jpg')?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>คำถามที่พบบ่อย</h2>
                </div>
            </div>   
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- career Section Begin -->
    <section class="career">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="career__details" id="cardDetails">
						
						
					</div>
                </div>
            </div>
        </div>
		
    </section>
    <!-- career Section End -->
	


<!-- #EndEditable -->

	<script>

        var base_url = "<?=base_url();?>";
        drawcontens(base_url);
        function drawcontens(base_url){

            //###  ressults ###//
            var results = get_results(base_url);
			console.log(results);
            var contents = '';
            if(results.datas.length > 0){
                $.each( results.datas, function( keys, vals ) {
					var html = `
						<h3>${vals.faq_main_topic}</h3>
						<div class="career__accordion">
							<div class="accordion" id="accordion${vals.faq_main_id}">
								<!-- ใช้ข้อมูลจาก JSON เพื่อสร้างเนื้อหา -->
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading${vals.id}">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${vals.faq_main_id}" aria-expanded="true" aria-controls="collapse${vals.faq_main_id}">
											${vals.faq_main_topic}
										</button>
									</h2>
									<div id="collapse${vals.faq_main_id}" class="accordion-collapse collapse show" aria-labelledby="heading${vals.faq_main_id}" data-bs-parent="#accordion${vals.faq_main_id}">
										<div class="accordion-body">
										
										</div>
									</div>
								</div>
							</div>
						</div>`;
						$("#cardDetails").append(html);
						$.each( vals.child, function( key, val ) {
						contents += '<div class="card">';
						contents += '<div class="card-heading">';
						contents += '<a data-toggle="collapse" data-target="#collapse'+val.id+'">'+val.topic+'</a>';
						contents += '</div>';
						contents += '<div id="collapse'+val.id+'" class="collapse" data-parent="#accordion'+vals.faq_main_id+'">';
						contents += '<div class="card-body" style="padding-left: 30px;">';
						contents += '<div class="career__qualification">';
						contents += val.desc;
					
						contents += '</div>';
						contents += '</div>';
						contents += '</div>';
						contents += '</div>';
					});
	
					var position = '#accordion'+vals.faq_main_id;
					$(position).html(null);
					$(position).html(contents);
                });
		
			
            }
        }
        function get_results(base_url){
            var res = null;
            $.ajax({
                url: base_url+'Main/get_faq', //ทำงานกับไฟล์นี้
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