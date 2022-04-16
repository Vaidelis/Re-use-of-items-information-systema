@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div style="text-align: center">
            <h4 class="">Pasirinktos paslaugos skelbimo informacija</h4>
            <hr>
            @Auth
                @if(Auth::user()->id == $service->user_id)
                    <a  href="{{route('servicedestroy', $service->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Išimti skelbimą</button></a>
                        @if(Auth::user()->id == $service->user_id)
                            <a href="{{route('serviceedit', $service->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Redaguoti</button></a>
                        @endif
                        @endif
                    @endauth
                    <a  href="{{ url('personalAnnouncement') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
            @auth
                    <a  href="{{route('rememberservice', $service->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                    <form method="POST" action="{{route('serviceforget', $service->id)}}" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary btn-xl js-scroll-trigger" <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                    </form>
            @endauth
            <hr>
        </div>


        <div class="">
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
                @auth
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('servicebuy', [ 'id' => $service->id, 'userid' => $service->user_id])}}"><button <?php if($bought != null || Auth::User()->id == $service->user_id){ ?> disabled <?php }?> class="btn btn-primary btn-xl js-scroll-trigger" >Pirkti paslaugą</button></a>
                @endauth
    </body>
@endsection
