@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div class="">
            <h4 class="">Pasirinkto daikto skelbimo informacija</h4>


            <div style="display: flex; flex-direction: row;">
                @if(Auth::user()->id == $service->user_id)
                    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('servicedestroy', $service->id)}}"><button style="cursor: pointer;">Išimti skelbimą</button></a>
                        @if(Auth::user()->id == $service->user_id)
                            <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('serviceedit', $service->id)}}"><button style="cursor: pointer;">Redaguoti</button></a>
                        @endif
                        @endif

                    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('personalAnnouncement') }}"><button style="cursor: pointer;">Atgal</button></a>
                    <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('rememberservice', $service->id)}}"><button <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                    <form method="POST" action="{{route('serviceforget', $service->id)}}" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                    </form>
            </div>
        </div>

        <div class="">
            <p class="name"><b>{{ $service->name }}</b></p>
            <div class="hairline"></div>

            <div class="left-info" style="text-align: left;">


            </div>
            <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
            <p>Skelbimo kaina  - <b>{{ $service->price }}</b></p>
            <div class="hairline"></div>
            <a style="position: center"  href="{{route('portfolioshow', $service->user_id)}}">Tiekėjo informacija</a>
            @if(Auth::user()->id != $service->user_id)
                <a href="{{route('createmessage', $service->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a>
            @endif
            <p class="infoHeader">Aprašymas</p>
            <p class="info"><b>{{ $service->information }}</b><p>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('servicebuy', [ 'id' => $service->id, 'userid' => $service->user_id])}}"><button <?php if($bought != null || Auth::User()->id == $service->user_id){ ?> disabled <?php }?> class="testProceedButton">Pirkti paslaugą</button></a>

    </body>
@endsection
