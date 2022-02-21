@extends('layouts.app')

@section('content')
<body>
<div class="container" style="margin-bottom: 20px">
    <div class="container">
        <h4 class="testListSplashText">Skelbimų sąrašas</h4>

        <a href=""><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Sukurti naują skelbimą</button></a>
        <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
    </div>

    <table class="">
        <thead>
        <th>Daikto skelbimo pavadinimas</th>
        <th>Kaina</th>
        <th>Veiksmai</th>
        </thead>
        <tbody>
        @foreach($announcements as $announcement)
            <tr >
                <td>{{ $announcement->name }}</td>
                <td>{{ $announcement->price }}</td>

                    <td>
                        <a href="">
                            <button class="btn btn-primary btn-xl js-scroll-trigger">Pasirinkti</button>
                        </a>
                    </td>
                @endforeach
                    </td>

                    </td>
                </tr>
        </tbody>
    </table>
    <table class="">
        <thead>
        <th>Paslaugų skelbimo pavadinimas</th>
        <th>Kaina</th>
        <th>Veiksmai</th>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr >
                <td>{{ $service->name }}</td>
                <td>{{ $service->price }}</td>

                <td>
                    <a href="">
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
@endsection







