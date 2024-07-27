<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
?>

    <form class="row g-3">
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['nama'] ?>" class="form-control">
                <label for="floatingInput">Nama</label>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['domisili'] ?>" class="form-control">
                <label for="floatingInput">Domisili</label>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['gender'] ?>" class="form-control">
                <label for="floatingInput">Gender</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['usia'] ?>" class="form-control">
                <label for="floatingInput">Usia</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['bb'] ?>" class="form-control">
                <label for="floatingInput">Berat badan</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['tb'] ?>" class="form-control">
                <label for="floatingInput">Tinggi badan</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['lvef'] ?>" class="form-control">
                <label for="floatingInput">Nilai LVEF</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['td'] ?>" class="form-control">
                <label for="floatingInput">TD</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['hr'] ?>" class="form-control">
                <label for="floatingInput">HR</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['kalium'] ?>" class="form-control">
                <label for="floatingInput">Kalium</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['natrium'] ?>" class="form-control">
                <label for="floatingInput">Natrium</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="text" readonly disabled value="<?= $_POST['kreatinin'] ?>" class="form-control">
                <label for="floatingInput">Kreatinin</label>
            </div>
        </div>
        <div class="col-md-4">
            <label for="floatingTextarea2">Keluhan</label>
            <textarea class="form-control" readonly disabled style="height: 100px">
<?= $_POST['keluhan'] ?>
        </textarea>

        </div>
        <div class="col-md-4">
            <label for="floatingTextarea2">Cor</label>
            <textarea class="form-control" readonly disabled style="height: 100px">
<?php
    $length = count($_POST['cor']);
    foreach ($_POST['cor'] as $key => $cor) {
        if ($key == $length - 1) {
            echo $cor;
        } else {
            echo $cor . ", ";
        }
    }
?>
        </textarea>
        </div>
        <div class="col-md-4">
            <label for="floatingTextarea2">Pulmo</label>
            <textarea class="form-control" readonly disabled style="height: 100px">
<?php
    $length = count($_POST['pulmo']);
    foreach ($_POST['pulmo'] as $key => $pulmo) {
        if ($key == $length - 1) {
            echo $pulmo;
        } else {
            echo $pulmo . ", ";
        }
    }
?>
        </textarea>
        </div>
        <div class="col-md-4">
            <label for="floatingTextarea2">Abdomen</label>
            <textarea class="form-control" readonly disabled style="height: 100px">
<?php
    $length = count($_POST['abdomen']);
    foreach ($_POST['abdomen'] as $key => $abdomen) {
        if ($key == $length - 1) {
            echo $abdomen;
        } else {
            echo $abdomen . ", ";
        }
    }
?>
        </textarea>
        </div>

        <div class="col-md-4">
            <label for="floatingTextarea2">Ext</label>

            <textarea class="form-control" readonly disabled style="height: 100px">
<?php
    $length = count($_POST['ext']);
    foreach ($_POST['ext'] as $key => $ext) {
        if ($key == $length - 1) {
            echo $ext;
        } else {
            echo $ext . ", ";
        }
    }
?>
        </textarea>
        </div>
        <div class="col-md-4">
            <label for="floatingTextarea2">Tambahan</label>
            <textarea class="form-control" readonly disabled style="height: 100px">
<?php
    $length = count($_POST['tambahan']);
    foreach ($_POST['tambahan'] as $key => $tambahan) {
        if ($key == $length - 1) {
            echo $tambahan;
        } else {
            echo $tambahan . ", ";
        }
    }
?>
        </textarea>
        </div>

        <div class="text-center">
            <div class="btn-group w-50" role="group" aria-label="Basic example">
                <button type="button" id="btn-j-back-parameter" class="btn btn-secondary">Kembali</button>
                <button type="button" id="btn-j-predict" class="btn btn-success">Predict</button>
                <button type="button" id="btn-j-delete" class="btn btn-danger">Delete all</button>
            </div>
        </div>

    </form>

<?php } ?>