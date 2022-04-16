@extends('layouts.app')

@section('content')

<body>
<div class="container" style="margin-bottom: 20px">
    <center>
    <div class="container">
        <h4 class="testListSplashText">Skelbimų sąrašas</h4>
        <hr>
        <a href="{{route('createitem')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Sukurti daikto skelbimą</button></a>
        <a href="{{route('createservice')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Sukurti paslaugų skelbimą</button></a>
        <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
    </div>
    </center>
    <hr>
    <div class="row">
        <div  class="col-lg-6 col-md-9 col-9">
    <table class="content-table">
        <thead>
        <th></th>
        <th>Daikto skelbimas</th>
        <th>Kaina</th>
        <th>Veiksmai</th>
        </thead>
        <?php $smth = 0; ?>
        <tbody>
        @foreach($announcements as $announcement)
            <?php $smth = 0;?>
            @foreach($images as $image)
            @if($announcement->hide == 0 && $announcement->id == $image->item->id && $smth == 0)
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
                @endforeach
                @endforeach
                    </td>

                    </td>
                </tr>
        </tbody>
    </table>
        </div>
        <div class="col-lg-6 col-md-10 col-10" style="float: right">
    <table class="content-table">
        <thead>
        <th>Paslaugų skelbimas</th>
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
                        <button class="btn btn-primary btn3">Pasirinkti</button>
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







