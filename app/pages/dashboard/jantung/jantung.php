<?php
include "./pages/dashboard/routes_dashboard.php";
include $root_dashboard_template . '/sidebar.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Predict Heart</title>
    <?php include $root_dashboard_template . '/head_config.php' ?>
</head>

<body class="sb-nav-fixed">
    <?php include $root_dashboard_template . '/nav.php' ?>

    <div id="layoutSidenav">

        <!-- Slide Nav -->
        <?= sidebar($routes, jantung: true) ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Heart Disease Prediction</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Heart disease prediction</li>
                    </ol>

                    <!-- Modal -->
                    <div class="modal fade" id="j-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content" id="j-modal-content">

                            </div>
                        </div>
                    </div>



                    <!-- Biodata -->
                    <div id="card-biodata" class="card mb-4" style="display: none;">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Biodata
                        </div>
                        <div class="card-body">
                            <?php include "temp_biodata.php"; ?>
                        </div>
                    </div>

                    <!-- Variable Parameter -->
                    <div id="card-parameter" class="card mb-4" style="display: none;">
                        <div class=" card-header">
                            <i class="fas fa-table me-1"></i>
                            Variable Parameter
                        </div>
                        <div class="card-body">
                            <?php include "temp_parameter.php"; ?>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div id="ccard-summary" class="card mb-4" style="display: none;">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Summary
                        </div>
                        <div class="card-body">
                            <div id="nodata-summary" class="fs-6 no-img text-center">
                                No Data
                            </div>
                            <div id="card-summary" style="display: none;">

                            </div>
                        </div>
                    </div>

                    <!-- Slide Predict Result -->
                    <div class="card mb-4" id="j-card-predict" style="display: none;">
                        <div class="card-header">
                            <i class="fa-solid fa-magnifying-glass-chart me-1"></i>
                            Predict Result
                        </div>

                        <div class="card-body">
                            <div id="j-predict-result">

                            </div>
                            <div class="row text-center" id="j-no-predict-result">
                                <div class="fs-6">
                                    No predict found
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <button id="btn-add-data" class="btn btn-success" style="font-size: x-large;"><i class="fas fa-user-injured"></i></button>
                    </div>

                    <!-- Slide Table Predict -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Predict

                        </div>
                        <div class="card-body">
                            <div id="j-no-tabel" class="row text-center" style="display: none;">
                                <div class="fs-6">
                                    No table found
                                </div>
                            </div>

                            <div id="j-spin-load-tabel" class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                            </div>

                            <div id="j-tabel-predict" class="table-responsive" style="max-height:500px; display: none;">
                                <!-- <caption class="mb-1">
                                    <span class="fw-bold">Probability : </span>
                                    <span class="badge text-bg-danger">>0.7</span>
                                    <span class="badge text-bg-warning">0.7~0.3</span>
                                    <span class="badge text-bg-secondary">&lt;0.3</span>
                                </caption> -->
                                <table class="table caption-top table-striped table-hover table-bordered align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">User</th>
                                            <th style="width: 10%">Pasien</th>
                                            <th style="width: 20%">Diagnosa Utama</th>
                                            <th style="width: 20%">Diagnosa Sekunder</th>
                                            <th style="width: 30%">Obat</th>
                                            <th style="width: 10%">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="j-tbody-predict" class="table-group-divider">
                                        <tr data-id="1">
                                            <td scope="row">mrb@enail</td>
                                            <td>adw<br><a href="#1" class="btn-j-detail">details</a></td>
                                            <td>awd</td>
                                            <td>awd</td>
                                            <td>awd</td>
                                            <td>awd</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include $root_dashboard_template . '/foot_config.php'; ?>
    <script src="<?= $root_dashboard_src_js ?>/jantung.js"></script>
    <script>
        $(document).ready(function() {
            <?php if ($_SESSION['sapa'] == "sapaoi") : ?>
                notif.success('Hi, <?= $_SESSION['email'] ?>')
            <?php
                $_SESSION['sapa'] = "sudah";
            endif; ?>
        })
    </script>
</body>

</html>