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
            Daikto skelbimo redagavimas
        </h1>
        <hr>
            <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('itemshow', $item->id)}}"><button class="btn btn-primary"  style="cursor: pointer;">Atgal</button></a>
            {!! Form::close() !!}
        <hr>

    </div>


    <div class="">
        {!! Form::open(['action' => ['App\Http\Controllers\ItemController@updateitem',$item->id], 'method'=>'POST']) !!}
        @csrf
        {{Form::hidden('_method', 'PATCH')}}



        <div class="form-group">
            {{Form::label('name', 'Skelbimo pavadinimas')}}
            <br>
            {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'Skelbimo pavadinimas'])}}
        </div>


        <div class="form-group">
            {{Form::label('address', 'Skelbimo adresas')}}
            <br>
            {{Form::text('address', $item->address, ['class' => 'form-control', 'placeholder' => 'Pardavėjo adresas'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Skelbimo kaina')}}
            <br>
            {{Form::text('price', $item->price, ['class' => 'form-control', 'placeholder' => 'Skelbimo kaina'])}}
        </div>
        <div class="form-group">
            {{Form::label('info', 'Skelbimo informacija')}}
            <br>
            {{Form::textarea('info', $item->information, ['class' => 'form-control', 'placeholder' => 'Skelbimo informacija'])}}
        </div>
        <div class="form-group">
            {{ Form::submit('Saugoti', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
</div>
</body>
@endsection
