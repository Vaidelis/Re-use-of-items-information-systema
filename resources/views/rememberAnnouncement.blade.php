@extends('layouts.app')

@section('content')
    <center>
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="testListSplashText">Įsiminusių skelbimų sąrašas</h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
            <hr>
        </div>

        <table class="content-table">
            <thead>
            <th></th>
            <th>Daikto skelbimo pavadinimas</th>
            <th>Kaina</th>
            <th>Veiksmai</th>
            </thead>
            <?php $smth = 0; ?>
            <tbody>
            @foreach($rememberItem as $announcement)
                <?php $smth = 0;?>
                @foreach($images as $image)
                @if($announcement->item->hide == 0 && $announcement->item->id == $image->item->id && $smth == 0)
                    <?php $smth++; ?>
                <tr >
                    <td> <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" /> </td>
                    <td>{{ $announcement->item->name }}</td>
                    <td>{{ $announcement->item->price }}</td>

                    <td>
                        <a href="{{route('itemshow', $announcement->item->id)}}">
                            <button class="btn3 btn-primary btn-xl">Pasirinkti</button>
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
        {{-- Pagination --}}
        <div class="" name="action" value='html' style="text-align: center">
            <div class="bottom">
                {!! $rememberItem->links() !!}
            </div>
        </div>
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
                            <button class="btn3 btn-primary btn-xl">Pasirinkti</button>
                        </a>
                    </td>
                    @endforeach
                    </td>

                    </td>
                </tr>
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="" name="paramName" value='html' style="text-align: center">
            <div class="bottom">
                {!! $rememberService->links() !!}
            </div>
        </div>
    </div>
    </body>
    </center>
@endsection







