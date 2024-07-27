<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root . '/helper/helper.php');

use function Helper\{get_session};

get_session();

include $root . "/pages/dashboard/routes_dashboard.php";



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="<?= $root ?>css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-mrb">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/dashboard">MEDICAL MATH</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <!-- Slide Nav -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="<?= $routes['dashboard']; ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">artificial intelligence</div>
                        <a class="nav-link active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-brain"></i></div>
                            Machine Learning
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link " href="<?= $routes['paru']; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-lungs"></i></div>
                                    Predict Lungs
                                </a>
                                <a class="nav-link active" href="<?= $routes['jantung']; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-heartbeat"></i></div>
                                    Predict Heart
                                </a>
                                <a class="nav-link" href="<?= $routes['none']; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-weight"></i></div>
                                    Predict BMI
                                </a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">About</div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Project Documentation
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?= $_SESSION['email'] ?></div>
                    MEDICAL MATH
                </div>
            </nav>
        </div>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
    <script src="<?= $root ?>js/scripts.js"></script>
    <script src="<?= $root ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= $root ?>assets/demo/chart-bar-demo.js"></script>
    <script src="<?= $root ?>js/datatables-simple-demo.js"></script>
    <script src="<?= $js_path ?>config.js"></script>
    <script src="<?= $js_path ?>jantung.js"></script>
</body>

</html>