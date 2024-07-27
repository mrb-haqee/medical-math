<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_data_ICD, get_pdo, getDataByDiagnosis};

get_session();

try {
    // Menghubungkan ke database
    $pdo = get_pdo();

    // Menyiapkan statement SQL untuk mengambil data
    $stmt = $pdo->prepare("SELECT * FROM data_predict_jantung WHERE email = :email ORDER BY date DESC");
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Mengambil semua hasil sebagai array asosiatif
    foreach ($results as $data) {;
        $biodata = json_decode($data['biodata'], true);
        $labels = json_decode($data['labels'], true);
        $DU = getDataByDiagnosis($labels['DU'], $pdo);
        $DS = getDataByDiagnosis($labels['DS'], $pdo, true);

        $date = new DateTime($data['date']);
?>
        <tr data-id="<?= $data['id'] ?>">
            <td scope="row"><?= $data['email'] ?></td>
            <td><a href="#<?= $data['id'] ?>" class="btn-j-detail"><i class="fas fa-user-injured"></i></a> <?= $biodata['nama']; ?></td>
            <td><?= implode("<br> ",  $DU) ?></td>
            <td><?= implode(", ",  $DS) ?> <a href="#<?= $data['id'] ?>" class="btn-j-icd10"><i class="fas fa-search-plus"></i></a></td>
            <td><?= implode("<br> ",  $labels['OB']) ?></td>
            <td><?= $date->format('d-m-Y') ?></td>
        </tr>
<?php
    }
} catch (PDOException $e) {
    echo feedback('error', "Error: " . $e->getMessage());
}
