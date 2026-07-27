<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=base_url('assete/logo/cropped-icon-32x32.png')?>">
    <title>Admin TGSmartLife</title>

    <link href="<?=base_url('./assete/css/bootstrap-select.min.css');?>" rel="stylesheet">  
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">-->
    <link href="<?=base_url('./assete/css/datepicker.css');?>" rel="stylesheet" media="screen"> 
  
    <!-- admin theme(gentelella) https://colorlib.com/polygon/gentelella/  -->
    <link href="<?=base_url('./assete/admin-themplate/vendors/bootstrap/dist/css/bootstrap.min.css');?>" rel="stylesheet">
 
    <link href="<?=base_url('./assete/admin-themplate/vendors/bootstrap-daterangepicker/daterangepicker.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');?>" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?=base_url('./assete/admin-themplate/vendors/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url('./assete/admin-themplate/vendors/nprogress/nprogress.css');?>" rel="stylesheet">
    <!-- iCheck -->
	  <link href="<?=base_url('./assete/admin-themplate/vendors/iCheck/skins/flat/green.css');?>" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?=base_url('./assete/admin-themplate/vendors/google-code-prettify/bin/prettify.min.css');?>" rel="stylesheet">

    <!-- dropzone css js!-->
    <link href="<?=base_url('./assete/admin-themplate/vendors/dropzone-master/dist/dropzone.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/dropzone-master/dist/min/dropzone.min.css');?>" rel="stylesheet">
    
    
    <!--  ckeditor4 -->
    <script src="<?=base_url('./assete/ckeditor4/ckeditor.js');?>"></script>
    <script src="<?=base_url('./assete/ckeditor4/samples/js/sample.js');?>"></script>
    <!-- <link rel="stylesheet" href="<?=base_url('./assete/ckeditor4/samples/css/samples.css');?>"> -->
    <link rel="stylesheet" href="<?=base_url('./assete/ckeditor4/samples/toolbarconfigurator/lib/codemirror/neo.css');?>">
    
    <link href="<?=base_url('./assete/admin-themplate/vendors/bootstrap-select/css/bootstrap-select.min.css');?>"rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css');?>" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?=base_url('./assete/admin-themplate/build/css/custom.css');?>" rel="stylesheet"> 
    <link href="<?=base_url('./assete/css/customs.css');?>" rel="stylesheet">  

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?=base_url('./assete/js/jquery.min.js');?>"></script>
    <script src="<?=base_url('./assete/admin-themplate/vendors/devbridge-autocomplete/dist/jquery.autocomplete.js');?>"></script>
    <script src="<?=base_url('./assete/admin-themplate/vendors/jquery/dist/jquery.min.js');?>"></script>
    <script src="<?=base_url('./assete/admin-themplate/vendors/moment/min/moment.min.js');?>"></script>

    <!-- Bootstrap -->
    <script src="<?=base_url('./assete/admin-themplate/vendors/bootstrap/dist/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('./assete/js/bootstrap-datepicker.js');?>"></script>
    <script src="<?=base_url('./assete/js/bootstrap-datepicker-thai.js');?>"></script>
    <script src="<?=base_url('./assete/js/locales/bootstrap-datepicker.th.js');?>"></script>

    <script src="<?=base_url('./assete/js/validate.js');?>"></script>
    <script src="<?=base_url('./assete/js/admin_custom.js');?>"></script>
    
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script> -->

    <!-- Datatables -->
    <link href="<?=base_url('./assete/admin-themplate/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('./assete/admin-themplate/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css');?>" rel="stylesheet">
    <script src="<?=base_url('./assete/admin-themplate/vendors/datatables.net/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('./assete/admin-themplate/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>

    <!-- ajax-file-uploader -->
    <!-- <link rel="stylesheet" href="<?=base_url('./assete/ajax-file-uploader/css/jquery.uploader.css');?>">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="<?=base_url('./assete/ajax-file-uploader/dist/jquery.uploader.min.js');?>"></script> -->
    
    <!-- Loading spinner -->
    <!-- <link href="<?=base_url('assete/loading-spinner/css.css')?>" rel="stylesheet"> -->
    <!-- Loading spinner -->
    <script src="<?=base_url('assete/sweetalert2/sweetalert2.all.min.js')?>"></script>
    <link href="<?=base_url('assete/sweetalert2/sweetalert2.min.css')?>" rel="stylesheet">

    <!-- DRAG & DROP IMAGE -->
    <!-- <link rel="stylesheet" href="<?=base_url('assete/drag-drop-image-uploader/dist/image-uploader.min.css')?>" rel="stylesheet">
    <script type="text/javascript" src="<?=base_url('assete/drag-drop-image-uploader/dist/image-uploader.min.js')?>"></script> -->

    
    <script type="text/javascript" src="https://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />

  </head>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url('admin/product');?>" class="site_title">
                <i class="fa fa-paw"></i> 
                <!-- <img  class="my-0 mr-md-auto" src="<?=base_url('assete/logo/psienergy_logo.png')?>"> -->
                <span>TG Smart Life</span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('./assete/admin-themplate/production/images/img.jpg');?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$this->session->userdata('username');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->

                <!-- menu for superadmin -->
                  <!-- <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'dashboard'){echo'active';}?> ">
                      <a href="<?=base_url('admin/dashboard');?>"><i class="fa fa-desktop"></i> แดชบอร์ด</a>
                    </li>
                  </ul> -->
                  

                  <!-- <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'home'){echo'active';}?> ">
                      <a><i class="fa fa-home"></i> หน้าหลัก <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu" style="display: <?php if($mainmenu == 'home'){echo'block';}else{echo'none';}?>;">
                        <li <?php if($submenu == 'temp'){echo'class="current-page"';}?>><a href="<?=base_url('admin/temp');?>">ข้อมูลสัญญาลูกค้า</a></li>
                        <li><a href="<?=base_url('admin/loan');?>">ข้อมูลการผ่อนสินค้า</a></li>
                        <li <?php if($submenu == 'loan'){echo'class="current-page"';}?>><a href="<?=base_url('admin/loan/overdue');?>">ข้อมูลการผ่อนชำระ</a></li>
                        <li <?php if($submenu == 'sms'){echo'class="current-page"';}?>><a href="<?=base_url('admin/sms');?>">ประวัติการส่งSMS</a></li>
                        <li <?php if($submenu == 'service'){echo'class="current-page"';}?>><a href="<?=base_url('admin/service');?>">ประวัติการซ่อมบำรุง</a></li>
                        <li <?php if($submenu == 'serialNumber'){echo'class="current-page"';}?>><a href="<?=base_url('admin/serialNumber');?>">หมายเลขเครื่อง</a></li>
                        <li <?php if($submenu == 'mechanic'){echo'class="current-page"';}?>><a href="<?=base_url('admin/mechanic');?>">ข้อมูลช่าง</a></li>
                        <li <?php if($submenu == 'agent'){echo'class="current-page"';}?>><a href="<?=base_url('admin/agent');?>">ผู้รับมอบอำนาจ</a></li>
                      </ul>
                    </li>
                  </ul> -->

                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'product'){echo'active';}?> ">
                      <a><i class="fa fa-globe" aria-hidden="true"></i> สินค้า <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu" style="display: <?php if($mainmenu == 'product'){echo'block';}else{echo'none';}?>;">
                        <li <?php if($submenu == 'order'){echo'class="current-page"';}?> ><a href="<?=base_url('order');?>">รอการตรวจสอบ</a></li>
                        <li <?php if($submenu == 'product'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product');?>">สินค้า</a></li>
                        <li <?php if($submenu == 'category'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_category');?>">หมวดหมู่สินค้า</a></li>
                        <li <?php if($submenu == 'sub_category'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_subcategory');?>">หมวดหมู่สินค้าย่อย</a></li>
                        <li <?php if($submenu == 'tag'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_tag');?>">แทคสินค้า</a></li>
                        <li <?php if($submenu == 'typ'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_type');?>">ประเภทสินค้า</a></li>
                       <li <?php if($submenu == 'product_detail_spec'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_productdetail_spec');?>">ข้อมูลจำเพาะ</a></li>
                        <li <?php if($submenu == 'product_manual'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_manual');?>">เอกสาร/คู่มือสินค้า</a></li>
                      
                      </ul>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'spec'){echo'active';}?> ">
                      <a href="<?=base_url('admin_product_spec');?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>ศูนย์รวมข้อมูลผลิตภัณฑ์</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'regis'){echo'active';}?> ">
                      <a href="<?=base_url('admin_product_regis');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>ตรวจสอบลงทะเบียนสินค้า</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'blog'){echo'active';}?> ">
                      <a href="<?=base_url('admin_blog');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>KNOWLEDGE</a>
                    </li>
                  </ul>
                  
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'review'){echo'active';}?> ">
                      <a href="<?=base_url('admin_review');?>"><i class="fa fa-eye" aria-hidden="true"></i>Review</a>
                    </li>
                  </ul>

                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'tgsmartlifeservice'){echo'active';}?> ">
                      <a href="<?=base_url('admin_tgsmartlifeservice');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>TG Smart life Service</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'tgsmartlifeproject'){echo'active';}?> ">
                      <a href="<?=base_url('admin_tgsmartlifeproject');?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>TG Smart life Project</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'career'){echo'active';}?> ">
                      <a href="<?=base_url('admin_career');?>"><i class="fa fa-briefcase" aria-hidden="true"></i>งานที่เปิดรับ</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'slide'){echo'active';}?> ">
                      <a href="<?=base_url('admin_slide');?>"><i class="fa fa-ellipsis-h" aria-hidden="true"></i>Product slider</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'helpservice'){echo'active';}?> ">
                      <a href="<?=base_url('admin_helpservice');?>"><i class="fa fa-code" aria-hidden="true"></i>บริการช่วยเหลือ</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'feedback'){echo'active';}?> ">
                      <a href="<?=base_url('admin_feedback');?>"><i class="fa fa-user" aria-hidden="true"></i>คำติชมและการให้บริการ</a>
                    </li>
                  </ul>

                  
                 
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'product'){echo'active';}?> ">
                      <a><i class="fa fa-question-circle" aria-hidden="true"></i> คำถามที่พบบ่อย</a>
                      <ul class="nav child_menu" style="display: <?php if($mainmenu == 'product'){echo'block';}else{echo'none';}?>;">
                      <li class=" <?php if($mainmenu == 'faq_sub'){echo'active';}?> ">
                        <a href="<?=base_url('admin_faq_sub');?>"><i class="fa fa-cog" aria-hidden="true"></i>ตั้งค่าคำถาม</a>
                      </li>
                      </ul>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'maintain'){echo'active';}?> ">
                      <a href="<?=base_url('admin_maintain');?>"><i class="fa fa-wrench" aria-hidden="true"></i>รายการแจ้งซ่อม</a>
                    </li>
                  </ul> 
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'seo'){echo'active';}?> ">
                      <a href="<?=base_url('admin_seo');?>"><i class="fa fa-code" aria-hidden="true"></i>SEO</a>
                    </li>
                  </ul>
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'team'){echo'active';}?> ">
                      <a><i class="fa fa-sitemap" aria-hidden="true"></i> TEAM <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu" style="display: <?php if($mainmenu == 'team'){echo'block';}else{echo'none';}?>;">
                        <li <?php if($submenu == 'team'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_team');?>">ทีม</a></li>
                        <li <?php if($submenu == 'team_product'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_team_product');?>">จัดการสินค้า</a></li>
                        <!-- <li <?php if($submenu == 'tag'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_tag');?>">แทคสินค้า</a></li>
                        <li <?php if($submenu == 'typ'){echo'class="current-page"';}?> ><a href="<?=base_url('admin_product_type');?>">ประเภทสินค้า</a></li> -->
                      </ul>
                    </li>
                  </ul>
                  
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'generalsetting'){echo'active';}?> ">
                      <a href="<?=base_url('admin_generalsetting');?>"><i class="fa fa-gear" aria-hidden="true"></i>ตั้งค่าทั่วไป</a>
                    </li>
                  </ul>
                  
                  <ul class="nav side-menu">
                    <li class=" <?php if($mainmenu == 'webcontact'){echo'active';}?> ">
                      <a href="<?=base_url('admin_webcontact');?>"><i class="fa fa-laptop" aria-hidden="true"></i>ข้อมูลการติดต่อจา หน้าเว็บ</a>
                    </li>
                  </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!--
              <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=base_url('admin/user/logout');?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=base_url('./assete/admin-themplate/production/images/img.jpg');?>" alt=""><?=$this->session->userdata('username'); ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <!--<a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                      <a class="dropdown-item"  href="javascript:;">Help</a>-->
                      <a class="dropdown-item"  href="<?=base_url('admin/Admin/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  <!--
                    <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="<?=base_url('./assete/admin/production/images/img.jpg');?>" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="<?=base_url('./assete/admin/production/images/img.jpg');?>" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="<?=base_url('./assete/admin/production/images/img.jpg');?>" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item">
                          <span class="image"><img src="<?=base_url('./assete/admin/production/images/img.jpg');?>" alt="Profile Image" /></span>
                          <span>
                            <span>John Smith</span>
                            <span class="time">3 mins ago</span>
                          </span>
                          <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                          </span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                  -->
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

        
