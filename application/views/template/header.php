<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Api &rsaquo; Dimas Satria </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= asset("assets/modules/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= asset("assets/modules/fontawesome/css/all.min.css") ?>">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= asset("assets/css/style.css") ?>">
    <link rel="stylesheet" href="<?= asset("assets/css/components.css") ?>">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <!-- <a href="index.html" class="navbar-brand sidebar-gone-hide"><img alt="image" style="width: 52%;" src="<?= asset("assets/img/avatar/logoapidimas-1.png") ?>"></a> -->
                <a href="index.html" class="navbar-brand sidebar-gone-hide"> API DIMAS SATRIA</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>

                <form class="form-inline ml-auto">

                </form>
                <span class="navbar-text">
                    <a href="<?= @base_url('developer/login') ?>" class="btn btn-icon icon-left btn-danger"><i class="fas fa-sign-in-alt"></i> Masuk/Daftar</a>
                </span>
                <!-- <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= asset("assets/img/avatar/avatar-1.png") ?>" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul> -->
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
                        </li>

                        <li class="nav-item  ">
                            <a href="#" class="nav-link"><i class="far fa-clone"></i><span>Dokumentasi</span></a>
                        </li>
                        <li class="nav-item  ">
                            <a href="#" class="nav-link"><i class="far fa-user"></i><span>Ketentuan Pengguna</span></a>
                        </li>
                    </ul>
                </div>
            </nav>