<?php
function sidebar($routes, $dashboard = false, $paru = false, $jantung = false, $bmi = false)
{
?>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?= $dashboard ? "active" : ""; ?>" href="<?= $routes['dashboard']; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">artificial intelligence</div>
                    <a class="nav-link <?= $dashboard ? "collapsed" : "active"; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="<?= $dashboard ? "false" : "true"; ?>" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-brain"></i></div>
                        Machine Learning
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= !$dashboard ? "show" : ""; ?>" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= $paru ? "active" : ""; ?>" href="<?= $routes['paru']; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-lungs"></i></div>
                                Predict Lungs
                            </a>
                            <a class="nav-link <?= $jantung ? "active" : ""; ?>" href="<?= $routes['jantung']; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-heartbeat"></i></div>
                                Predict Heart
                            </a>
                            <a class="nav-link <?= $bmi ? "active" : ""; ?>" href="<?= $routes['none']; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-weight"></i></div>
                                Predict BMI
                            </a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">About</div>
                    <a class="nav-link" href="#">
                        <div class="sb-nav-link-icon"><i class="fas fa-project-diagram"></i></div>
                        Project Documentation
                    </a>
                    <a class="nav-link" href="/logout">
                        <div id="logout" class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                        Logout
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: <?= $_SESSION['email'] ?></div>
                MEDICAL MATH
            </div>
        </nav>
    </div>
<?php } ?>