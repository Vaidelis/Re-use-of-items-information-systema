@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div style="text-align: center" class="">
            <h4 class="">Pasirinkto daikto skelbimo informacija</h4>
            <hr>
            <a href="{{route('itemaccept', $item->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer; width: 150px">Patvirtinti</button></a>
            <a href="{{route('itemdecline', $item->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer; width: 150px">Nepatvirtinti</button></a>
            <a href="{{ url('personalAnnouncement') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;width: 150px">Atgal</button></a>
        </div>
        <hr>
        <?php $counter = 0; ?>

        <div class="row">
            <div class="col-lg-5 col-md-12 col-12">
                @foreach($image as $image)
                    @if($image->post_id == $item->id && $image->see == 0)
                        @if($counter == 0)
                            <img class="img-fluid pb-1" src="{{asset($image->path)}}" alt="{{ $image->path }}" id="MainImg" style="width: 440px; height: 430px; object-fit: cover;" />
                            <?php $counter = $counter + 1;?>
                            <div class="small-img-group">
                                <div class="small-img-col">
                                    <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                                @else
                                    <div class="small-img-col">
                                        <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" />
                                    </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <h3 style="font-weight: bold">{{ $item->name }}</h3>
                <h2 style="font-weight: bold">{{ $item->price }} eurų</h2>
                <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
                <p>Skelbimo adresas  - <b>{{ $item->address }}</b></p>
                @if($item->change == 1)
                    <p><b style="color:red">Vartotoją domina keitimasis daiktais</b></p>
                @endif
                <div class="hairline"></div>
                    @if(Auth::user()->id != $item->user_id)
                        <p> <a href="{{route('createmessage', $item->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a> </p>
                    @endif
                <p style="font-weight: bold">Aprašymas</p>
                <p>{{ $item->information }}<p>
            </div>
        </div>

        <br>
        <hr>
        <div class="container2">
            <table class="content-table">
                <thead>
                <th style="text-align: center" colspan="3">Panašių daiktų pasiūlymai perdirbimui</th>
                </thead>
                <tbody>
                <td class="container col-md-6" style="position:relative">
                    @foreach($pins as $pin)
                        <a data-pin-do="embedPin" data-pin-width="medium" href="https://www.pinterest.com/pin/{{$pin['id']}}/"></a>
                        <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin['id'], 'tagid' => $tagid])}}"><button class="btn2">Įsiminti</button></a>
                    @endforeach
                </td>
                <td class="container col-md-6" style="position:relative">
                    @foreach($pins2 as $pin2)
                        <a data-pin-do="embedPin" data-pin-width="medium" href="https://www.pinterest.com/pin/{{$pin2['id']}}/"></a>
                        <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin2['id'], 'tagid' => $tagid2])}}"><button class="btn2">Įsiminti</button></a>
                    @endforeach
                </td>
                <td class="container col-md-6"style="position:relative">
                    @foreach($pins3 as $pin3)
                        <a data-pin-do="embedPin" data-pin-width="medium" href="https://www.pinterest.com/pin/{{$pin3['id']}}/"></a>
                        <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin3['id'], 'tagid' => $tagid3])}}"><button class="btn2">Įsiminti</button></a>
                    @endforeach
                </td>
                </tbody>
            </table>
            @csrf
            {{-- Pagination --}}
            <div class="" name="action" value='html' style="float:right">
                <div class="bottom">
                    {!! $pins->links() !!}
                </div>
            </div>

        </div>
        <div style="clear:both;">
            <hr>
        </div>

        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
        <script>
            var MainImg = document.getElementById('MainImg');
            var smallimg = document.getElementsByClassName('img-fluid');
            var all = 5;

            for ( var i = 0; i < 12; i++ ) (function(i){
                smallimg[i].onclick = function (){
                    MainImg.src = smallimg[i].src;
                }
            })(i);
        </script>

        <!-- Plugin JavaScript -->
        <script src="/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for this template -->
        <script src="/js/creative.min.js"></script>
    </body>
@endsection
