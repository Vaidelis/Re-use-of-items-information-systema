@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div style="text-align: center">
            <h4 class="">Pasirinktos paslaugos skelbimo informacija</h4>
            <hr>
            <a  href="{{route('serviceaccept', $service->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;width: 150px">Patvirtinti</button></a>
            <a  href="{{route('servicedecline', $service->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;width: 150px">Nepatvirtinti</button></a>
            <a  href="{{ route('unconfirmedann') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;width: 150px">Atgal</button></a>
            <hr>
        </div>

        <div class="row">

            <div class="col-lg-6 col-md-12 col-12">
                <p class="name"><b>{{ $service->name }}</b></p>
                <div class="hairline"></div>

                <div class="left-info" style="text-align: left;">


                </div>
                <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
                <p>Skelbimo kaina  - <b>{{ $service->price }}</b> €</p>
                <div class="hairline"></div>
                <a style="position: center"  href="{{route('portfolioshow', $service->user_id)}}">Tiekėjo informacija</a>
                @auth
                    @if(Auth::user()->id != $service->user_id)
                        <a href="{{route('createmessage', $service->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a>
                    @endif
                @endauth
                <p class="infoHeader">Aprašymas</p>
                <p class="info"><b>{{ $service->information }}</b><p>
            </div>


            <!-- Plugin JavaScript -->
            <script src="/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for this template -->
            <script src="/js/creative.min.js"></script>
    </body>
@endsection
