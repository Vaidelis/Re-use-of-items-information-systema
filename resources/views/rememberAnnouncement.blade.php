@extends('layouts.app')

@section('content')
    <center>
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="testListSplashText">Įsiminusių skelbimų sąrašas</h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
            <hr>
        </div>

        <table class="content-table">
            <thead>
            <th>Daikto skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($rememberItem as $announcement)
                <tr >
                    <td>{{ $announcement->item->name }}</td>
                    <td>{{ $announcement->item->price }}</td>

                    <td>
                        <a href="{{route('itemshow', $announcement->item->id)}}">
                            <button class="btn btn-primary btn-xl js-scroll-trigger">Pasirinkti</button>
                        </a>
                    </td>
                    @endforeach
                    </td>

                    </td>
                </tr>
            </tbody>
        </table>
        <table class="content-table">
            <thead>
            <th>Paslaugų skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($rememberService as $services)
                <tr >
                    <td>{{ $services->service->name }}</td>
                    <td>{{ $services->service->price }}</td>

                    <td>
                        <a href="{{route('serviceshow', $services->service->id)}}">
                            <button class="btn btn-primary btn-xl js-scroll-trigger">Pasirinkti</button>
                        </a>
                    </td>
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







