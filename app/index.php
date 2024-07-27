<?php
// $_ENV['DB_CONFIG'] = 'do6DJ2xnvzm6fbuW9qVUa90wkJ27cZ3KsMG4m+jnIRZa2Y61Of63LoWQzzB3RD0i0P0+A5Uxy1LdPBkUeZGUjC89iNR9zSl/7YaamSmN+bMb636decJ8iv41i177xDKQDHtH09qAP5o2pzdxrRGBsulTgz5VbmzGXRFAxTeqF/9XQ0BdOC2d7hYmCg7rpZGy==';
// $_ENV['PASS_ENCRYPT'] = 'mrb28';
// $_ENV['DB_NAME'] = 'db_paru';

$root = $_SERVER['DOCUMENT_ROOT'];

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

require_once($root . '/helper/pdo.php');
require_once($root . '/helper/helper.php');

use function Helper\{get_pdo, sentil_model};

sentil_model();

try {
    $pdo = get_pdo();

    $routes = array(
        // home
        "/" => $root . "/pages/home/home.php",

        // auth
        "/auth" => $root . "/pages/auth/auth.php",
        "/auth_process" => $root . "/pages/auth/auth_process.php",
        "/logout" => $root . "/pages/dashboard/logout.php",

        // dashboard
        "/dashboard" => $root . "/pages/dashboard/dashboard.php",

        // predict lungs
        "/dashboard/lungs" => $root . "/pages/dashboard/paru/paru.php",
        "/icd10" => $root . "/pages/dashboard/paru/get_icd10.php",
        "/tabel_predict" => $root . "/pages/dashboard/paru/tabel_predict.php",
        "/save_predict" => $root . "/pages/dashboard/paru/save_predict.php",

        // predict jantung
        "/dashboard/heart" => $root . "/pages/dashboard/jantung/jantung.php",
        "/dashboard/heart/summary" => $root . "/pages/dashboard/jantung/temp_summary.php",
        "/dashboard/heart/predict" => $root . "/pages/dashboard/jantung/temp_predict.php",
        "/dashboard/heart/predict" => $root . "/pages/dashboard/jantung/temp_predict.php",
        "/dashboard/heart/save_predict" => $root . "/pages/dashboard/jantung/save_predict.php",
        "/dashboard/heart/tabel_predict" => $root . "/pages/dashboard/jantung/tabel_predict.php",
        "/dashboard/heart/modal" => $root . "/pages/dashboard/jantung/modal_jantung.php",
    );

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (array_key_exists($url, $routes)) {
        include($routes[$url]);
    } else {
        // Handle 404 Not Found
        header("HTTP/1.0 404 Not Found");
        include($root . "/pages/error/404.php");
    }
} catch (Exception $e) {
    die("Database connection failed: \n" . $e->getMessage());
}
// include "auto-reload.php";
