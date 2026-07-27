	<style>
		iframe {
			width: 100% !important;
			min-height: auto !important;
		}
	</style>
	
	<style>
		html {
			scroll-behavior: smooth
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
	<!-- #BeginEditable "bodytag" -->
	<!-- Breadcrumb Section Begin -->
	<section class="breadcrumb-blog set-bg" data-setbg="<?= base_url('assete/theme/img/support-bg.jpg') ?>">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2>ข้อมูลรับประกันสินค้า</h2>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->
	<section class="career">
		<div class="container paginate">
			<div class="row items" id="products-position">
				
				
			</div>
		
			<div style='margin-top: 10px;' id='pagination'></div>
			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0" id="product-spec-position" style="text-align: center;">
					
				</div>
			</div>
			
			<style>
				.img-data {
					border: 1px solid rgba(0, 0, 0, .125);
					border-radius: 0.25rem;
					padding: 15px;
					text-align: center;
					cursor: pointer;
					margin-bottom: 25px;
				}

				.img-data h4 {
					font-size: 1rem;
					padding-top: 15px;
					font-weight: 700;
				}

				.img-data-info {
					display: none;
					margin: 35px 0;
					border-top: 1px solid rgba(0, 0, 0, .125);
					padding-top: 25px;
					font-weight: 700;
				}

				.img-data-info h5 {
					font-size: 1rem;
					font-weight: 700;
					margin-bottom: 15px;
				}

				.img-data-info a,
				.img-data-info a:hover,
				.img-data-info a:active,
				.img-data-info a:focus,
				.img-data-info a:visited {
					color: #007bff;
					text-decoration: underline;
					font-weight: normal;
				}
			</style>
		</div>
	</section>
	<!-- #EndEditable -->
	
	<script>
		var base_url = "<?= base_url(); ?>";
		var product_id = "<?= $id ?>";
	
		var category_id = "";
		var active_label = "";
		var rowno = 1;
		$('#pagination').on('click', 'a', function(e) {
			e.preventDefault();
			rowno = $(this).attr('data-ci-pagination-page');

			$("#pagination").html('');
			drawcontens(base_url, rowno);

		});


		drawcontens(base_url, rowno);

		function drawcontens(base_url, rowno = null) {
			//###  ressults ###//
			var results = get_results(base_url, product_id);
			console.log(results);
			if (results.datas.length > 0) {
				var product = '';
				var product_spec = '';
				$.each(results.datas, function(key, val) {
					
					product_spec = val.warranty;


				});
				$('.career #products-position').html(product);
				$('.career #product-spec-position').html(product_spec);
				
				$('#pagination').html(null);
				$('#pagination').html(results.pagination);
			}

			const imgData = document.getElementsByClassName("img-data");
			const imgDataInfo = document.getElementsByClassName("img-data-info");
			for (let i = 0; i < imgData.length; i++) {
				imgData[i].addEventListener("click", function() {
					for (let a = 0; a < imgDataInfo.length; a++) {
						imgDataInfo[a].style.display = "none";
					}
					imgDataInfo[i].style.display = "block";

				});
			}
		}
		var id= '<?php echo $id?>';
	
		function get_results(base_url, id = null) {
			var res = null;
			$.ajax({
				url: base_url + 'Main/get_product_warranty_results', //ทำงานกับไฟล์นี้
				data: {id : id}, //ส่งตัวแปร
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

		// $(".paginate").paginga({});
	</script>