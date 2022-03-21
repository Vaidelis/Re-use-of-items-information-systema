@extends('layouts.app')

@section('content')
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="testListSplashText">Perdarytų daiktų portfolio</h4>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
        </div>
@if($id == Auth::User()->id)
        <h4 class="testListSplashText">Klientų sąrašas</h4>
        <table class="">
            <thead>
            <th>Klientas</th>
            <th>Skelbimo pavadinimas</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($port as $por)
                @if($por->name == null)

                    <tr >
                        <td>{{ $por->user->name }}</td>
                        <td>{{$por->service->name}} </td>
                        <td>
                            <a href="{{route('portfoliouploadshow', $por->id)}}">
                                <button class="btn btn-primary btn-xl js-scroll-trigger">Įkelti</button>
                            </a>
                        </td>
                @endif
                        @endforeach
                        </td>

                        </td>
                    </tr>
            </tbody>
        </table>
        @endif
        <h4 class="testListSplashText">Padaryti darbai</h4>
        <table class="">
            <thead>
            <th>Klientas</th>
            <th>Pavadinimas</th>
            </thead>
            <tbody>
        @foreach($port as $por)
            @if($por->name != null)

            <tr>
                <th>{{$por->user->name}}</th>
                <th>{{$por->postname}}</th>
            </tr>


            <tr>
            <table class="p-0" id="portfolio">
                <div class="container-fluid p-0">
                    <div class="row no-gutters popup-gallery">
                        <div class="col-lg-4 col-sm-6">
                            <a class="portfolio-box" href="">
                                <img class="img-fluid" src="{{asset($por->path)}}" alt="{{ $por->path }}">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Prieš
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" alt="{{ $por->path2 }}">
                        <img class="img-fluid" src="{{asset($por->path2)}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Po
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
             </div>
                </div>
            </table>

            </tr>



            @endif
        @endforeach
            </tbody>
        </table>


    </div>
@endsection







