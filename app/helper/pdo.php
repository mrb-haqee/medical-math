<?php

namespace Helper;

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/db/Connect.php');
require_once($root . '/helper/CryptoHelper.php');

use Helper\CryptoHelper;
use Database\Database;

function get_pdo()
{
    $crypto = new CryptoHelper();

    $DATA_ENV = json_decode($crypto->Decrypt($_ENV['DB_CONFIG'], $_ENV['PASS_ENCRYPT']), true);
    $DATA_ENV["DB_NAME"] = $_ENV['DB_NAME'];

    $pdo = Database::connect($DATA_ENV);
    return $pdo;
}
