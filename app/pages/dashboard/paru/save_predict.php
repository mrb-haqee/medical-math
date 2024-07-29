<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_pdo};

get_session();

$pdo = get_pdo();

if ($_POST['action'] = "predict") {
    $label = $_POST["predict_label"];
    $prediction = json_encode($_POST["sortedPredict"]);
    $base64 = $_POST["image"];

    try {
        $sql = "INSERT INTO data_predict (email, label, prediction) VALUES (:email, :label, :prediction)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            [
                ':email' => $_SESSION['email'],
                ':label' => $label,
                ':prediction' => $prediction
            ]
        );
        echo feedback('sukses', "Data Berhasil di Simpan!");
    } catch (PDOException $e) {
        echo feedback('error', "Error: " . $e->getMessage());
    }
} else if (isset($_FILES['image'])) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileData = file_get_contents($fileTmpPath);
    $base64 = base64_encode($fileData);

    $base64_encode = json_encode($base64);

    $sql = "SELECT id FROM data_predict ORDER BY id DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $lastId = $stmt->fetchColumn();

    echo json_encode($lastId);
    // try {
    //     $sql = "INSERT INTO data_image_paru (id_predict, image) VALUES (:id_predict, :image)";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->execute(
    //         [
    //             ':id_predict' => $lastID,
    //             ':image' => $base64_encode
    //         ]
    //     );

    //     echo feedback('sukses', "Data Berhasil di Simpan!");
    // } catch (PDOException $e) {
    //     echo feedback('error', "Error: " . $e->getMessage());
    // }
}
