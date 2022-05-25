@extends('layouts.app')

@section('content')

    <body style="margin-top: 0px;">
    <style>
        .text{
            padding-left: 10px;
        }
    </style>

    <div class="container">
        <div style="text-align: center">
            <h4>
                Pinterest segtuko informacija
            </h4>
            <hr>
            <a href="{{route('taglist')}}" ><button class="btn btn-primary" >Atgal</button></a>
            {!! Form::close() !!}
            <hr>
        </div>


        <div class="row">

            <div class="col-lg-3 col-md-12 col-12">
                <table class="content-table">
            {!! Form::open(['action' => ['App\Http\Controllers\AdminController@edittag',$tag->id], 'method'=>'POST']) !!}
            @csrf
            {{Form::hidden('_method', 'PATCH')}}


                    <tbody>

          <td> <div class="form-group">
                {{Form::label('namelt', 'Pinterest segtukas(LT)')}}
                <br>
                {{Form::text('namelt', $tag->namelt, ['size' => 20, 'placeholder' => 'Pinterest segtuko lietuviškas pavadinimas'])}}
            </div>

            <div class="form-group">
                {{Form::label('name', 'Pinterest segtukas(EN)')}}
                <br>
                {{Form::text('name', $tag->name, ['size' => 20, 'placeholder' => 'Pinterest segtuko angliškas pavadinimas'])}}
            </div>
            <div class="form-group">
                {{ Form::submit('Saugoti', ['class'=>'btn3 btn-primary'])}}
            </div>
          </td>
                    </tbody>
                </table>
        </div>

                <div class="col-lg-9 col-md-12 col-12">
                    <table class="content-table">
                        <thead>
                        <th style="text-align: center" colspan="3">Panašių daiktų pasiūlymai perdirbimui</th>
                        </thead>
                        <tbody>
                        <td class="container col-md-6" style="position:relative">
                            @foreach($pins as $pin)
                                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin['id']}}/"></a>
                            @endforeach
                        </td>
                        </tbody>
                    </table>
                    @csrf
                    {{-- Pagination --}}
                    <div class="" name="action" value='html' style="float:right">
                        <div style="margin-left: -600px" class="bottom">
                            {!! $pins->links() !!}
                        </div>
                    </div>
                </div>
        </div>

    </div>
    </body>

    <script async defer src="//assets.pinterest.com/js/pinit.js"></script>

@endsection
