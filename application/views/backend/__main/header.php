<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Page - <?php echo $page ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <?php $this->load->view('backend/__header/'.strtolower($page).'') ?>
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/typography.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('vendor/strdash/')?>assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?php echo base_url('vendor/strdash/')?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Load header single page -->
</head>
<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <?php $this->load->view('backend/__main/sidebar', $page) ?>
        <!-- main content area start -->
        <div class="main-content">
        <?php $this->load->view('backend/__main/header_top') ?>           
        <?php $this->load->view('backend/__main/page_title_top', $page) ?>           
        <!-- main content area end -->
        