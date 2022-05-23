@extends('layouts.app')
@section('content')

<body style="margin-top: 0px;">

<div class="container">
    <div style="text-align: center" class="">
        <h4 class="">Pasirinkto daikto skelbimo informacija</h4>
        <hr>
        @if(Auth::check())
            @if(Auth::user()->id == $item->user_id)
                   <a onclick="return confirm('Ar tikrai norite ištrinti šį skelbimą?')" href="{{route('itemdestroy', $item->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Ištrinti</button></a>
                    @if(Auth::user()->id == $item->user_id)
                        <a href="{{route('itemedit', $item->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Redaguoti</button></a>
                    @endif
                    @endif
        @endif

                <a href="{{ url('personalAnnouncement') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
        @Auth
            @if(Auth::user()->id != $item->user_id)
                <a href="{{route('rememberitem', $item->id)}}"><button class="btn3 btn-primary btn-xl" <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>
                @endif
        @endauth
                <form method="POST" action="{{route('itemforget', $item->id)}}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                 <button class="btn3 btn-primary btn-xl" style="cursor: pointer; overflow: auto" <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                </form>
    </div>
    <hr>
    @if ($message = Session::get('success'))
        <center>
            <div style="width: 70%;height: 50px;text-align: center;" class="alert alert-success">
                <span style="text-align: center">{{ $message }}</span>
            </div>
        </center>
    @endif
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
                @if($bought != null)
                    <p style="color:red" class="name"><b>Daiktas yra nupirktas</b></p>
                @endif
                <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
                <p>Skelbimo adresas  - <b>{{ $item->address }}</b></p>
                @if($item->change == 1)
                    <p><b style="color:red">Vartotoją domina keitimasis daiktais</b></p>
                @endif
                <div class="hairline"></div>
                @if(Auth::check())
                @if(Auth::user()->id != $item->user_id)
                    <p> <a href="{{route('createmessage', $item->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a> </p>
                @endif
                @endif
                <p style="font-weight: bold">Aprašymas</p>
                <p>{{ $item->information }}<p>
                    @auth
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itembuy', ['id' => $item->id, 'userid' => $item->user_id])}}"><button class="btn3 btn-primary btn-xl" <?php if($bought != null || Auth::User()->id == $item->user_id){ ?> disabled <?php }?>  class="">Pirkti</button></a>

                        <br>
                    <br>
                    <a href="#services" class="js-scroll-trigger"><button style="width: 250px;" class="btn btn-primary btn-xl js-scroll-trigger">Perdirbimo paslaugos</button></a>
                @endauth
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
@auth
    <div style="clear:both;" class="row" id="services">

        <div class="col-lg-5 col-md-12 col-12">
        <table class="content-table">
            <thead>
            <th colspan="2" style="text-align: center">Paslaugų perdirbimo pasiūlymai</th>
            </thead>
            <thead>
            <th>Paslaugos pavadinimas</th>
            <th>Įsiminti</th>
            </thead>
            <tbody>
            @foreach($service as $serv)
                @if($serv->service->hide == 0)
                    <tr>
                    <td><a class="" href="{{route('serviceshow', $serv->service->id)}}">{{$serv->service->name}}</a></td>
                   <td> <a href="{{route('saveserviceinitem', ['id' => $item->id, 'servid' => $serv->service->id])}}"><button class="btn3 btn-primary btn-xl"
                            <?php foreach($itemhasservice as $itemhas){
                            if($serv->services_announcement_id != $itemhas->services_announcement_id){
                            }
                            else{
                            ?> disabled
                        <?php }} ?> >Įsiminti</button></a></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <table class="content-table">
                <thead>
                <th colspan="2" style="text-align: center">Išsaugoti Paslaugų perdirbimo pasiūlymai</th>
                </thead>
                <thead>
                <th>Išsaugotos paslaugos</th>
                <th>Pamiršti</th>
                </thead>
                <tbody>
                @foreach($itemhasservice as $serv)
                    @if($serv->service->hide == 0)
                        <tr>
                          <td> <a class="" href="{{route('serviceshow', $serv->service->id)}}">{{$serv->service->name}}</a></td>
                           <td> <form method="POST" action="{{route('itemnoservice', ['id' => $item->id, 'someid' => $serv->id])}}" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <a><button class="btn3 btn-primary btn-xl" type="submit">Pamiršti</button></a>
                            </form> </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>
        <div style="clear:both" class="container2">
            <table class="content-table">
                <thead>
                <th style="text-align: center">Išsaugoti pinai</th>
                </thead>
                <tbody class="row">
                    @foreach($itemhaspins as $pins)
                        <td class="container col-md-6" style="position:relative">
                        <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pins->pinpicture}}/"></a>
                        <form method="POST" action="{{route('pinsforget', ['id' => $item->id, 'pinsid' => $pins->pinpicture])}}" id="deleteForm">
                                @csrf
                                @method('DELETE')
                           <a> <button class="btn2">Pamiršti</button></a>
                            </form> </td>
                        </td>
                    @endforeach

                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="" name="paramName" value='html' style="float:left">
                <div class="bottom">
                    {!! $itemhaspins->links() !!}
                </div>
            </div>
        </div>
    </div>
    @endauth

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
