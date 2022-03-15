@extends('layouts.app')

@section('content')
<body>
<div class="container" style="margin-bottom: 20px">
    <div class="container">
        <h4 class="testListSplashText">Skelbimų sąrašas</h4>

        <a href="{{route('createitem')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Sukurti daikto skelbimą</button></a>
        <a href="{{route('createservice')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Sukurti paslaugų skelbimą</button></a>
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
            @if($announcement->hide == 0)
            <tr >
                <td>{{ $announcement->name }}</td>
                <td>{{ $announcement->price }}</td>

                    <td>
                        <a href="{{route('itemshow', $announcement->id)}}">
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
    <table class="">
        <thead>
        <th>Paslaugų skelbimo pavadinimas</th>
        <th>Kaina</th>
        <th>Veiksmai</th>
        </thead>
        <tbody>
        @foreach($services as $service)
            @if($service->hide == 0)
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
@endsection







