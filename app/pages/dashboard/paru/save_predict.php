<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{get_env, feedback, get_session, get_pdo};

get_session();

$pdo = get_pdo();

if (isset($_POST)) {
    $label = $_POST["predict_label"];
    $prediction = json_encode($_POST["sortedPredict"]);


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
}


// Pastikan ada file yang diunggah

// if (isset($_FILES['form']['imageFile'])) {

//     $file = $_FILES['form']['imageFile'];

//     // Pastikan file telah diunggah dengan benar
//     if ($file['error'] == UPLOAD_ERR_OK) {
//         // Tentukan direktori tempat menyimpan file
//         $targetDirectory = $root . "/public/uploads/";

//         // Buat nama unik untuk file
//         $fileName = uniqid() . '_' . basename($file['name']);

//         // Gabungkan direktori target dengan nama file
//         $targetFilePath = $targetDirectory . $fileName;

//         // Coba pindahkan file ke direktori target
//         if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
//             // Jika berhasil, kirim respons berhasil
//             $response = array(
//                 "status" => "success",
//                 "message" => "File uploaded successfully",
//                 "filename" => $fileName,
//                 "label" => $_POST['label']
//             );
//             echo json_encode($response);
//         } else {
//             // Jika gagal, kirim respons gagal
//             $response = array(
//                 "status" => "error",
//                 "message" => "Failed to upload file"
//             );
//             echo json_encode($response);
//         }
//     } else {
//         // Jika terjadi kesalahan saat mengunggah file, kirim respons error
//         $response = array(
//             "status" => "error",
//             "message" => "Error uploading file: " . $file['error']
//         );
//         echo json_encode($response);
//     }
// } else {
//     // Jika tidak ada file yang diunggah, kirim respons error
//     $response = array(
//         "status" => "error",
//         "message" => "No file uploaded"
//     );
//     echo json_encode($response);
// }
