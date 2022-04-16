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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Daiktų antrinio IS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse dropdown" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" id="dropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mano skelbimai
                        </a>
                        <div style="" class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('personalAnn')}}">Mano skelbimai</a>
                            <a class="dropdown-item" href="{{route('rememberAnn')}}">Įsiminti skelbimai</a>
                            <a class="dropdown-item" href="{{route('boughtitemshow')}}">Nupirkti daiktai</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <x-a class="nav-link" :href="route('openmessagelist')"
                             :active="request()->routeIs('messages') || request()->routeIs('messages.*')">Žinutės @include('unread-count')</x-a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Apie</a>

                </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link " href="{{route('portfolioshow', Auth::User()->id)}}">Portfolio</a>
                </li>
                    @endauth
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Kontaktai</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link js-scroll-trigger">{{Auth::User()->name}}</a>
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
                            <a href="{{ route('login') }}" class="nav-link js-scroll-trigger">Prisijungti</a>
                        </li>

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link js-scroll-trigger">Registruotis</a>
                            </li>

                            @endif
                        @endauth
                @endif
            </ul>
        </div>
    </div>
    <div style="clear:both;" class="searchBox">
        <input class="searchInput"type="text" name="" placeholder="Search">
        <button class="searchButton" href="#">
            <i class="material-icons">
                search
            </i>
        </button>
    </div>
</nav>


<header class="masthead text-center text-white d-flex">

    <div class="container my-auto">
        <div class="">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-uppercase">
                    <br><br><br>
                    <strong>Daiktų antrinio panaudojimo skatininimo informacinė sistema</strong>
                </h2>
                <hr>

            </div>
            <div class="row">
            <div class="col-lg-7 col-md-10 col-10" style="margin-left: 0px">
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" style="margin-left: -150px" href="{{route('itemannounc')}}">Daiktų skelbimai</a>
                <table class="content-table">
                    <thead>
                    <th></th>
                    <th>Skelbimo pavadinimas</th>
                    <th>Kaina</th>
                    <th>Veiksmai</th>
                    </thead>
                    <?php $smth = 0;?>
                    <tbody>
                    @foreach($announcements as $announcement)
                        <?php $smth = 0;?>
                        @foreach($images as $image)
                        @if($announcement->hide == 0 && $announcement->id == $image->item->id && $smth == 0)
                            <?php $smth++; ?>
                            <tr>
                                <td> <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" /> </td>
                                <td>{{ $announcement->name }}</td>
                                <td>{{ $announcement->price }}</td>

                                <td>
                                    <a href="{{route('itemshow', $announcement->id)}}">
                                        <button class="btn3 btn-primary">Pasirinkti</button>
                                    </a>
                                </td>
                                @endif
                                @endforeach
                                @endforeach
                                </td>

                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-5 col-md-12 col-12" style="float: right" >
                <a class="btn btn-primary btn-xl2 js-scroll-trigger" href="{{route('serviceannounc')}}">Paslaugų skelbimai</a>
                <table class="content-table">
                    <thead>
                    <th>Skelbimo pavadinimas</th>
                    <th>Kaina</th>
                    <th>Veiksmai</th>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        @if($service->hide == 0)
                            <tr >
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>

                                <td>
                                    <a href="{{route('serviceshow', $service->id)}}">
                                        <button class="btn3 btn-primary">Pasirinkti</button>
                                    </a>
                                </td>
                                @endif
                                @endforeach
                                </td>

                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            </div>
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
