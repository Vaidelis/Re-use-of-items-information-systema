@extends('layouts.app')
@section('content')
    <body style="margin-top: 0px;">

    <div class="pageContainer edit-test">
        <div class="selectedTestSplashContainer">
            <h1>
                Paslaugų skelbimo redagavimas
            </h1>
            <div style="display: flex; flex-direction: row;">


                <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('serviceshow', $service->id)}}" class="btn btn-primary"><button style="cursor: pointer;">Atgal</button></a><br>
                {!! Form::close() !!}<br>


            </div>
        </div>


        <div class="testInfoContainer testInfoContainer-edit">
            {!! Form::open(['action' => ['App\Http\Controllers\ItemController@updateservice',$service->id], 'method'=>'POST']) !!}
            @csrf
            {{Form::hidden('_method', 'PATCH')}}



            <div class="edit">
                {{Form::label('name', 'Skelbimo pavadinimas')}}
                <br>
                {{Form::text('name', $service->name, ['class' => 'form-control', 'placeholder' => 'Skelbimo pavadinimas'])}}
            </div>

            <div class="edit">
                {{Form::label('price', 'Skelbimo pavadinimas')}}
                <br>
                {{Form::text('price', $service->price, ['class' => 'form-control', 'placeholder' => 'Skelbimo kaina'])}}
            </div>
            <div class="edit">
                {{Form::label('info', 'Skelbimo informacija informacija')}}
                <br>
                {{Form::text('info', $service->information, ['class' => 'form-control', 'placeholder' => 'Skelbimo informacija'])}}
            </div>

            <div class="form-group" style="width: 30%; margin: auto;">
                {{ Form::submit('Saugoti', ['class'=>'a-button'])}}
            </div>
        </div>
    </div>
    </body>
@endsection
