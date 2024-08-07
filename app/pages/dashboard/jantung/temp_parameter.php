<form id="form-parameter" action="">

    <datalist id="datalistcor">
        <option value="S1 S2 Single reguler">
        <option value="S1 S2 Single irregular">
        <option value="murmur (-)">
        <option value="murmur (+)">
    </datalist>

    <datalist id="datalistpulmo">
        <?php
        $options = [
            "ronkhi" => [
                '(+++/+++)', '(++-/++-)', '(++/++)',
                '(+--/+--)', '(+/+)', '(-++/-++)',
                '(-++/--+)', '(-+-/-+-)', '(--++/--++)',
                '(--+/-++)', '(--+/--+)', '(--+/---)',
                '(---/--+)', '(---/---)', '(--/--)',
                '(-/-)', '(-/---)', '(-+/--+)'
            ],
            "ves" => [
                '(+++/+++)',
                '(+++/---)', '(++-/+++)', '(++-/++-)', '(++/++)',
                '(+--/+++)', '(+/+)', '(---/+++)', '(-/-)'
            ],
            "wheezing" => [
                '(+++/+++)', '(+-/+-)', '(+/+)',
                '(-++/-++)', '(-+/-+)', '(----/---)',
                '(---/--)', '(---/---)', '(--/--)',
                '(--/---)', '(-/-)', '(--/---)'
            ]
        ];
        foreach ($options as $key => $values) {
            foreach ($values as $value) {
                echo "<option value=\"$key $value\"></option>";
            }
        }
        ?>
    </datalist>

    <datalist id="datalistabdomen">
        <?php
        $abdomen = [
            'bu (+)', 'bu (+) menurun', 'bu (+) normal', 'distensi (+)',
            'distensi (-)', 'nyeri tekan (-)', 'supel (+)'
        ];
        foreach ($abdomen as $value) {
            echo "<option value=\"$value\"></option>";
        }
        ?>
    </datalist>

    <datalist id="datalistext">
        <?php
        $ext = [
            "dingin" => ['(++/++)'],
            "hangat" => [
                '(++/++)', '(+/+)', '(--/--)',
                '(-/-)'
            ],
            "edema" => [
                '(++/++)', '(++/-+)',
                '(+/+)', '(-+/-+)', '(-+/--)', '(--+/--+)',
                '(--/++)', '(--/--)', '(--/---)', '(-/+)',
                '(-/-)'
            ],
        ];
        foreach ($ext as $key => $values) {
            foreach ($values as $value) {
                echo "<option value=\"$key $value\"></option>";
            }
        }
        ?>
    </datalist>

    <datalist id="datalisttambahan">
        <?php
        $tambahan = [
            'doe (+)', 'doe (-)', 'edema (+)', 'edema (-)',
            'kaki bengkak (+)', 'kaki bengkak (-)', 'orthopnea (+)',
            'orthopnea (-)', 'orthopneu (+)', 'orthopneu (-)', 'orthopnoe (+)',
            'ortopneu (+)', 'ortopneu (-)', 'pnd (+)', 'pnd (-)',
            'skrotum bengkak (+)'
        ];
        foreach ($tambahan as $value) {
            echo "<option value=\"$value\"></option>";
        }
        ?>
    </datalist>

    <div class="form-floating mb-3">
        <textarea name="keluhan" class="form-control" placeholder="Leave a comment here" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Keluhan</label>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="form-floating me-2 flex-grow-1">
            <input name="td" type="text" class="form-control">
            <label for="floatingInput">Tekanan Darah</label>
            <div id="TD" class="form-text">
                &nbsp;&nbsp;ex: 120/90
            </div>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input name="hr" type="number" class="form-control">
            <label for="floatingPassword">Detak Jantung</label>
            <div id="HR" class="form-text">
                &nbsp;&nbsp;HR dalam angka
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <div class="form-floating me-2 flex-grow-1">
            <input name="kalium" type="text" class="form-control">
            <label for="floatingInput">Kalium</label>
            <div id="TD" class="form-text">
                &nbsp;&nbsp;put "-" when none
            </div>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input name="natrium" type="text" class="form-control">
            <label for="floatingPassword">Natrium</label>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input name="kreatinin" type="text" class="form-control">
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
                                <input name="<?= $val . '1' ?>" class="form-control" list="datalist<?= $val; ?>" id="<?= $val; ?>1" placeholder="Type to search...">
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
            <button id="btn-j-back-biodata" type="button" class="btn btn-secondary">Kembali</button>
            <button id="btn-j-summary" type="button" class="btn btn-warning">Summary</button>
        </div>
    </div>
</form>