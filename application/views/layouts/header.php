<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?php echo base_url(); ?>">

    <link rel="shortcut icon" href="<?= base_url('assets/images/home/favicon.jpg') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/images/home/favicon.jpg') ?>" type="image/x-icon">

    <title>Study Peers</title>
    

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/nice-select.css') ?>" rel="stylesheet">

    <!-- Main css -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/study-set.css" rel="stylesheet">


    <style type="text/css">
        body {
            background-image: url('https://studypeers.dev/assets/images/home/topdesign.png'), url('https://studypeers.dev/assets/images/home/bottomdesign.png');
            background-repeat: no-repeat, no-repeat;
            /*background-attachment: 10% 90%,25% 75%;*/
            background-position: center top, bottom;
            background-size: 100% 15%, 120% 50%;

        }

        .header-area {
            background-image: linear-gradient(to right, #ffffff, #fff, #ffffff);
        }

        /*@media (max-width: 991px)*/
        .navbar-collapse {

            background: #ffffff;
        }

        #password_details {
            display: none;
            left: calc(100% + 20px);
            border-radius: 5px;
            top: 50px;
            min-width: 250px;
            background-color: #fff;
            padding: 10px;
            font-size: 12px;
        }

        #password_details>h1 {
            margin: 0;
            padding: 5px;
            font-size: 14px;
            color: #555;
        }

        #password_details>ul>li {
            padding: 5px 0;
        }

        .invalid {
            color: #fc2e2e;
        }

        #password_details>ul>li {
            padding: 5px 0;
        }

        .valid {
            color: #12d600;
        }

        .header-area .main-menu ul li a {
            font-size: 17px;
            color: #333333;
            font-weight: 400;
            position: relative;
            transition: all 350ms ease;
            -webkit-transition: all 350ms ease;
            -moz-transition: all 350ms ease;
            -ms-transition: all 350ms ease;
            -o-transition: all 350ms ease;
        }

        .btn-emt {
            background-color: #ea2e7e
        }

        .btn-emt1 {

            border: 1px solid blue;
        }

        .header-area.sticky-header {
            background: #ffffff;
            padding: 10px 0;
        }

        .hero-section::before {
            background: #ffffff;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px white;
            border-radius: 1px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #ea2e7e;
            border-radius: 1px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #ea2e7e;
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-toggler {
            padding: .25rem .75rem;
            font-size: 1.25rem;
            line-height: 1;
            background-color: #ea2e7e;
            border: 1px solid #ea2e7e;
            border-radius: .25rem;
        }

        .ap-field-errors {
            border: solid 1px #ffe4e2;
            display: table;
            font-size: 12px;
            margin-bottom: 5px;
            padding: 1px 5px;
            border-radius: 2px;
            background: #fff0ef;
            color: #F44336;
        }
    </style>
</head>

<body>

    <!--Header Area-->
    <header class="header-area">
        <div class="container">
            <nav class="navbar navbar-expand-lg main-menu">
                <div class="container-fluid">

                    <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assets/images/home/logo.jpg') ?>" class="d-inline-block align-top" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu-toggle"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" href="<?= base_url('home/about') ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aboutus</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('home/privacy') ?>">Privacy Policy</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('home/term') ?>">Terms & Conditions</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="services.html">Directory</a></li>
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)" class="astro_btn" data-toggle="modal" data-target="#qna_modal">Work Flow</a></li> -->

                        </ul>

                        <div class="header-btn justify-content-end">
                            <a href="<?= base_url('login') ?>" class="bttn-small btn-emt1 ">SIGN IN</a>
                        </div>

                        <div class="header-btn justify-content-end">
                            <a href="<?= base_url('signup') ?>" class="bttn-small btn-emt"><i class="ti-crown"></i>CREATE AN ACCOUNT</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
    </header>
    <!--/Header Area-->