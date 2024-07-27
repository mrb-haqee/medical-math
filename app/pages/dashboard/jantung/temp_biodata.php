<form id="form-biodata" class="needs-validation" action="">
    <div class="d-flex justify-content-between mb-3">
        <div class="form-floating me-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingInput" name="nama" required>
            <label for="floatingInput">Nama</label>
        </div>
        <div class="form-floating ms-2 flex-grow-1">
            <input type="text" class="form-control" id="floatingPassword" name="domisili">
            <label for="floatingPassword">Domisili</label>
        </div>
    </div>
    <div class="row g-2 mb-3">
        <div class="col-md">
            <div class="form-floating">
                <select class="form-select" id="floatingSelectGrid" name="gender">
                    <option value="L">Male</option>
                    <option value="P">Female</option>
                </select>
                <label for="floatingSelectGrid">Gender</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGrid" name="usia">
                <label for="floatingInputGrid">Usia</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGrid" name="bb">
                <label for="floatingInputGrid">Berat badan (kg)</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <input type="number" class="form-control" id="floatingInputGrid" name="tb">
                <label for="floatingInputGrid">Tinggi badan (cm)</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGrid" name="lvef">
                <label for="floatingInputGrid">Nilai LVEF (%)</label>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" id="btn-j-next" class="btn btn-secondary w-50">
            Lanjutkan
        </button>
    </div>
</form>