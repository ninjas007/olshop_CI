<style>
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