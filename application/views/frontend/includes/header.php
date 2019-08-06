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
        <!-- Sweet Alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <style>

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url('https://image.freepik.com/darmowe-wektory/wzor-o-zakupach_1061-495.jpg') fixed;
            font-family: 'Exo', sans-serif;
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
            border-radius: 5px;
        }

        #carouselProduct .carousel-item a img:hover {
            border: 2px solid #68c93e;
        }

        </style>
        
        
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <div class="card border-default" id="card-wrapper">
            