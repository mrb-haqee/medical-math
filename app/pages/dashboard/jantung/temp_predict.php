<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_pdo, getDataByDiagnosis};

// get_session();
$pdo = get_pdo();



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data_du = getDataByDiagnosis($_POST['DU'], $pdo);
    $data_ds = getDataByDiagnosis($_POST['DS'], $pdo);

?>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    <th>Predict Name</th>
                    <th>Predict Label</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Diagnosa Utama</td>
                    <td><?= implode("<br> ",  $data_du) ?></td>
                </tr>
                <tr>
                    <td>Diagnosa Sekunder</td>
                    <td><?= implode("<br> ", $data_ds) ?></td>
                </tr>
                <tr>
                    <td>Obat</td>
                    <td><?= implode("<br> ", $_POST['OB']) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <div class="btn-group w-50" role="group" aria-label="Basic example">
            <button type="button" id="btn-j-save-predict" class="btn btn-success">Save</button>
            <button type="button" id="btn-j-delete" class="btn btn-danger">Delete all</button>
        </div>
    </div>


<?php } ?>