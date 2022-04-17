@extends('layouts.app')

@section('content')
    <center>
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 style="border: red"> <strong>Paslaugų skelbimų sąrašas </strong></h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
            <hr>
        </div>
    </center>
    <div class="row">
        <div class="col-lg-4 col-md-10 col-10">

            <table style="margin-top: -10px;margin-left: 60px" class="content-table">

                <thead>
                <th>Paieška pagal kategorijas</th>
                </thead>
                <form action="{{route('sreachbycatservice')}}">
                    <tbody>
                    @foreach($categorys as $cat)
                        <tr>
                            <td><input type="radio" class="single-checkbox" name="searchcat" value="{{$cat->id}}"> {{$cat->name}}</td>
                        </tr>
                    @endforeach
                    <tr><td><button class="btn3 btn-primary">Ieškoti</button></td></tr>
                    </tbody>

                </form>
            </table>
        </div>
        <div class="col-lg-7 col-md-12 col-12">
        <table class="content-table">
            <thead>
            <th>Paslaugų skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($services as $service)
                @if(Auth::check())
                @if(Auth::user()->id != $service->user_id && $service->hide == 0)
                <tr >
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->price }}</td>

                    <td>
                        <a href="{{route('serviceshow', $service->id)}}">
                            <button class="btn btn-primary btn-xl js-scroll-trigger">Pasirinkti</button>
                        </a>
                    </td>
                    @endif
                    @else
                    <tr >
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->price }}</td>

                        <td>
                            <a href="{{route('serviceshow', $service->id)}}">
                                <button class="btn btn-primary btn-xl js-scroll-trigger">Pasirinkti</button>
                            </a>
                        </td>
                    @endif
                    @endforeach
                    </td>

                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
    </body>

@endsection







