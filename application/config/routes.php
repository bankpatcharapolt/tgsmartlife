<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['default_controller'] = 'Main';

$route['login/get_districts/(.*)'] = 'Login/get_districts/$1';



$route['products'] = 'Main/products';
$route['products/(.*)'] = 'Main/products/$1';
$route['products/(.*)/(.*)'] = 'Main/products/$1/$2';

$route['product_detail/(.*)'] = 'Main/product_detail/$1';

$route['term_of_condition'] = 'Main/term_of_condition';
$route['term_of_refund'] = 'Main/term_of_refund';
$route['pdpa'] = 'Main/pdpa';
$route['shipping_policy'] = 'Main/shipping_policy';


$route['knowledge'] = "Main/knowledge";
$route['warranty/(.*)'] = 'Main/warranty/$1';
$route['knowledge_detail/(.*)'] = "Main/knowledge_detail/$1";
$route['career'] = "Main/careers";
$route['faq'] = "Main/faq";
$route['about'] = "Main/about";
$route['tg-service'] = "Main/tg_service";
$route['tg-project'] = "Main/tg_project";
$route['support'] = "Main/support";
$route['tg-help'] = "Main/tg_help";
$route['service-center'] = "Main/service_center";
$route['product-data-center'] = "Main/product_data_center";
$route['register-product'] = "Main/register_product";
$route['review'] = "Main/review";
$route['review/(.*)'] = 'Main/review/$1';
$route['review_detail/(.*)'] = "Main/review_detail/$1";
$route['suggestion'] = "Main/suggestion";
$route['suggestion/(.*)'] = 'Main/suggestion/$1';

$route['service_maintain'] = "Main/service_maintain";
$route['service_maintain/(.*)'] = 'Main/service_maintain/$1';


$route['company-profile'] = "Main/companyprofile";
$route['service-center'] = "Main/servicecenter";
$route['contact-us'] = "Main/contactus";
$route['installation-agent'] = "Main/installation_agent";

// $route['temped'] = 'home/hom_temped';
// $route['solardetail'] = 'solardetail';
// $route['marketing'] = 'marketing';
// $route['marketcate/(.*)'] = 'marketing/products/$1';
// $route['product/(.*)'] = 'marketing/productdetail/$1';
// $route['product_desc/(.*)/(.*)'] = 'marketing/productdetail/$1/$2';

// $route['sendingEmail'] = 'contact/sending_email';



// $route['marketcate/(.*)'] = 'marketing/products/$1';




//### ADMIN ###//
$route['admin'] = 'admin/Admin/login_page';
$route['regis'] = 'admin/Admin/regis_page';

$route['admin_product'] = 'admin/Product/product_page';

$route['admin_blog'] = 'admin/Blog/blog_page';
$route['admin_blog_add'] = 'admin/Blog/blog_add';
$route['admin_blog_edit/(.*)'] = 'admin/Blog/blog_edit/$1';


$route['admin_feedback'] = 'admin/feedback';
$route['admin_feedback_add'] = 'admin/feedback/feedback_add';
$route['admin_feedback_edit/(.*)'] = 'admin/feedback/feedback_edit/$1';

$route['admin_maintain'] = 'admin/maintain';
$route['admin/admin_maintain/ma_actions'] = 'admin/maintain/ma_actions'; 
$route['admin_maintain_add'] = 'admin/maintain/maintain_add';
$route['admin_maintain_edit/(.*)'] = 'admin/maintain/maintain_edit/$1'; 



$route['admin_review'] = 'admin/Review/review_page';
$route['admin_review_add'] = 'admin/Review/review_add';
$route['admin_review_edit/(.*)'] = 'admin/Review/review_edit/$1';

$route['admin_career'] = 'admin/Career/career_page';
$route['admin_career_add'] = 'admin/Career/career_add';
$route['admin_career_edit/(.*)'] = 'admin/Career/career_edit/$1';

$route['admin_tgsmartlifeservice'] = 'admin/Others/tgsmartlifeservice';
$route['admin_tgsmartlifeproject'] = 'admin/Others/tgsmartlifeproject';

$route['order'] = 'admin/Order/index';
$route['order_add'] = 'admin/Order/order_add';
$route['order_edit/(.*)'] = 'admin/Order/order_edit/$1';


$route['admin_product'] = 'admin/Product/product_page';
$route['admin_product_add'] = 'admin/Product/product_add';
$route['admin_product_edit/(.*)'] = 'admin/Product/product_edit/$1';

$route['admin_product_category'] = 'admin/Product/category_page';
$route['admin_product_cate_add'] = 'admin/Product/category_add';
$route['admin_product_cate_edit/(.*)'] = 'admin/Product/category_edit/$1';

$route['admin_product_subcategory'] = 'admin/Product/sub_category_page';
$route['admin_product_subcate_add'] = 'admin/Product/sub_category_add';
$route['admin_product_subcate_edit/(.*)'] = 'admin/Product/sub_category_edit/$1';


$route['admin_product_tag'] = 'admin/Product/tag_page';
$route['admin_product_tag_add'] = 'admin/Product/tag_add';
$route['admin_product_tag_edit/(.*)'] = 'admin/Product/tag_edit/$1';

$route['admin_product_type'] = 'admin/Product/type_page';
$route['admin_product_type_add'] = 'admin/Product/type_add';
$route['admin_product_type_edit/(.*)'] = 'admin/Product/type_edit/$1';

$route['admin_product_spec'] = 'admin/Product/spec_page';
$route['admin_product_spec_action/(.*)'] = 'admin/Product/spec_action/$1';

$route['admin_productdetail_spec'] = 'admin/Product/spec_detail';
$route['admin_productdetail_spec_action/(.*)'] = 'admin/Product/spec_detail/$1';
$route['admin_productdetail_spec_edit/(.*)'] = 'admin/Product/spec_edit/$1';


$route['admin_product_manual'] = 'admin/Product/manual_detail';
$route['admin_product_manual_action/(.*)'] = 'admin/Product/manual_detail/$1';
$route['admin_product_manual_edit/(.*)'] = 'admin/Product/manual_edit/$1';



$route['admin_faq_sub'] = 'admin/Faq/faq_page';
$route['admin_faq_sub/faq_add'] = 'admin/Faq/faq_add';
$route['admin_faq_sub/faq_edit/(.*)'] = 'admin/Faq/faq_edit/$1';
$route['admin_faq_sub_action/(.*)'] = 'admin/Faq/faq_action/$1';

$route['admin_product_regis'] = 'admin/Product/regis_page';
$route['admin_product_regis_add'] = 'admin/Product/regis_add';
$route['admin_product_regis_edit/(.*)'] = 'admin/Product/regis_edit/$1';
$route['admin_product_regis_import'] = 'admin/Product/regis_import';
$route['admin_product_regis_product_options'] = 'admin/Product/regis_product_options';

$route['admin_slide'] = 'admin/Product/slide_page';
$route['admin_slide_add'] = 'admin/Product/slide_add';
$route['admin_slide_edit/(.*)'] = 'admin/Product/slide_edit/$1';


$route['admin_helpservice'] = 'admin/Helpservice/helpservice_page';
$route['admin_helpservice_add'] = 'admin/Helpservice/helpservice_add';
$route['admin_helpservice_edit/(.*)'] = 'admin/Helpservice/helpservice_edit/$1';

$route['admin_generalsetting'] = 'admin/Product/generalsetting_page';

$route['admin_webcontact'] = 'admin/Other/webcontact_page';
$route['admin_webcontact_edit/(.*)'] = 'admin/Other/webcontact_edit/$1';

$route['admin_seo'] = 'admin/Seo/seo_page';
$route['admin_seo_add'] = 'admin/Seo/seo_add';
$route['admin_seo_edit/(.*)'] = 'admin/Seo/seo_edit/$1';

$route['admin_team'] = 'admin/Teams/page';
$route['admin_team_add'] = 'admin/Teams/add';
$route['admin_team_edit/(.*)'] = 'admin/Teams/edit/$1';
$route['admin_team_product'] = 'admin/Teams/team_product_page';
$route['admin_team_product_action/(.*)'] = 'admin/Teams/team_product_action_page/$1';



//### TEAM SALE ###//
$route['teamsale'] = 'teamsale/Admin/login_page';
$route['teamsale_regis'] = 'teamsale/Admin/regis_page';

$route['teamsale/product'] = 'teamsale/Teamsale/product_page';
$route['teamsale/product_sold_out'] = 'teamsale/Teamsale/product_sold_out';
$route['teamsale/product_sold_out_add'] = 'teamsale/Teamsale/product_sold_out_add';
$route['teamsale/product_sold_out_edit/(.*)'] = 'teamsale/Teamsale/product_sold_out_edit/$1';

// $route['admin_career_add'] = 'admin/Career/career_add';
// $route['admin_career_edit/(.*)'] = 'admin/Career/career_edit/$1';


// //### PRODUCT ###//
// $route['admin/product'] = 'admin/Product/product_page';
// $route['admin/product_add'] = 'admin/Product/product_add';
// $route['admin/product_edit/(.*)'] = 'admin/Product/product_edit/$1';

// $route['admin/product_cate'] = 'admin/Product/category_page';
// $route['admin/product_cate_add'] = 'admin/Product/category_add';
// $route['admin/product_cate_edit/(.*)'] = 'admin/Product/category_edit/$1';


// //### SN ###//
// $route['sn-admin'] = 'sn/Admin/login_page';
// $route['sn-regis'] = 'sn/Admin/regis_page';
// $route['sn-admin/serial-number'] = 'sn/Serial_number/serial_number_page';
// $route['sn-admin/serial-detail'] = 'sn/Serial_number/serial_detail_page';
// $route['sn-admin/serial-erp'] = 'sn/Serial_number/serial_erp_page';