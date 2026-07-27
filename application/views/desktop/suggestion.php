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
                 <h2>คำติชมหลังการบริการ</h2>
             </div>
         </div>
     </div>
 </section>
 <!-- Breadcrumb Section End -->

 <!-- Blog Section Begin -->
 <section class="blog spad">
     <div class="container  d-flex justify-content-center align-items-center">

         <div class="col-lg-8">
             <form action="#" method="post" id="suggestion-form">
             <div class="mb-3">
                        <label for="name" class="form-label">ชื่อ / NAME *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="form-label">นามสกุล / LAST NAME *</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">เบอร์โทรศัพท์ / PHONE *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="serviceDate" class="form-label">วันที่เข้ารับการบริการ / SERVICE DATE *</label>
                        <input type="date" class="form-control" id="serviceDate" name="serviceDate" required>
                    </div>

                    <div class="mb-3">
                        <label for="workOrderNumber" class="form-label">เลขที่ใบสั่งงาน / WORK ORDER NUMBER (ถ้ามี)</label>
                        <input type="text" class="form-control" id="workOrderNumber" name="workOrderNumber">
                    </div>

                    <div class="mb-3">
                        <label for="serviceFeedback" class="form-label">คำติชมการให้บริการ / SERVICE FEEDBACK *</label>
                        <textarea class="form-control" id="serviceFeedback" name="serviceFeedback" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="uploadFiles" class="form-label">อัพโหลดภาพเพิ่มเติม</label>
                        <input type="file" class="form-control" id="uploadFiles" name="uploadFiles[]" multiple accept="image/*">
                    </div>

                 <div class="mb-3 justify-content-center text-center">
                     <!-- ปุ่มส่งข้อมูล -->
                     <button type="submit" class="btn btn-primary " style="min-height: 72px;font-size: 20px;
    padding: 20px 45px;
    border-radius: 6px;">
                         <i class="fa fa-envelope"></i> ส่งข้อมูล
                     </button>
                 </div>
             </form>

         </div>

     </div>

 </section>
 <script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

 <script type="text/javascript">
       var base_url = "<?= base_url(); ?>";
     $('#suggestion-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(document.getElementById('suggestion-form')); // Select the form element by ID
        $.ajax({
            url: base_url + 'Main/create_suggestion',
            type: "POST",
            dataType: 'json',
            data: formData, // Use FormData object as the data
            contentType: false, // Prevent jQuery from setting contentType
            processData: false, // Prevent jQuery from processing data
            success: function(response) {
                console.log(response);
                if (response.status == true) {
                    Swal.fire({
                        icon: 'success',

                        html: '<p>บันทึกข้อมูลเสร็จสมบูรณ์</p>',
                        allowOutsideClick: false,
                        showCancelButton: false,
                        confirmButtonText: 'ตกลง',
                        customClass: {
                            container: 'swal-container-lg' // ใช้คลาสขนาดใหญ่ของ Bootstrap
                        }
                    }).then((result) => {
                        
                           window.location.href = base_url;
                   
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: '<span style="font-weight:bold;">เกิดปัญหาในเซิฟเวอร์ ไม่สามารถบันทึกข้อมูลได้</span>',
                        html: 'ไม่สามารถบันทึกข้อมูลได้'
                    });
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

     });
 </script>