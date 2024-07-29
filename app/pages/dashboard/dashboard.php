<?php
include "./pages/dashboard/routes_dashboard.php";
include $root_dashboard_template . '/sidebar.php'


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include $root_dashboard_template . '/head_config.php' ?>
</head>

<body class="sb-nav-fixed">
    <?php include $root_dashboard_template . '/nav.php' ?>
    <div id="layoutSidenav">
        <!-- Slide Nav -->
        <?= sidebar($routes, dashboard: true) ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard <?= $_SESSION['email'] ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card border-dark mb-3" style="max-width: 18rem;">
                                <img src="<?= $root_dashboard_src_img . "/img.png" ?>" class="card-img-top" alt="...">
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
                                <img src="<?= $root_dashboard_src_img . "/img.png" ?>" class="card-img-top" alt="...">
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
                                <img src="<?= $root_dashboard_src_img . "/img.png" ?>" class="card-img-top" alt="...">
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

            <?php include $root_dashboard_template . '/footer.php'; ?>
        </div>
    </div>
    <?php include $root_dashboard_template . '/foot_config.php'; ?>

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