<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daiktų antrinio panaudojimo skatinimo informacinė sistema</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <!-- Custom fonts for this template -->
    <link href="/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/creative.css')}}" rel="stylesheet">

    <!-- Script -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">




</head>

<body id="page-top">
<!-- Navigation -->
<div>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="headerNav">
    <div class="container">
        <div style="width: 132px;margin-left: 35px;">
        <form action="{{route('keywordsearch')}}">
            <div class="searchBox">
                <input class="searchInput"type="text" name="search" placeholder="Search">
                <button class="searchButton" href="#">
                    <i class="material-icons">
                        search
                    </i>
                </button>
            </div>
        </form>
        </div>
        <a href="{{url('')}}" class="navbar-brand js-scroll-trigger" href="#page-top">DAPIS</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="collapse navbar-collapse dropdown" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @auth
    <li class="nav-item">
    <div class="dropdown">
        <a style="color: black;font-weight: 700; cursor: pointer" class="nav-link dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Mano skelbimai
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{route('personalAnn')}}">Mano skelbimai</a></li>
            <li><a class="dropdown-item" href="{{route('rememberAnn')}}">Įsiminti skelbimai</a></li>
            <li><a class="dropdown-item" href="{{route('boughtitemshow')}}">Nupirkti daiktai</a></li>
        </ul>
    </div>
    </li>

                    <li class="nav-item">
                        <x-a class="nav-link" :href="route('openmessagelist')"
                             :active="request()->routeIs('messages') || request()->routeIs('messages.*')">Žinutės @include('unread-count')</x-a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{url('/')}}#about">Apie</a>

                </li>
                    @auth
                <li class="nav-item">
                    <a class="nav-link " href="{{route('portfolioshow', Auth::User()->id)}}">Portfolio</a>
                </li>
                    @endauth
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{url('/')}}#contact">Kontaktai</a>
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

</nav>
</div>

<div class="inner">
    <main class="py-4">

        @yield('content')
    </main>
</div>
</body>

</html>
