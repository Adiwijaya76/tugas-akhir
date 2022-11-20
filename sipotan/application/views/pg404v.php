<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Sistem Informasi Desa Terintegrasi">
        <meta name="author" content="Desa Sumbermulyo Kec. Jogoroto Kab. Jombang">
        <title>Dashboard | Sidesit</title>
        <link rel="apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon.png'); ?>">
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('global/css/bootstrap-extend.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/site.min.css'); ?>">
        <script>Breakpoints();</script>
    </head>
    <body class="animsition page-error page-error-404 layout-full">
        <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out" >
            <div class="page-content vertical-align-middle">
                <header>
                    <h1 class="animation-slide-top" style="font-size: 150px">404</h1>
                    <p style="font-size: 30px">Halaman Tidak Di Temukan !</p>
                </header>
                <a class="btn btn-primary btn-lg" href="<?= base_url(); ?>">Home</a>
            </div>
        </div>
        <script>
            (function(document, window, $){
                'use strict';
                var Site = window.Site;
                $(document).ready(function(){
                    Site.run();
                });
            })(document, window, jQuery);
        </script>
    </body>
</html>
