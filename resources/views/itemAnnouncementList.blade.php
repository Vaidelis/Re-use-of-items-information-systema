@extends('layouts.app')

@section('content')
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="testListSplashText">Daiktų skelbimų sąrašas</h4>
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
                @if(Auth::user()->id != $announcement->user_id)
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

    </div>
@endsection






