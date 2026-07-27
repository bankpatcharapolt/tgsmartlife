
<!-- #BeginEditable "bodytag" -->
    <!-- Map Begin -->
    <div class="map">
    
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3805.668782562869!2d101.7112723155342!3d17.475560104854274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x72db2777bd4ec00f!2zMTfCsDI4JzMyLjAiTiAxMDHCsDQyJzQ4LjUiRQ!5e0!3m2!1sth!2sth!4v1663832389800!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Map End -->
        
    <!-- Contact Section Begin -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <h2>ติดต่อเรา</h2>
                            <p>บริษัท ทีจี สมาร์ท ไลฟ์ จํากัด (TG SMART LIFE Co., Ltd.) <br>บริษัทดำเนินการธุรกิจประเภท ผลิต และจำหน่าย เครื่องใช้ไฟฟ้าในครัวเรือน ภายใต้แบรนด์ TG Smart Life Smart Home</p>
                        </div>
                        <ul>
                            <li>
                                <h4>TG Smart Life สำนักงานใหญ่</h4>
                                <p class="card-text"><b>ที่อยู่</b> : เลขที่ 749/2 หมู่ที่ 7 ตําบลนาอาน อําเภอเมืองเลย จังหวัด เลย 42000</p>
                                <p class="card-text"><b>โทรศัพท์</b> : 065-295-8885, 065-558-8553</p>
                                <!-- Trigger the Modal -->
                                <div class="container1">
                                    <img class="myMap modal-hover-opacity" src="<?=base_url('./uploads/tg-map-loei.jpg')?>" alt="TG smart life สำนักงานใหญ่" style="max-width:100%; max-width:300px; cursor:zoom-in" onclick="onClick(this)">
                                </div>
                            </li>
                            <li>
                                <h4>TG Smart Life สาขา รังสิต</h4>
                                <p class="card-text"><b>ที่อยู่</b> : เลขที่ 450 ซ.รังสิต-นครนายก 64 ต.ประชาธิปัตย์ อ.ธัญบุรี จ.ปทุมธานี 12130</p>
                                <p class="card-text"><b>โทรศัพท์</b> : 065-295-8885, 065-558-8553</p>
                                <div class="container1">
                                    <img class="myMap modal-hover-opacity" src="<?=base_url('./uploads/tg-map-pathum-thani.jpg')?>" alt="TG smart life สำนักงานใหญ่" style="max-width:100%; max-width:300px; cursor:zoom-in" onclick="onClick(this)">
                                </div>
                            </li>
                        </ul>
                        <div id="modal01" class="modal" onclick="this.style.display='none'">
                            <span class="close">&times;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <div class="modal-content">
                                <img id="img01" style="max-width:100%">
                            </div>
                            <div id="caption"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form  method="post" action="<?//=base_url('admin/Product/product_actions');?>" enctype="multipart/form-data" id="action-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="tel" name="tel" placeholder="tel" >
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"  name="message" required></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                
        <style>
            /* Style the Image Used to Trigger the Modal */
            .myMap {
            border-radius: 5px;
            cursor: zoom-in;
            transition: 0.3s;
                border: 1px solid #dfdfdf;
                margin-top: 15px;
            }
            
            #myMap:hover {opacity: 0.7;}
            
            /* The Modal (background) */
            .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 99999; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }
            
            /* Modal Content (Image) */
            .modal-content {
            margin: auto;
            display: block;
            width: 100%;
            max-width: 850px;
            }
            
            /* Caption of Modal Image (Image Text) - Same Width as the Image */
            #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
            }
            
            /* Add Animation - Zoom in the Modal */
            .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
            }
            
            @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
            }
            
            /* The Close Button */
            .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            }
            
            .close:hover,
            .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
            }
                
            .zoom-in {cursor: zoom-in;}
            
            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
            }
        </style>
                    
        <script>
            function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
            }
        </script>
                
    </section>
        <!-- Contact Section End -->
    <!-- #EndEditable -->

    <script>
        var base_url = "<?=base_url();?>";
        //### save form ###//
        $("form#action-form").on("submit",function(e){ // จะทำงานก็ต่อเมื่อกด submit ฟอร์ม
            e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
            var fd = new FormData(this); // เตรียมข้อมูล form สำหรับส่งด้วย  FormData Object
            

            //$("#loading-spinner").fadeIn(300);
            //fd.append('file',files[0]); //ใช้ในการแทรกค่าไฟล์รูปภาพใน element 

            $.ajax({
                url:base_url+'Main/contactus_actions', //ให้ระบุชื่อไฟล์ PHP ที่เราจะส่งค่าไป
                type:'post',
                dataType: 'json',
                data:fd, //ข้อมูลจาก input ที่ส่งเข้าไปที่ PHP
                contentType: false,
                processData: false,
                success:function(response){ //หากทำงานสำเร็จ จะรับค่ามาจาก JSON หลังจากนั้นก็ให้ทำงานตามที่เรากำหนดได้
                    window.location.href = response.datas;
                    // $("#loading-spinner").hide();
                    // if(response.status){
                    //     window.location.href = response.datas;
                    //     //Swal.fire({ icon: 'success',  text: response.massege });
                    // }else{
                    //     Swal.fire({ icon: 'warning',  text: response.massege });
                    // }
                }
            });
        });
    </script>