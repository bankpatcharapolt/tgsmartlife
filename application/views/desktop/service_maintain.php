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
                 <h2>ลงทะเบียนแจ้งซ่อมสินค้า หรือ สอบถามข้อมูลเพิ่มเติม</h2>
             </div>
         </div>
     </div>
 </section>
 <!-- Breadcrumb Section End -->

 <!-- Blog Section Begin -->
 <section class="blog spad">
     <div class="container  d-flex justify-content-center align-items-center">

     <div class="col-lg-8">
        <h2>ลงทะเบียนแจ้งซ่อมสินค้า หรือ สอบถามข้อมูลเพิ่มเติม</h2>
        <form action="#" method="post" enctype="multipart/form-data" id="maintain-form">
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ / Name *</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">นามสกุล / Last Name *</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่ / Address *</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทรศัพท์ / Phone *</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">อีเมล์ / Email (ถ้ามี)</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="productType" class="form-label">ประเภทสินค้า / Product Type *</label>
                <input type="text" class="form-control" id="productType" name="productType" required>
            </div>

            <div class="mb-3">
                <label for="productModel" class="form-label">รุ่นสินค้า / Product Model *</label>
                <input type="text" class="form-control" id="productModel" name="productModel" required>
            </div>

            <div class="mb-3">
                <label for="machineNumber" class="form-label">หมายเลขเครื่อง SN / Machine Number *</label>
                <input type="text" class="form-control" id="machineNumber" name="machineNumber" required>
            </div>

            <div class="mb-3">
                <label for="issueDescription" class="form-label">อาการสินค้าเบื้องต้น / Issue Description *</label>
                <input type="text" class="form-control" id="issueDescription" name="issueDescription" required>
            </div>

            <div class="mb-3">
                <label for="purchaseProof" class="form-label">อัพโหลดหลักฐานการซื้อสินค้า , ใบกำกับภาษี / Upload Of Purchase (ไฟล์สกุล .png,jpeg,jpg,.gifเท่านั้น) *</label>
                <input type="file" class="form-control" id="purchaseProof" name="purchaseProof" required>
            </div>

            <div class="mb-3">
                <label for="uploadFiles" class="form-label">อัพโหลดภาพ, วิดิโอ อาการสินค้าเพิ่มเติม / Upload VDO Images (ไฟล์สกุล .png,jpeg,jpg,gif,mp4,wov เท่านั้น)*</label>
                <input type="file" class="form-control" id="uploadFiles" name="uploadFiles[]" multiple accept="image/*,video/*" required>
                <small class="form-text text-muted">อัพโหลดได้ทั้งรูปและวีดีโอรวมกันไม่เกิน 20MB</small>
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

 </section>
 <script src="<?= base_url('assete/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<link href="<?= base_url('assete/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">

 <script type="text/javascript">
       var base_url = "<?= base_url(); ?>";
       document.getElementById('uploadFiles').addEventListener('change', function(event) {
            const files = event.target.files;
            const maxFileSize = 20 * 1024 * 1024; // 10MB
            for (const file of files) {
                if (file.size > maxFileSize) {
                    alert(`ไฟล์ ${file.name} มีขนาดเกิน 20MB`);
                    event.target.value = ''; // ล้างไฟล์ที่เลือกออก
                    break; // ออกจากลูปเพื่อไม่ให้มีการแจ้งเตือนซ้ำ
                }
            }
        });
     $('#maintain-form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = new FormData(document.getElementById('maintain-form')); // Select the form element by ID
        $.ajax({
            url: base_url + 'Main/create_maintain',
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