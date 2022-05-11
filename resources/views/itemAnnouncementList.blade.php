@extends('layouts.app')

@section('content')
    <center>
    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container">
            <h4 class="">Daiktų skelbimų sąrašas</h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>

        </div>

        <hr>
    </center>
    <div class="row">
        <div class="col-lg-4 col-md-10 col-10">

            <table style="margin-top: -10px;margin-left: 60px" class="content-table">

                <thead>
                <th>Paieška pagal kategorijas</th>
                </thead>
                <form action="{{route('sreachbycat')}}">
                <tbody>
                @foreach($categorys as $cat)
                    @foreach($count as $c)
                        @if($c->categorys_id == $cat->id)
                <tr>
                    <td><input type="radio" class="single-checkbox" name="searchcat" value="{{$cat->id}}"> {{$cat->name}} ({{$c->count}})</td>
                </tr>
                @endif
                    @endforeach
                    @endforeach
                <tr><td><button class="btn3 btn-primary">Ieškoti</button></td></tr>
                </tbody>

                </form>
            </table>
        </div>
        <div class="col-lg-7 col-md-12 col-12">
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
                    @elseif($announcement->hide == 0 && $announcement->id == $image->item->id && $smth == 0)
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
            {{-- Pagination --}}
            <div class="" name="action" value='html' style="text-align: center">
                <div class="bottom">
                    {!! $announcements->links() !!}
                </div>
            </div>
        </div>
        </div>

@endsection







