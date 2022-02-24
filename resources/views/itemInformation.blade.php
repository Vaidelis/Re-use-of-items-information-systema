@extends('layouts.app')
@section('content')

<body style="margin-top: 0px;">

<div class="container">
    <div class="">
        <h4 class="">Pasirinkto daikto skelbimo informacija</h4>


        <div style="display: flex; flex-direction: row;">
            @if(Auth::user()->id == $item->user_id)
               <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                    {!! Form::open(['action' => ['App\Http\Controllers\ItemController@itemdelete',$item->id],
                                            'method'=>'POST']) !!}
                    @csrf
                    {{Form::hidden('_method','DELETE')}}

                    {{Form::submit('Ištrinti', ['class'=>'deleteButton'])}}
                    {!! Form::close() !!}
                    @if(Auth::user()->id == $item->user_id)
                        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itemedit', $item->id)}}"><button style="cursor: pointer;">Redaguoti</button></a>
                    @endif
                    @endif
                </a>

                <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('personalAnnouncement') }}"><button style="cursor: pointer;">Atgal</button></a>
        </div>
    </div>

    <div class="">
        <p class="name"><b>{{ $item->name }}</b></p>
        <div class="hairline"></div>

        <div class="left-info" style="text-align: left;">


        </div>
        <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
        <p>Skelbimo kaina(eurai)  - <b>{{ $item->price }}</b></p>
        <p>Skelbimo adresas  - <b>{{ $item->address }}</b></p>
        <div class="hairline"></div>
        <p class="infoHeader">Aprašymas</p>
        <p class="info"><b>{{ $item->information }}</b><p>
        <p class="infoHeader">Nuotraukos</p>
        @foreach($image as $image)
            @if($image->post_id == $item->id && $image->see == 0)
                <img src="{{asset($image->path)}}" alt="{{ $image->path }}" height="100px" width="100px" />
                <hr />
            @endif
        @endforeach

        @csrf
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href=""><button class="testProceedButton">Pirkti daiktą</button></a>

        </body>
@endsection
