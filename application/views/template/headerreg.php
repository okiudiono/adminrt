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
                <form class="form-inline ml-auto">

                </form>
                <span class="navbar-text">
                    <a href="<?= @base_url('developer/login') ?>" class="btn btn-icon icon-left btn-danger"><i class="fas fa-sign-in-alt"></i> Masuk/Daftar</a>
                </span>
            </nav>