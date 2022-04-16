@extends('layouts.app')

@section('content')
    <center>
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="">Daiktų skelbimų sąrašas</h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
        </div>
        <hr>
        <table class="content-table">
            <thead>
            <th></th>
            <th>Daikto skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <?php $smth = 0; ?>
            <tbody>
            @foreach($announcements as $announcement)
                <?php $smth = 0;?>
                @foreach($images as $image)
                @if(Auth::check())
                @if(Auth::user()->id != $announcement->user_id && $announcement->hide == 0 && $announcement->id == $image->item->id && $smth == 0)
                    <?php $smth++; ?>
                <tr >
                    <td> <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" /> </td>
                    <td>{{ $announcement->name }}</td>
                    <td>{{ $announcement->price }}</td>

                    <td>
                        <a href="{{route('itemshow', $announcement->id)}}">
                            <button class="btn btn-primary btn3">Pasirinkti</button>
                        </a>
                    </td>
                    @endif
                    @else
                    <?php $smth++; ?>
                    <tr>
                        <td> <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" /> </td>
                        <td>{{ $announcement->name }}</td>
                        <td>{{ $announcement->price }}</td>

                        <td>
                            <a href="{{route('itemshow', $announcement->id)}}">
                                <button class="btn btn-primary btn3">Pasirinkti</button>
                            </a>
                        </td>
                        @endif
                        @endforeach
                    @endforeach
                    </td>

                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    </center>
@endsection







