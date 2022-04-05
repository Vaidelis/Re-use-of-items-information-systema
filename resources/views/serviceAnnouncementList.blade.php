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

        <table class="content-table">
            <thead>
            <th>Paslaugų skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($services as $service)
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
                    @endforeach
                    </td>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </body>
    </center>
@endsection







