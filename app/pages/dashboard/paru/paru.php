<?php
include "./pages/dashboard/routes_dashboard.php";
include $root_dashboard_template . '/sidebar.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Predict Lungs</title>
    <?php include $root_dashboard_template . '/head_config.php' ?>
</head>

<body class="sb-nav-fixed">
    <?php include $root_dashboard_template . '/nav.php' ?>
    <div id="layoutSidenav">
        <!-- Slide Nav -->
        <?= sidebar($routes, paru: true) ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Lungs Disease Prediction</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lungs disease prediction</li>
                    </ol>

                    <!-- Modal -->
                    <div class="modal fade" id="p-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content" id="p-modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>...</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Upload -->
                    <?php include 'temp_upload.php' ?>

                    <!-- Slide Predict Result -->
                    <?php include 'temp_predict.php' ?>
                    <!-- <button class="btn btn-success me-4 save-predict">Save</button> -->

                    <!-- Slide Table Predict -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Predict
                        </div>
                        <div class="card-body">
                            <div id="no-tabel" class="row text-center" style="display: none;">
                                <div class="fs-6">
                                    No table found
                                </div>
                            </div>

                            <div id="spin-laod-tabel" class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                            </div>

                            <div id="tabel-predict" class="table-responsive" style="max-height:500px; display: none;">
                                <caption class="mb-1">
                                    <span class="fw-bold">Probability : </span>
                                    <span class="badge text-bg-danger">>0.7</span>
                                    <span class="badge text-bg-warning">0.7~0.3</span>
                                    <span class="badge text-bg-secondary">&lt;0.3</span>
                                </caption>
                                <table class="table caption-top table-striped table-hover table-bordered align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">User</th>
                                            <th style="width: 10%">Image</th>
                                            <th style="width: 30%">Predict</th>
                                            <th style="width: 30%">Kode ICD10</th>
                                            <th style="width: 20%">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-predict" class="table-group-divider">

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
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
    <script src="<?= $root_dashboard_src_js ?>/paru.js"></script>
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