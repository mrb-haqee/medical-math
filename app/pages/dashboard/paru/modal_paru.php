<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/helper/helper.php');
require_once($root . '/helper/pdo.php');

use function Helper\{feedback, get_session, get_pdo, getDataByDiagnosis};

// get_session();
$pdo = get_pdo();



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'image') {

?>
        <div class="modal-body text-center">
            <?php
            $stmt = $pdo->prepare("SELECT * FROM data_image_paru WHERE id_predict = :id");
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            $image = json_decode($results['image'], true);
            ?>
            <img src="data:image/jpeg;base64,<?= $image; ?>" width='100%' />
        </div>

<?php }
} ?>