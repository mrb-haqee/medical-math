<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_pdo};

get_session();

$pdo = get_pdo();

if (isset($_POST)) {
    $biodata = json_encode($_POST["biodata"]);
    $labels = json_encode($_POST["labels"]);
    $input = json_encode($_POST["input"]);
    $prediction = json_encode($_POST["predict"]);


    try {
        $sql = "INSERT INTO data_predict_jantung (email, biodata, labels, input, prediction) VALUES (:email, :biodata, :labels, :input, :prediction)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            [
                ':email' => $_SESSION['email'],
                ':biodata' => $biodata,
                ':labels' => $labels,
                ':input' => $input,
                ':prediction' => $prediction
            ]
        );

        echo feedback('sukses', "Data Berhasil di Simpan!");
    } catch (PDOException $e) {
        echo feedback('error', "Error: " . $e->getMessage());
    }
}
