@extends('layouts.app')
@section('content')
    <body style="margin-top: 0px;">
    <style>
        textarea {
            width: 50%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }
    </style>

    <div class="container">
        <div style="text-align: center">
            <h1>
                Paslaugų skelbimo redagavimas
            </h1>
            <hr>
                <a href="{{route('serviceshow', $service->id)}}" ><button class="btn btn-primary" >Atgal</button></a>
                {!! Form::close() !!}
            <hr>
        </div>


        <div class="form-group">
            {!! Form::open(['action' => ['App\Http\Controllers\ItemController@updateservice',$service->id], 'method'=>'POST']) !!}
            @csrf
            {{Form::hidden('_method', 'PATCH')}}



            <div class="form-group">
                {{Form::label('name', 'Skelbimo pavadinimas')}}
                <br>
                {{Form::text('name', $service->name, ['class' => 'form-control', 'placeholder' => 'Skelbimo pavadinimas'])}}
            </div>

            <div class="form-group">
                {{Form::label('price', 'Skelbimo pavadinimas')}}
                <br>
                {{Form::text('price', $service->price, ['class' => 'form-control', 'placeholder' => 'Skelbimo kaina'])}}
            </div>
            <div class="form-group">
                {{Form::label('info', 'Skelbimo informacija informacija')}}
                <br>
                {{Form::textarea('info', $service->information, ['class' => 'form-control', 'placeholder' => 'Skelbimo informacija'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Saugoti', ['class'=>'btn btn-primary'])}}
            </div>
        </div>
    </div>
    </body>
@endsection
