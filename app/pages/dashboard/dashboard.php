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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chela+One&display=swap');

        .chela-one-regular {
            font-family: "Chela One", system-ui;
            font-weight: 400;
            font-style: normal;
            font-size: 30px;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-mrb">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 chela-one-regular" href="/dashboard">MEDICAL MATH</a>
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
                        <a class="nav-link active" href="<?= $routes['dashboard']; ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">artificial intelligence</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-brain"></i></div>
                            Machine Learning
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= $routes['paru']; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-lungs"></i></div>
                                    Predict Lungs
                                </a>
                                <a class="nav-link" href="<?= $routes['jantung']; ?>">
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card border-dark mb-3" style="max-width: 18rem;">
                                <img src="<?= $css_path . "/img.png" ?>" class="card-img-top" alt="...">
                                <div class="card-body text-success text-dark mb-4">
                                    <h5 class="card-title">Lungs disease prediction</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora sit culpa maxime,</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-dark stretched-link" href="<?= $routes['paru']; ?>">View Details</a>
                                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-dark mb-3" style="max-width: 18rem;">
                                <img src="<?= $css_path . "/img.png" ?>" class="card-img-top" alt="...">
                                <div class="card-body text-success text-dark mb-4">
                                    <h5 class="card-title">Hearth disease prediction</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora sit culpa maxime,</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-dark stretched-link" href="<?= $routes['jantung']; ?>">View Details</a>
                                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-dark mb-3" style="max-width: 18rem;">
                                <img src="<?= $css_path . "/img.png" ?>" class="card-img-top" alt="...">
                                <div class="card-body text-success text-dark mb-4">
                                    <h5 class="card-title">Body mass index prediction</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora sit culpa maxime,</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-dark stretched-link" href="<?= $routes['none']; ?>">View Details</a>
                                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                                </div>
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