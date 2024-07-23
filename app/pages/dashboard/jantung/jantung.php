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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="<?= $root ?>css/styles.css" rel="stylesheet" />
    <!-- <link href="<?= $css_path ?>toast.css" rel="stylesheet" /> -->
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
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a id="logout" class="dropdown-item" href="/">Logout</a></li>
                </ul>
            </li>
        </ul>
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

                    <!-- Biodata -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Biodata
                        </div>
                        <div class="card-body">
                            <?php include "temp_biodata.php"; ?>
                        </div>
                    </div>

                    <!-- Variable Parameter -->
                    <div class="card mb-4" hidden>
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Variable Parameter
                        </div>
                        <div class="card-body">
                            <?php include "temp_parameter.php"; ?>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Summary
                        </div>
                        <div class="card-body">
                            <div class="fs-6 no-img text-center">
                                No Data
                            </div>
                            <div hidden>
                                <?php include "temp_summary.php"; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Upload -->
                    <div id="upload-sec" class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-file-arrow-up me-1"></i>
                                    Upload Image
                                </div>
                                <div class="card-body text-center">
                                    <button id="upload" class="btn btn-primary">Upload Image</button>
                                    <!-- Hidden file input -->
                                    <input type="file" id="fileInput" style="display: none;" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-regular fa-image me-1"></i>
                                    Image Result
                                </div>
                                <div class="card-body text-center">
                                    <div class="fs-6 no-img">
                                        No image found
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="image-sec" class="card mb-4" style="display: none;">
                        <div class="card-header">
                            <i class="fa-regular fa-image me-1"></i>
                            Image Result
                        </div>
                        <div class="card-body text-center">
                            <div id="image-display">
                                <img height="" src="" alt="" class="rounded img-fluid d-block d-xl-none">
                                <img height="300px" src="" alt="" class="rounded d-none d-xl-inline-block">
                                <div id="btn-img" class="mt-4 text-center">
                                    <button class="btn btn-primary me-4 predict-img">Predict</button>
                                    <button class="btn btn-danger del-img">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide Predict Result -->
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
                    <!-- <button class="btn btn-success me-4 save-predict">Save</button> -->

                    <!-- Slide Table Predict -->

                    <!-- <div class="card mb-4">
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
                    </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="<?= $root ?>js/scripts.js"></script>
    <script src="<?= $root ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?= $root ?>assets/demo/chart-bar-demo.js"></script>
    <script src="<?= $root ?>js/datatables-simple-demo.js"></script>
    <script src="<?= $js_path ?>config.js"></script>

    <script>
        $(document).ready(function() {
            toastr.success("Hi, <?= $_SESSION['email'] ?>");
        })
    </script>
    <script>
        // Inisialisasi variabel
        let counters = {
            cor: 1,
            pulmo: 1,
            abdomen: 1,
            ext: 1,
            tambahan: 1
        };

        function add_keluhan(name) {
            var targetId = '#add_' + name;
            counters[name] += 1;
            let data = counters[name];

            if (data <= 5) {
                $(targetId).append(`
                                    <div class="col-md-4">
                                            <div class="form-floating">
                                                <input class="form-control" list="datalist${name}" id="${name}${data}" placeholder="Type to search...">
                                                <label for="${name}${data}">${name} ${data}</label>
                                            </div>
                                    </div>
                                    `);
            }
        }
    </script>
    <script src="<?= $js_path ?>index.js"></script>
</body>

</html>