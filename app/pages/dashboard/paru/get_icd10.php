<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{merge, get_data_ICD, get_pdo};

$pdo = get_pdo();


if (isset($_POST['label'])) {
    $label = $_POST['label'];
    $resp = get_data_ICD($pdo, $label);

    if ($resp !== "") {
        if ($_POST['action'] == "modal") {

?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data ICD10 Diagnosis <?= $label ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Kode</th>
                            <th>Diagnosis <?= $label ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resp as $item) : ?>
                            <tr>
                                <td><?= $item['kode'] ?></td>
                                <td><?= $item['diagnosis'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        <?php
        } else {
        ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Kode</th>
                        <th>Diagnosis <?= $label ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resp as $item) : ?>
                        <tr>
                            <td><?= $item['kode'] ?></td>
                            <td><?= $item['diagnosis'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
<?php
        }
    }
} ?>