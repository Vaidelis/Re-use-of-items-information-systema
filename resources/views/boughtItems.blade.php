@extends('layouts.app')

@section('content')
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="testListSplashText">Jūsų nupirktų daiktų sąrašas</h4>
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

    </div>
@endsection







