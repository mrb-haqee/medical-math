<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_pdo, getDataByDiagnosis};

// get_session();
$pdo = get_pdo();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'detail') {

?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pasien</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php


            $stmt = $pdo->prepare("SELECT * FROM data_predict_jantung WHERE id = :id");
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $biodata = json_decode($results['biodata'], true);
            $input = json_decode($results['input'], true);
            ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Data</th>
                            <th style="width: 70%;">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        foreach ($biodata as $keys => $data) :
                        ?>
                            <tr>
                                <td><?= $keys; ?></td>
                                <td><?= $data; ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>

                        <tr>
                            <td>Berat badan</td>
                            <td><?= $input['bb']; ?></td>
                        </tr>
                        <tr>
                            <td>Tinggi badan</td>
                            <td><?= $input['tb']; ?></td>
                        </tr>
                        <tr>
                            <td>LVEF</td>
                            <td><?= $input['lvef']; ?>%</td>
                        </tr>
                        <tr>
                            <td>TD</td>
                            <td><?= $input['td']; ?></td>
                        </tr>
                        <tr>
                            <td>HR</td>
                            <td><?= $input['hr']; ?></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td><?= $input['keluhan']; ?></td>
                        </tr>
                        <tr>
                            <td>Cor</td>
                            <td><?= implode("<br> ",  $input['cor']) ?></td>
                        </tr>
                        <tr>
                            <td>Abdomen</td>
                            <td><?= implode("<br> ",  $input['abdomen']) ?></td>
                        </tr>
                        <tr>
                            <td>Pulmo</td>
                            <td><?= implode("<br> ",  $input['pulmo']) ?></td>
                        </tr>
                        <tr>
                            <td>Ext</td>
                            <td><?= implode("<br> ",  $input['ext']) ?></td>
                        </tr>
                        <tr>
                            <td>Lain-lain</td>
                            <td><?= implode("<br> ",  $input['tambahan']) ?></td>
                        </tr>
                        <tr>
                            <td>Kalium</td>
                            <td><?= $input['kalium']; ?></td>
                        </tr>
                        <tr>
                            <td>Natrium</td>
                            <td><?= $input['natrium']; ?></td>
                        </tr>
                        <tr>
                            <td>Kreatinin</td>
                            <td><?= $input['kreatinin']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

    <?php } else if ($_POST['action'] == 'icd10') {

    ?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Data ICD10</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php


            $stmt = $pdo->prepare("SELECT * FROM data_predict_jantung WHERE id = :id");
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $labels = json_decode($results['labels'], true);
            $DS = getDataByDiagnosis($labels['DS'], $pdo);
            ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Kode</th>
                            <th style="width: 70%;">Data</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($DS as $item) :
                            $arr = explode(" - ", $item)
                        ?>
                            <tr>
                                <td><?= $arr[0]; ?></td>
                                <td><?= $arr[1]; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

<?php }
} ?>