<?php
require_once('./helper/helper.php');

use function Helper\{get_session};

get_session();

$root_public_dashboard = '/public/dashboard';
$root_dashboard_template =  './pages/dashboard/src/template';
$root_dashboard_src_css = '/pages/dashboard/src/css';
$root_dashboard_src_js = '/pages/dashboard/src/js';
$root_dashboard_src_img = '/pages/dashboard/src/img';

$routes = [
    "dashboard" => "/dashboard",
    "paru" => "/dashboard/lungs",
    "jantung" => "/dashboard/heart",
    "bmi" => "/dashboard/bmi",
    "none" => "#",

];
