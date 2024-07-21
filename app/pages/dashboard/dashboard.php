<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root . '/helper/helper.php');

use function Helper\{get_session};

get_session();

$root = "/public/dashboard/";
$js_path = "/pages/dashboard/js/";
$css_path = "/pages/dashboard/css/";

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
        <a class="navbar-brand ps-3" href="/dashboard">LUNGSLAB</a>
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
                        <a class="nav-link" href="dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?= $_SESSION['email'] ?></div>
                    LUNGSLAB
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
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
    <script src="<?= $js_path ?>index.js"></script>
</body>

</html>