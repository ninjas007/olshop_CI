<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <!-- Font comforta -->
        <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,500,600,700&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <style>

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url('https://image.freepik.com/darmowe-wektory/wzor-o-zakupach_1061-495.jpg') fixed;
        /*font-family: 'Comfortaa', cursive;*/
        }

        #ThumbnailCarousel img {
        }

        #ThumbnailCarousel.carousel {
            text-align:center;
        }

        .col-md-3 .img-thumbnail {
            height:100%;
        }

        #card-wrapper {
            width: 40%;
            margin: auto;
        }

        @media only screen and (max-width: 600px) {
            #card-wrapper {
                width: 100%
            }
        }

        #list-navbar-bottom li.nav-item a.nav-link.active{
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            /*box-shadow: 1px 1px 1px grey;*/
            /*border-radius: 5px;*/
            background: #68c93e;
            color: white;
        }
        
        #card-wrapper nav.sticky-top.bg-light {
            background: #68c93e !important;
        }

        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: #68c93e;
            text-decoration: none;
        }

        #carouselProduct .carousel-control-next, #carouselProduct .carousel-control-prev {
            width: 5%;
            margin-top: -40px;
        }
        
        #carouselProduct .carousel-item a img {
            box-shadow: 1px 2px 4px 0 rgba(0,0,0,.5)
        }
        
        #carouselProduct .carousel-item img {
            padding: 2px;
            /*border: 1px solid grey;*/
            border-radius: 5px;
        }

        #carouselProduct .carousel-item a img:hover {
            border: 2px solid #68c93e;
        }

        </style>
        
        
        <title>Home</title>
    </head>
    <body>
        <div class="card border-default" id="card-wrapper">
            <h3 class="text-center"><a href="<?php echo base_url() ?>">BISNIS IMPORT</a></h3>
            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light justify-content-between">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Home</a>
                                <a class="dropdown-item" href="#">Pesanan</a>
                                <a class="dropdown-item" href="#">Help</a>
                                <a class="dropdown-item" href="#">Semua Produk</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('login') ?>">Akun</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="" class="nav-link">Cart</a></li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="<?php echo base_url('produk') ?>" method="post">
                        <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Cari produk">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
                    </form>
                </div>
            </nav>