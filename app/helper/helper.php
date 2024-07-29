<?php

namespace Helper;

function feedback($status, $message = "", $data = null)
{
    return json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
}

function get_session()
{
    session_start(); // Memulai sesi

    // Memeriksa apakah sesi 'email' ada
    if (!isset($_SESSION['email'])) {
        header("Location: /auth");
        exit(); // Hentikan eksekusi skrip lebih lanjut
    }
}

function get_data_ICD($pdo, $data)
{

    if (strpos($data, '_') === false) {
        // Prepare and execute the first query
        try {
            $sql = "SELECT kode, diagnosis FROM icd_10 WHERE diagnosis LIKE ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["%" . $data . "%"]);
            $dataDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $dataDB;
        } catch (\PDOException $e) {
            return ""; // Return empty string if there's an error during the first query
        }
    } else {

        $parts = explode("_", $data);
        if (count($parts) != 2) {
            return ""; // Return empty string if the input does not have exactly two parts
        }

        list($data1, $data2) = $parts;

        // Prepare and execute the first query
        try {
            $sql = "SELECT kode, diagnosis FROM icd_10 WHERE diagnosis LIKE ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["%" . $data1 . "%"]);
            $dataDB1 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return ""; // Return empty string if there's an error during the first query
        }

        // Prepare and execute the second query
        try {
            $stmt->execute(["%" . $data2 . "%"]);
            $dataDB2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return ""; // Return empty string if there's an error during the second query
        }

        // Merge the results of the two queries
        return merge($dataDB1, $dataDB2);
    }
}

function merge($dataDB1, $dataDB2)
{
    // Menggabungkan kedua array
    $mergedData = $dataDB1;

    foreach ($dataDB2 as $item) {
        // Memeriksa apakah kode sudah ada di $mergedData
        $found = false;
        foreach ($mergedData as $existingItem) {
            if ($existingItem['kode'] == $item['kode']) {
                $found = true;
                break;
            }
        }

        // Jika kode belum ada di $mergedData, tambahkan item tersebut
        if (!$found) {
            $mergedData[] = $item;
        }
    }

    return $mergedData;
}

function sentil_model()
{
    $urls = ["https://medical-math-py.onrender.com", "https://medical-math-model-jantung.onrender.com", "https://medical-math-model-paru.onrender.com"];

    foreach ($urls as $url) {
        $response = @file_get_contents($url, false);
        $http_code = isset($http_response_header[0]) ? (int)explode(' ', $http_response_header[0])[1] : null;
        if ($http_code != 200) {
            return "rusak";
        }
    }
    return 'baik';
}

function getDataByDiagnosis($diagnoses, $pdo, $only_code = false)
{
    $data = [];
    foreach ($diagnoses as $diagnosis) {
        $stmt = $pdo->prepare("SELECT kode FROM icd_10_jantung WHERE diagnosis = :diagnosis");
        $stmt->bindParam(':diagnosis', $diagnosis, \PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($results) {

            if ($only_code) {
                if (!in_array($results['kode'], ["D1", "D2", "D3", "D4", "D5"])) {
                    array_push($data, $results['kode']);
                } else {
                    array_push($data, $diagnosis);
                }
            } else {
                if (!in_array($results['kode'], ["D1", "D2", "D3", "D4", "D5"])) {
                    array_push($data, $results['kode'] . " - " . $diagnosis);
                } else {
                    array_push($data, $diagnosis);
                }
            }
        }
    }
    return $data;
}
