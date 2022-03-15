@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div class="">
            <h4 class="">Pasirinkto daikto skelbimo informacija</h4>


            <div style="display: flex; flex-direction: row;">
                @if(Auth::user()->id == $service->user_id)
                    <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                        {!! Form::open(['action' => ['App\Http\Controllers\ItemController@servicedelete',$service->id],
                                                'method'=>'POST']) !!}
                        @csrf
                        {{Form::hidden('_method','DELETE')}}

                        {{Form::submit('Ištrinti', ['class'=>'deleteButton'])}}
                        {!! Form::close() !!}
                        @if(Auth::user()->id == $service->user_id)
                            <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('serviceedit', $service->id)}}"><button style="cursor: pointer;">Redaguoti</button></a>
                        @endif
                        @endif
                    </a>

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
            <a style="position: center"  href="">Tiekėjo informacija</a>
            <p class="infoHeader">Aprašymas</p>
            <p class="info"><b>{{ $service->information }}</b><p>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href=""><button class="testProceedButton">Pirkti daiktą</button></a>

    </body>
@endsection
