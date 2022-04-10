<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daiktų antrinio panaudojimo skatinimo informacinė sistema</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/creative.css')}}" rel="stylesheet">



</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Daiktų antrinio panaudojimo IS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Apie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Kontaktai</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link js-scroll-trigger">Profilis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Atsijungti') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link js-scroll-trigger">Login</a>
                        </li>

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link js-scroll-trigger">Register</a>
                            </li>
                            @endif
                        @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>


<header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-uppercase">
                    <strong>Daiktų antrinio panaudojimo skatininimo informacinė sistema</strong>
                </h2>
                <hr>
            </div>
            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('itemannounc')}}">Daiktų skelbimai</a>
            </div>
            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('serviceannounc')}}">Paslaugų skelbimai</a>
            </div>
            @auth
            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('personalAnn')}}">Mano skelbimai</a>
            </div>
            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('rememberAnn')}}">Įsiminti skelbimai</a>
            </div>
            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('boughtitemshow')}}">Nupirkti daiktai</a>
            </div>

            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('portfolioshow', Auth::User()->id)}}">Perdirbtų daiktų porfolio</a>
            </div>

            <div style="margin-top: 1em" class="col-lg-8 mx-auto">
                <x-a class="btn btn-primary btn-xl2 js-scroll-trigger" :href="route('openmessagelist')"
                   :active="request()->routeIs('messages') || request()->routeIs('messages.*')">Žinutės @include('unread-count')</x-a>
            </div>
            @endauth
        </div>
    </div>
</header>


<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-heading text-white">Daiktų perdirbimo bendruomenė</h2>
                <hr class="light my-4">
                <p class="text-faded mb-4"> Susirask sau patinkantį daiktą ir patinkančias paslaugas ir prikelk daiktą antram gyvenimui</p>
                <a class="btn btn-light btn-xl js-scroll-trigger" href="#portfolio">Get Started!</a>
            </div>
        </div>
    </div>
</section>

<section class="p-0" id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/2.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/2.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/3.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/3.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/4.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/4.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/5.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/5.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/6.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/6.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-heading">Informacija susisiekimui</h2>
                <hr class="my-4">
                <p class="mb-5">Dėl iškilusių klausimų kreipkitės į šiuos kontaktus</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center">
                <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
                <p>123-456-6789</p>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
                <p>
                    <a href="mailto:your-email@your-domain.com">vaidas.lileikis@ktu.edu</a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap core JavaScript -->
<script src="/jquery/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="/jquery-easing/jquery.easing.min.js"></script>
<script src="/scrollreveal/scrollreveal.min.js"></script>
<script src="/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="/js/creative.min.js"></script>

</body>

</html>
