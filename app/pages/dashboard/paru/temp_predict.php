<div class="card mb-4" id="no-predict">
    <div class="card-header">
        <i class="fa-solid fa-magnifying-glass-chart me-1"></i>
        Predict Result
    </div>

    <div class="card-body">
        <div class="row text-center">
            <div class="fs-6">
                No predict found
            </div>
        </div>
    </div>
</div>

<div class="card mb-4" id="predict" style="display: none;">
    <div class="card-header">
        <i class="fa-solid fa-magnifying-glass-chart me-1"></i>
        Predict Result
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-magnifying-glass-chart me-1"></i>
                        Chart
                    </div>
                    <div class="card-body text-center">
                        <canvas id="myChart" width="40vw" height="40vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-magnifying-glass-chart me-1"></i>
                        ICD 10
                    </div>
                    <div class="card-body">
                        <div id="predict-icd10" class="table-responsive" style="max-height: 400px; overflow-y: auto;">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button class="btn btn-success me-4 save-predict">Save</button>
            <button class="btn btn-danger del-predict">Delete</button>
        </div>
    </div>
</div>