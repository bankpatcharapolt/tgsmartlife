<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta charset="UTF-8">
    <!-- <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html"> -->
    <!-- <link rel="apple-touch-icon" href="<?= base_url('./uploaded/tg-01.png'); ?>"> -->
    <!-- <link rel="icon" type="image/x-icon" href="<?= base_url('./uploaded/tg-01.png'); ?>"> -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('uploads/tg-01.png'); ?>">

    <?php
    $title = 'บริษัท ทีจี สมาร์ท ไลฟ์ จํากัด (TG SMART LIFE Co., Ltd.) ';
    $keywords = '"เครื่องเคหภัณฑ์ครัวเรือน,เฟอร์นิเจอร์เครื่องแก้ว" , "เตาแม่เหล็กไฟฟ้า " ,"เครื่องครัวสแตนเลส"  ,"หม้อหุนแรงดันไฟฟ้า"  ,"เครื่องฟอกอากาศ"  ,"เครื่องทําความเย็น"  ,"เตาอบไมโครเวฟ"  ,"เตารีดไฟฟ้า" , "เครื่องดูดอากาศ" ," เครื่องใช้ไฟฟ้า" ,"อุปกรณ์ไฟฟ้า"';
    $description = 'บริษัทดำเนินการธุรกิจประเภท ผลิต และจำหน่าย เครื่องใช้ไฟฟ้าในครัวเรือน ภายใต้แบรนด์ TG Smart Life Smart Home เป็นบริษัทผู้นำทางด้านนวัตกรรมล้ำสมัย และจำหน่ายสินค้าประเภทผลิตภัณฑ์มีดังนี้ เครื่องเคหภัณฑ์ครัวเรือน เฟอร์นิเจอร์เครื่องแก้ว เตาแม่เหล็กไฟฟ้า เครื่องครัวสแตนเลส หม้อหุนแรงดันไฟฟ้า เครื่องฟอกอากาศ เครื่องทําความเย็น เตาอบไมโครเวฟ เตารีดไฟฟ้า เครื่องดูดอากาศ เครื่องใช้ไฟฟ้า อุปกรณ์ไฟฟ้า แผงโซล่าเชล อุปกรณ์โซล่าเชล รวมทั้งอะไหล์ และอุปกรณ์ของสินค้าดังกล่าว ผลิตภัณฑ์ได้รับการออกแบบมาเพื่อให้สดคล้องกับชีวิตไลฟ์สไตล์ของคนรุ่นใหม่ เพื่อเป็นการตอบสนองความต้องการของลูกค้าให้ครอบคลุมทุกกลุ่ม';
    $img = base_url('/uploads/header.jpg');
    if ($seo) {
        $title = (!empty($seo[0]['seo_title']) ? $seo[0]['seo_title'] : '');
        $keywords =  (!empty($seo[0]['seo_keyword']) ? $seo[0]['seo_keyword'] : '');
        $description =  (!empty($seo[0]['seo_description']) ? $seo[0]['seo_description'] : '');
        if (!empty($seo[0]['thumnal'])) {
            $img = base_url($seo[0]['thumnal']);
        }
    }
    //php print_r($seo['datas'][0]['page']);  
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content='<?= $keywords ?>'>
    <meta name="description" content="<?= $description ?>">
    <meta property="fb:app_id" content="1684677531811838">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= $img ?>">
    <meta property="og:image:width" content="640">
    <meta property="og:image:height" content="442">
    <meta name="format-detection" content="telephone=yes">

    <!-- InstanceBeginEditable name="doctitle" -->
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/owl.carousel.min-review.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/owl.theme.default.min-review.css') ?>">
    <!-- InstanceEndEditable -->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Js Plugins -->

    <script src="<?= base_url('assete/theme/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assete/theme/js/owl.carousel.min.js') ?>"></script>
    <!-- Css Styles -->
    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/bootstrap.min.css') ?>" type="text/css">

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/font-awesome.min.css') ?>" type="text/css">

    <!--elegant-icons.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/elegant-icons.css') ?>" type="text/css">

    <!--magnific-popup.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/magnific-popup.css') ?>" type="text/css">

    <!--nice-select.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/nice-select.css') ?>" type="text/css">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/owl.carousel.min.css') ?>" type="text/css">

    <!--slicknav.min.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/slicknav.min.css') ?>" type="text/css">

    <!--style.css-->
    <link rel="stylesheet" href="<?= base_url('assete/theme/css/style.css') ?>" type="text/css">

    <!--google font-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');
    </style>

    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
    <!--script fix-nav-->
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {

            window.addEventListener('scroll', function() {

                if (window.scrollY > 0) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });
        // DOMContentLoaded  end
    </script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
    p img {
        height: auto !important;
        width: 100% !important;
    }

    p a iframe {
        width: -webkit-fill-available !important;
    }

    .header-text {
        color: #FFF;
        font-family: Inter;
        font-size: 10px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    @media only screen and (max-width: 764px) {
        .cart-count {

            align-items: center;
            justify-content: center;
            background-color: #e40714;
            color: white;
            padding: 2px;
            font-size: 16px;
            border-radius: 100px;
            line-height: 1.25rem;
            min-width: 1.25rem;

            font-weight: 600;
            box-sizing: border-box;
        }

    }

    @media only screen and (min-width: 765px) {
        .cart-count {
            position: absolute;
            top: -4px;
            right: -12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e40714;
            color: white;
            border-radius: 100px;
            line-height: 1.25rem;
            min-width: 1.25rem;
            font-size: 0.8125rem;
            font-weight: 600;
            box-sizing: border-box;
        }

    }



    /* Custom CSS สำหรับ header__top */

    /* กำหนดพื้นหลังสีน้ำเงินสำหรับแถบด้านบนทั้งหมด */
    .header__top {
        background-color: #007bff;
        /* ใช้สีน้ำเงินที่ใกล้เคียงกับรูปภาพ (คุณอาจต้องปรับค่า #007bff) */
        color: #fff;
        /* ตั้งค่าสีตัวอักษรเป็นสีขาว */
        padding: 10px 0;
        /* เพิ่มช่องว่างด้านบนและล่าง */

        background: linear-gradient(90deg, #3293F0 0%, #005EB8 100%);
        padding-left: 10%;
        padding-right: 10%;
        padding-bottom: 2px;
        padding-top: 2px;
    }

    .body-padding {
        padding-left: 10%;
        padding-right: 10%;
    }

    /* 1. จัดการเนื้อหาให้อยู่ทางขวา (สำหรับมือถือ) */
    .header__top .row {
        display: flex;
        /* ใช้ Flexbox สำหรับการจัดวางที่ยืดหยุ่น */
        align-items: center;
        /* จัดให้อยู่ตรงกลางแนวตั้ง */
        justify-content: flex-end;
        /* จัดกลุ่มคอลัมน์ไปทางขวา */
    }

    /* 2. ซ่อนเนื้อหาส่วนซ้าย (Call Center/Service) บนหน้าจอมือถือ */
    .header__top__left {
        /* display: none; */
    }

    /* 3. จัดการเนื้อหาส่วนขวา (Social Icons) */
    .header__top__right {
        text-align: right;
        /* จัดไอคอนไปทางขวา */
    }

    @media (max-width: 768px) {
        .tg__social a {
            margin-right: 10px;
        }

        .header__top {
            padding-left: 5%;
            padding-right: 5%;
        }

        .body-padding {
            padding-left: 5%;
            padding-right: 5%;
        }
    }

    @media (min-width: 768px) {
        .header__top .row {
            justify-content: space-between;
            /* แยกคอลัมน์ซ้ายและขวาออกจากกัน */
        }

        .header__top__left {
            display: block;
            /* แสดงส่วนนี้ */
            text-align: right;
            /* จัดข้อความให้อยู่ทางขวา */
        }

        .header__top__links p {
            margin: 0;
            line-height: 1;
            font-size: 14px;
        }

        .header__top__links a {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
        }

        .header__top__links a:hover {
            opacity: 0.8;
        }
    }

    .tg__social a {
        color: #fff;

        font-size: 16px;
        vertical-align: middle;
    }

    .tg__social img {
        height: 18px !important;
        /* ปรับขนาดไอคอนรูปภาพ (Line/TikTok) */
        width: 18px !important;
    }
</style>

<body>

    <header class="header" id="navbar_top">
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Offcanvas Menu Begin -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <div class="offcanvas__option">
                <div><a href="<?= base_url() ?>"><img src="<?= base_url('assete/theme/img/logo.png') ?>" alt="logo image"></a></div>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="offcanvas__text">
                <p class="company_call">
                    <a href="tel:063-746-6851" class="header-text">Call Center : 063-746-6851</a>
                </p>
                <p class="company_service">
                    <a href="tel:083-928-8765 " class="header-text">Service : 083-928-8765</a>
                </p>
            </div>
            <div class="offcanvas__links">

                <a class="company_youtube" href="https://www.youtube.com/@tgsmartlife"><i class="fa fa-youtube-play"></i></a>

                <a class="company_line" href="https://lin.ee/gR7kYqK"><img src="<?= base_url('assete/theme/img/icon/line.png') ?>"></a>
                <a class="company_facebook" href="#"><i class="fa fa-facebook"></i></a>
                <a class="company_tiktok" href="https://www.tiktok.com/@tg.smart.life?_t=8kMTblivzLc&_r=1"><img style="width:24px;height:24px;" src="<?= base_url('assete/theme/img/icon/tiktok.png') ?>"></a>




            </div>
        </div>
        <!-- Offcanvas Menu End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="header__top" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-8 col-sm-7 col-md ">
                            <div class="header__top__left">
                                <div class="header__top__links">
                                    <p>
                                        <a class="company_call" href="tel:063-746-6851">Call Center : 063-746-6851</a>
                                        <a class="company_service" href="tel:083-928-8765">Service : 083-928-8765</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-5 col-md-auto " style="padding:0px;">
                            <div class="header__top__right">
                                <div class="tg__social">
                                    <a class="company_facebook" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M7.8505 12.656C10.5881 12.2453 12.6875 9.88342 12.6875 7.0315C12.6875 3.89025 10.1412 1.344 7 1.344C3.85875 1.344 1.3125 3.89025 1.3125 7.0315C1.3125 9.884 3.41192 12.2453 6.1495 12.656V8.6905H4.95367C4.87848 8.6905 4.80637 8.66063 4.7532 8.60747C4.70004 8.5543 4.67017 8.48219 4.67017 8.407V7.33192C4.67017 7.175 4.79733 7.04842 4.95367 7.04842H6.1495L6.1075 5.915C6.1075 5.3655 6.20958 4.47358 6.89033 3.98592C7.36633 3.64583 7.72042 3.58167 8.28858 3.58167C8.7815 3.58167 9.12042 3.63067 9.34442 3.66333L9.45408 3.67792C9.48125 3.68147 9.50619 3.6948 9.52423 3.71542C9.54227 3.73603 9.55217 3.76252 9.55208 3.78992V4.97992C9.55208 5.04583 9.49667 5.09658 9.4325 5.09308H9.41033C9.34383 5.09542 8.99617 5.11 8.701 5.11C8.18183 5.11 7.8505 5.34683 7.8505 6.13375V7.04842H9.12917C9.30417 7.04842 9.43775 7.20592 9.40917 7.37858L9.24583 8.45367C9.23479 8.51981 9.20066 8.57991 9.14951 8.62327C9.09835 8.66663 9.03348 8.69045 8.96642 8.6905H7.8505V12.656Z" fill="white" />
                                        </svg></a>

                                    <a class="company_line" href="https://lin.ee/gR7kYqK"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <g clip-path="url(#clip0_42_264)">
                                                <path d="M6 0.25C9.309 0.25 12 2.447 12 5.147C12 6.227 11.583 7.201 10.714 8.159C9.455 9.617 6.641 11.392 6 11.664C5.89649 11.7134 5.78448 11.7426 5.67 11.75C5.398 11.75 5.46 11.456 5.48 11.338L5.565 10.822C5.586 10.667 5.607 10.428 5.547 10.277C5.48 10.107 5.213 10.021 5.018 9.979C2.135 9.595 0 7.567 0 5.147C0 2.447 2.691 0.25 6 0.25ZM4.781 3.842H4.361C4.34555 3.84187 4.33023 3.8448 4.31592 3.85062C4.30161 3.85644 4.28859 3.86504 4.27762 3.87591C4.26665 3.88679 4.25794 3.89973 4.252 3.91399C4.24606 3.92825 4.243 3.94355 4.243 3.959V6.589C4.243 6.654 4.296 6.706 4.36 6.706H4.781C4.81186 6.70574 4.84136 6.69329 4.86309 6.67138C4.88481 6.64947 4.897 6.61986 4.897 6.589V3.959C4.89713 3.94368 4.89423 3.92849 4.88846 3.9143C4.88269 3.90011 4.87416 3.88721 4.86338 3.87633C4.8526 3.86545 4.83976 3.85682 4.82562 3.85092C4.81148 3.84503 4.79632 3.842 4.781 3.842ZM5.849 3.842H5.424C5.39297 3.842 5.36321 3.85433 5.34127 3.87627C5.31933 3.89821 5.307 3.92797 5.307 3.959V6.589C5.307 6.654 5.36 6.706 5.424 6.706H5.844C5.85945 6.70613 5.87477 6.7032 5.88908 6.69738C5.90339 6.69156 5.91641 6.68296 5.92738 6.67209C5.93835 6.66121 5.94706 6.64827 5.953 6.63401C5.95894 6.61975 5.962 6.60445 5.962 6.589V5.028L7.16 6.656C7.16774 6.66803 7.17797 6.67826 7.19 6.686H7.192L7.198 6.69L7.201 6.692L7.207 6.695L7.213 6.697L7.216 6.699L7.225 6.701L7.255 6.706H7.677C7.70803 6.706 7.73779 6.69367 7.75973 6.67173C7.78167 6.64979 7.794 6.62003 7.794 6.589V3.959C7.794 3.92797 7.78167 3.89821 7.75973 3.87627C7.73779 3.85433 7.70803 3.842 7.677 3.842H7.256C7.22497 3.842 7.19521 3.85433 7.17327 3.87627C7.15133 3.89821 7.139 3.92797 7.139 3.959V5.522L5.942 3.894L5.932 3.882L5.925 3.874L5.923 3.872L5.915 3.865L5.907 3.861L5.905 3.859L5.898 3.855L5.895 3.853L5.888 3.85L5.884 3.849L5.877 3.847L5.873 3.845L5.866 3.844L5.862 3.843L5.849 3.842ZM10.002 3.842H8.32C8.28981 3.84242 8.26089 3.8542 8.239 3.875L8.238 3.876L8.236 3.878C8.2158 3.89979 8.2044 3.92829 8.204 3.958V6.588C8.20387 6.60336 8.20676 6.61861 8.21252 6.63285C8.21828 6.6471 8.22679 6.66007 8.23756 6.67103C8.24833 6.68198 8.26116 6.69071 8.2753 6.69671C8.28945 6.70271 8.30464 6.70587 8.32 6.706H10.002C10.0328 6.70498 10.062 6.69216 10.0836 6.67019C10.1052 6.64823 10.1175 6.6188 10.118 6.588V6.165C10.118 6.13414 10.1058 6.10453 10.0841 6.08262C10.0624 6.06071 10.0329 6.04826 10.002 6.048H8.858V5.603H10.002C10.0174 5.60287 10.0326 5.59971 10.0467 5.59371C10.0608 5.58771 10.0737 5.57898 10.0844 5.56803C10.0952 5.55707 10.1037 5.5441 10.1095 5.52985C10.1152 5.51561 10.1181 5.50036 10.118 5.485V5.063C10.1183 5.0476 10.1155 5.0323 10.1098 5.01799C10.104 5.00369 10.0955 4.99066 10.0847 4.97968C10.0739 4.9687 10.0611 4.95997 10.0469 4.95402C10.0327 4.94806 10.0174 4.945 10.002 4.945H8.858V4.5H10.002C10.0173 4.5 10.0325 4.49697 10.0466 4.49108C10.0608 4.48518 10.0736 4.47655 10.0844 4.46567C10.0952 4.45479 10.1037 4.44189 10.1095 4.4277C10.1152 4.41351 10.1181 4.39832 10.118 4.383V3.96C10.1181 3.94464 10.1152 3.92939 10.1095 3.91515C10.1037 3.9009 10.0952 3.88793 10.0844 3.87697C10.0737 3.86602 10.0608 3.85729 10.0467 3.85129C10.0326 3.84529 10.0174 3.84213 10.002 3.842ZM2.506 3.842H2.085C2.06968 3.842 2.05452 3.84503 2.04038 3.85092C2.02624 3.85682 2.0134 3.86545 2.00262 3.87633C1.99184 3.88721 1.98331 3.90011 1.97754 3.9143C1.97177 3.92849 1.96887 3.94368 1.969 3.959V6.589C1.96967 6.621 1.98033 6.64767 2.001 6.669L2.004 6.673C2.02563 6.69357 2.05416 6.70533 2.084 6.706H3.767C3.78236 6.70587 3.79755 6.70271 3.8117 6.69671C3.82584 6.69071 3.83867 6.68198 3.84944 6.67103C3.86021 6.66007 3.86872 6.6471 3.87448 6.63285C3.88024 6.61861 3.88313 6.60336 3.883 6.588V6.165C3.88313 6.14968 3.88023 6.13449 3.87446 6.1203C3.86869 6.10611 3.86016 6.09321 3.84938 6.08233C3.8386 6.07145 3.82576 6.06282 3.81162 6.05692C3.79748 6.05103 3.78232 6.048 3.767 6.048H2.623V3.958C2.623 3.94268 2.61997 3.92752 2.61408 3.91338C2.60818 3.89924 2.59955 3.8864 2.58867 3.87562C2.57779 3.86484 2.56489 3.85631 2.5507 3.85054C2.53651 3.84477 2.52132 3.84187 2.506 3.842Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_42_264">
                                                    <rect width="12" height="12" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg></a>

                                    <a class="company_youtube" href="https://www.youtube.com/@tgsmartlife"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                            <g clip-path="url(#clip0_42_262)">
                                                <path d="M12.9147 3.77787C12.9147 2.63529 12.0743 1.71615 11.0358 1.71615C9.62917 1.65039 8.1946 1.625 6.72855 1.625H6.27152C4.80902 1.625 3.37191 1.65039 1.96527 1.71641C0.929329 1.71641 0.0888995 2.64062 0.0888995 3.7832C0.025423 4.68686 -0.00149111 5.59076 3.23321e-05 6.49467C-0.00250673 7.39857 0.0262693 8.30333 0.0863605 9.20893C0.0863605 10.3515 0.92679 11.2783 1.96273 11.2783C3.44046 11.3468 4.95628 11.3773 6.49749 11.3747C8.04124 11.3798 9.55283 11.3477 11.0323 11.2783C12.0707 11.2783 12.9112 10.3515 12.9112 9.20893C12.9721 8.30248 13 7.39857 12.9975 6.49213C13.0032 5.58822 12.9757 4.68347 12.9147 3.77787ZM5.25589 8.98549V3.99623L8.93753 6.48959L5.25589 8.98549Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_42_262">
                                                    <rect width="13" height="13" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg></a>

                                    <a class="company_tiktok" href="https://www.tiktok.com/@tg.smart.life?_t=8kMTblivzLc&_r=1"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M10.9999 1.75H3.00008C2.66864 1.75031 2.35085 1.88211 2.11648 2.11648C1.88211 2.35085 1.75031 2.66864 1.75 3.00008V10.9999C1.75 11.69 2.31058 12.25 3.00008 12.25H10.9999C11.3314 12.2497 11.6491 12.1179 11.8835 11.8835C12.1179 11.6491 12.2497 11.3314 12.25 10.9999V3.00008C12.2497 2.66864 12.1179 2.35085 11.8835 2.11648C11.6491 1.88211 11.3314 1.75031 10.9999 1.75ZM10.0013 6.33092C9.6333 6.36664 9.2631 6.29125 8.93842 6.1145C8.66456 5.96685 8.43196 5.7531 8.26175 5.49267V8.37667C8.26175 8.79824 8.13674 9.21034 7.90253 9.56086C7.66831 9.91139 7.33542 10.1846 6.94594 10.3459C6.55646 10.5072 6.12789 10.5495 5.71441 10.4672C5.30094 10.385 4.92115 10.182 4.62305 9.88386C4.32496 9.58577 4.12195 9.20597 4.03971 8.7925C3.95746 8.37903 3.99967 7.95046 4.161 7.56098C4.32233 7.1715 4.59553 6.8386 4.94605 6.60439C5.29658 6.37018 5.70868 6.24517 6.13025 6.24517C6.17458 6.24517 6.21775 6.24925 6.2615 6.25158V7.30217C6.21775 7.29692 6.17517 7.28875 6.13025 7.28875C5.84172 7.28875 5.565 7.40337 5.36098 7.60739C5.15695 7.81142 5.04233 8.08813 5.04233 8.37667C5.04233 8.6652 5.15695 8.94192 5.36098 9.14594C5.565 9.34996 5.84172 9.46458 6.13025 9.46458C6.73108 9.46458 7.26192 8.9915 7.26192 8.39067L7.27242 3.49183H8.2775C8.3235 3.92842 8.52143 4.33496 8.83672 4.64043C9.15201 4.94591 9.5646 5.1309 10.0024 5.16308V6.33092" fill="white" />
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container body-padding" style="width:100%;min-width:100%;">
                <div class="row">
                    <!-- <div class="col-lg-2 col-md-2"> -->
                        <div class="col-md-auto">
                        <div class="header__logo " style="padding:21px 0 25px;">
                            <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assete/theme/img/logo.png') ?>" alt="logo image" style="width: 63px;
height: 43px;
aspect-ratio: 63/43;"></a>
                        </div>
                    </div>
                    <div class="col-md-8" style="    align-items: flex-start;
    display: flex;">
                        <nav class="header__menu mobile-menu header__responsive pull-right">
                            <ul class="">
                                <li class="nav-item <?php echo $this->uri->uri_string() == '' ? 'active' : ''; ?>">
                                    <a class="nav-link" href="<?= base_url('') ?>">หน้าแรก</a>
                                </li>

                                <?php
                                // โค้ด PHP สำหรับตรวจสอบ Products
                                $products_uri_string = isset($this->uri->segments[1]) ? $this->uri->segments[1] : $this->uri->uri_string();
                                ?>

                                <li class="nav-item <?php echo $products_uri_string  == 'products' || $products_uri_string == "product_detail" ? 'active' : ''; ?>">
                                    <a class="nav-link" href="<?= base_url('products') ?>">ผลิตภัณฑ์</a>
                                </li>

                                <li class="nav-item submenu" style="padding-right:8px;"><a href="#">องค์ความรู้</a>
                                    <ul class="dropdown">
                                        <li><a class="submenu-link" href="<?= base_url('knowledge') ?>">ข้อมูลทั่วไป</a></li>
                                    </ul>
                                </li>

                                <?php
                                // โค้ด PHP สำหรับตรวจสอบเมนูย่อยอื่นๆ
                                $uri_string  = isset($this->uri->segments[1]) ? $this->uri->segments[1] : "";
                                $support_list = [
                                    "support",
                                    "tg-help",
                                    "service-center",
                                    "product-data-center",
                                    "register-product",
                                    "installation-agent",
                                    "faq"
                                ];
                                $aboutus_list = [
                                    "about",
                                    "contact-us",
                                    "tg-service",
                                    "tg-project",
                                    "career",
                                    "term_of_condition",
                                    "term_of_refund",
                                    "pdpa",
                                    "shipping_policy"
                                ];
                                $service_detail = ['review', 'suggestion', 'service_maintain'];
                                ?>

                                <li class="nav-item submenu <?php echo in_array(strval($uri_string), $support_list)  ? 'active' : ''; ?>"><a href="#">บริการช่วยเหลือ</a>
                                    <ul class="dropdown">
                                        <li><a class="submenu-link" href="<?= base_url('support') ?>">บริการช่วยเหลือ</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('tg-help') ?>">ขั้นตอนการสั่งซื้อสินค้า</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('service-center') ?>">ศูนย์บริการ TG smart life</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('product-data-center') ?>">ศูนย์รวมข้อมูลผลิตภัณฑ์</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('register-product') ?>">ตรวจสอบลงทะเบียนสินค้า</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('installation-agent') ?>">ตัวแทนติดตั้ง</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('faq') ?>">คำถามที่พบบ่อย</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item submenu <?php echo in_array(strval($uri_string), $aboutus_list)  ? 'active' : ''; ?>""><a href=" #">เกี่ยวกับเรา</a>
                                    <ul class="dropdown">
                                        <li><a class="submenu-link" href="<?= base_url('about') ?>">เกี่ยวกับเรา</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('contact-us') ?>">ติดต่อเรา</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('tg-service') ?>">TG Smart life Service</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('tg-project') ?>">TG Smart life Project</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('career') ?>">ร่วมงานกับเรา</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('term_of_condition') ?>">เงื่อนไขและข้อตกลงในการใช้งาน</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('term_of_refund') ?>">เงื่อนไขการเปลี่ยน/คืนสินค้า และคืนเงิน</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('pdpa') ?>">นโยบายคุ้มครองความเป็นส่วนตัว</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('shipping_policy') ?>">นโยบายการจัดส่งและรับประกันสินค้า</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item submenu <?php echo in_array(strval($uri_string), $service_detail)  ? 'active' : ''; ?>""><a href=" #">บริการหลังการขาย</a>
                                    <ul class="dropdown" style="padding-right:8px;">
                                        <li><a class="submenu-link" href="<?= base_url('review') ?>">รีวิว</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('suggestion') ?>">คำติชมหลังการบริการ</a></li>
                                        <li><a class="submenu-link" href="<?= base_url('service_maintain') ?>">แจ้งซ่อม</a></li>
                                    </ul>
                                </li>



                            </ul>
                        </nav>
                    </div>


                      <div class="col-md p-0">
                          <nav class="header__menu mobile-menu header__responsive pull-right">
                            <ul class="" style="display:inline-flex;">
                    <li class="nav-item **pull-right** <?php echo $this->uri->uri_string() == 'cart' ? 'active' : ''; ?>" style="margin-right:15px;">
                        <a class="nav-link" href="<?= base_url('cart') ?>">
                            <!-- <i class="fa fa-shopping-cart" id="cart-icon" style="font-size:16px;color:white;"></i> -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M12.1251 14.8631C12.6636 14.8631 13.1001 14.3892 13.1001 13.8046C13.1001 13.2201 12.6636 12.7461 12.1251 12.7461C11.5867 12.7461 11.1501 13.2201 11.1501 13.8046C11.1501 14.3892 11.5867 14.8631 12.1251 14.8631Z" fill="black" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5.6249 14.8631C6.16336 14.8631 6.5999 14.3892 6.5999 13.8046C6.5999 13.2201 6.16336 12.7461 5.6249 12.7461C5.08642 12.7461 4.6499 13.2201 4.6499 13.8046C4.6499 14.3892 5.08642 14.8631 5.6249 14.8631Z" fill="black" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.7 2.16132H13.75L12.45 9.92357H4L2.7 2.16132ZM2.7 2.16132C2.59166 1.69088 2.05 0.75 0.75 0.75" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.4501 9.92363H4.00007H2.85007C1.69027 9.92363 1.07507 10.4749 1.07507 11.3349C1.07507 12.195 1.69027 12.7463 2.85007 12.7463H12.1251" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span id="cart-count" class="cart-count">0</span>

                        </a>

                    </li>
                    <?php if (!isset($_SESSION['user_id'])) { ?>
                        <li class="nav-item **pull-right** <?php echo $this->uri->uri_string() == 'login' ? 'active' : ''; ?>">

                            <a class="nav-link" href="<?= base_url('login') ?>">
                                |
                                <span style="top:0px;"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 12 14" fill="none">
                                        <path d="M0.75 12.7985V12.0454C0.75 9.13423 2.98858 6.77424 5.75 6.77424C8.51143 6.77424 10.75 9.13423 10.75 12.0454V12.7985" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.75009 6.77422C7.32802 6.77422 8.60723 5.42562 8.60723 3.76211C8.60723 2.09857 7.32802 0.75 5.75009 0.75C4.17213 0.75 2.89294 2.09857 2.89294 3.76211C2.89294 5.42562 4.17213 6.77422 5.75009 6.77422Z" stroke="#2F2F2F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                                เข้าสู่ระบบ
                            </a>
                        </li>
                    <?php } else { ?>
                        <?php
                        $username = $_SESSION['username'];
                        if (strlen($username) > 10) {
                            $username = substr($username, 0, 10) . '...';
                        }
                        $profile_list = ['profile', 'orders'];
                        ?>
                        <li class="nav-item submenu **pull-right** <?php echo in_array(strval($uri_string), $profile_list)  ? 'active' : ''; ?>""><a href=" #" title="<?php echo $_SESSION['username'] ?>"><?php echo $username; ?></a>
                            <ul class="dropdown">
                                <li><a class="submenu-link" href="<?= base_url('orders') ?>">คำสั่งซื้อ</a></li>
                                <li><a class="submenu-link" href="<?= base_url('profile') ?>">ข้อมูลส่วนบุคคล</a></li>
                                <li><a class="submenu-link" href="<?= base_url('logout') ?>">logout</a></li>
                            </ul>
                        </li>
                    <?php } ?>
</ul>
</nav>

                    </div>



                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>


        </header>
        <!-- Header Section End -->
    </header>
    <script type="text/javascript">
        var base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('assete/js/add_to_cart.js?d=202608171430') ?>"></script>
    <script type="text/javascript">
        var user_id = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0 ?>';
        var cartData = JSON.parse(localStorage.getItem('cartData')) || {};
        console.log(cartData);
        // คำนวณจำนวนสินค้าทั้งหมด
        var totalItems = 0;
        if (cartData && user_id == 0) {
            for (var key in cartData) {
                if (cartData.hasOwnProperty(key)) {
                    totalItems += parseInt(cartData[key].amount);
                }
            }

            var cartCountElement = document.getElementsByClassName('cart-count')[0];

            if (cartCountElement) {
                cartCountElement.innerText = totalItems;
            }




        } else {
            getAmount();
        }
    </script>


<script>window.$zoho=window.$zoho || {};$zoho.salesiq=$zoho.salesiq||{ready:function(){}}</script><script id="zsiqscript" src="https://salesiq.zohopublic.com/widget?wc=siq431a8ff372cb263fd2cc5c49758f9a777067f6fb5c3231e36a74716351d7fef3" defer></script>