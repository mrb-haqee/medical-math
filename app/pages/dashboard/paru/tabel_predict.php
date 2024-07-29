<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_data_ICD, get_pdo};

get_session();

function badge($prob)
{
    if ($prob < 0.3) {
        echo "secondary";
    } elseif ($prob > 0.7) {
        echo "danger";
    } else {
        echo "warning";
    }
}

try {
    // Menghubungkan ke database
    $pdo = get_pdo();

    // Menyiapkan statement SQL untuk mengambil data
    $stmt = $pdo->prepare("SELECT * FROM data_predict WHERE email = :email ORDER BY date DESC");
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mengambil semua hasil sebagai array asosiatif
    foreach ($results as $data) {
        $prediction = json_decode($data['prediction'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            continue; // Skip jika decoding JSON gagal
        }
        $prediction = array_slice($prediction, 0, 5);
        $all_icd10 = get_data_ICD($pdo, $data['label']);
        $icd10 = array_slice($all_icd10, 0, 4);
?>
        <tr data-id="<?= $data['id'] ?>">
            <td scope="row"><?= $data['email'] ?></td>
            <td><a href="#<?= $data['id'] ?>" class="btn-p-view" style="font-size: x-large;"><i class="far fa-image"></i></a></td>
            <td class="text-center">
                <button class="btn row row-cols-1 row-cols-sm-1 row-cols-xl-4">
                    <?php foreach ($prediction as $pred) : ?>
                        <span class="col rounded-2 mb-1 text-bg-<?php badge($pred['prob']); ?>"><?= $pred['label'] ?></span>
                    <?php endforeach ?>
                </button>
            </td>
            <td>
                <?php foreach ($icd10 as $item) {
                    echo $item['kode'] . ", ";
                } ?>
                <a href="#tabel-predict" class="btn-p-icd10" data-label='<?= $data['label'] ?>'><i class="fas fa-search-plus"></i></a>
            </td>
            <td><?= $data['date'] ?></td>
        </tr>
<?php
    }
} catch (PDOException $e) {
    echo feedback('error', "Error: " . $e->getMessage());
}
?>