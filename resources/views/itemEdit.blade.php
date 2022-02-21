@extends('layouts.app')
@section('content')
<body style="margin-top: 0px;">

<div class="pageContainer edit-test">
    <div class="selectedTestSplashContainer">
        <h1>
            Daikto skelbimo redagavimas
        </h1>
        <div style="display: flex; flex-direction: row;">


            <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="" class="btn btn-primary"><button style="cursor: pointer;">Atgal</button></a><br>
            {!! Form::close() !!}<br>


        </div>
    </div>


    <div class="testInfoContainer testInfoContainer-edit">
        {!! Form::open(['action' => ['App\Http\Controllers\ItemController@updateitem',$item->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method', 'PATCH')}}



        <div class="edit">
            {{Form::label('testName', 'Testo pavadinimas')}}
            <br>
            {{Form::text('testName', $item->name, ['class' => 'form-control', 'placeholder' => 'Skelbimo pavadinimas'])}}
        </div>


        <div class="edit">
            {{Form::label('info', 'Testo informacija')}}
            <br>
            {{Form::text('info', $item->address, ['class' => 'form-control', 'placeholder' => 'Pardavėjo adresas'])}}
        </div>

        <div class="form-group" style="width: 30%; margin: auto;">
            {{ Form::submit('Saugoti', ['class'=>'a-button'])}}
        </div>
    </div>
</div>
</body>
@endsection
