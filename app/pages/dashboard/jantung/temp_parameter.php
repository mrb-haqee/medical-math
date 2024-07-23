<form action="">

    <datalist id="datalistcor">
        <option value="S1 S2 Single reguler">
        <option value="murmur (-)">
    </datalist>

    <datalist id="datalistpulmo">
        <?php
        $options = [
            "ves" => ["(+/+)", "(++/++)", "(+++/+++)"],
            "ronkhi" => ["(-/-)", "(--/--)", "(---/---)"],
            "wheezing" => ["(-/-)", "(--/--)", "(---/---)"]
        ];
        foreach ($options as $key => $values) {
            foreach ($values as $value) {
                echo "<option value=\"$key $value\"></option>";
            }
        }
        ?>
    </datalist>

    <datalist id="datalistabdomen">
        <option value="BU (+) Normal">
        <option value="Distensi (-)">
    </datalist>
    <datalist id="datalistext">
        <?php
        $options = [
            "hangat" => ["(+/+)", "(++/++)", "(+++/+++)"],
            "edema" => ["(-/-)", "(--/--)", "(---/---)"],
        ];
        foreach ($options as $key => $values) {
            foreach ($values as $value) {
                echo "<option value=\"$key $value\"></option>";
            }
        }
        ?>
    </datalist>

    <datalist id="datalisttambahan">
        <option value="DOE (+)">
        <option value="PND (-)">
        <option value="orthopnea (-)">
    </datalist>

    <div class="form-floating mb-3">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Keluhan</label>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="form-floating me-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Tekanan Darah</label>
            <div id="TD" class="form-text">
                &nbsp;&nbsp;ex: 120/90
            </div>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input type="number" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Detak Jantung</label>
            <div id="HR" class="form-text">
                &nbsp;&nbsp;HR dalam angka
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="form-floating me-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Kalium</label>
            <div id="TD" class="form-text">
                &nbsp;&nbsp;put "-" when none
            </div>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Natrium</label>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Kreatinin</label>
        </div>
    </div>


    <?php foreach (['cor', 'pulmo', 'abdomen', 'ext', 'tambahan'] as $val) : ?>

        <h5><?= ucwords($val); ?> : </h5>
        <div class="row">
            <div class="col-12 mb-3">
                <div id="add_<?= $val; ?>" class="row g-2">


                    <div class="col-md-4">
                        <div class="input-group flex-nowrap">
                            <button onclick="add_keluhan('<?= $val; ?>')" class="btn btn-outline-secondary" type="button"><i class="far fa-plus-square"></i></button>
                            <div class="form-floating">
                                <input class="form-control" list="datalist<?= $val; ?>" id="<?= $val; ?>1" placeholder="Type to search...">
                                <label for="<?= $val; ?>1"><?= $val; ?> 1</label>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    <?php endforeach; ?>


    <div class="text-center">
        <div class="btn-group w-50" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-secondary">Kembali</button>
            <button type="button" class="btn btn-outline-warning">Summary</button>
        </div>
    </div>
</form>