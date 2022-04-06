@extends('layouts.app')
@section('content')

<body style="margin-top: 0px;">

<div class="container">
    <div style="text-align: center" class="">
        <h4 class="">Pasirinkto daikto skelbimo informacija</h4>
        <hr>
            @if(Auth::user()->id == $item->user_id)
                   <a href="{{route('itemdestroy', $item->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Išimti skelbimą</button></a>
                    @if(Auth::user()->id == $item->user_id)
                        <a href="{{route('itemedit', $item->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Redaguoti</button></a>
                    @endif
                    @endif

                <a href="{{ url('personalAnnouncement') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
                <a href="{{route('rememberitem', $item->id)}}"><button class="btn btn-primary btn-xl js-scroll-trigger" <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                <form method="POST" action="{{route('itemforget', $item->id)}}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                </form>
    </div>
    <hr>
    <?php $counter = 0; ?>

        <div class="row">
            <div class="col-lg-5 col-md-12 col-12">
                @foreach($image as $image)
                    @if($image->post_id == $item->id && $image->see == 0)
                        @if($counter == 0)
                        <img class="img-fluid pb-1" src="{{asset($image->path)}}" alt="{{ $image->path }}" id="MainImg" width="600px" height="600px" />
                            <?php $counter = $counter + 1;?>
                            <div class="small-img-group">
                                <div class="small-img-col">
                                    <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" width="300px" height="300px" />
                                </div>
                        @else
                            <div class="small-img-col">
                                <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" width="300px" height="300px" />
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
                @if(Auth::user()->id != $item->user_id)
                    <p> <a href="{{route('createmessage', $item->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a> </p>
                @endif
                <p style="font-weight: bold">Aprašymas</p>
                <p>{{ $item->information }}<p>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itembuy', ['id' => $item->id, 'userid' => $item->user_id])}}"><button class="btn btn-primary btn-xl js-scroll-trigger" <?php if($bought != null || Auth::User()->id == $item->user_id){ ?> disabled <?php }?>  class="">Pirkti daiktą</button></a>
            </div>
        </div>

        <br>
    <hr>
    <div class="container2">
        <div class="block_container">
        @foreach($pins as $pin)
        <div class="container col-md-6">
        <a data-pin-do="embedPin" data-pin-save="false" href="https://www.pinterest.com/pin/{{$pin['id']}}/"></a>
            <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin['id'], 'tagid' => $tagid])}}"><button class="btn2">Įsiminti</button></a>
        </div>
        @endforeach
        @foreach($pins2 as $pin2)
                <div class="container col-md-6">
                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin2['id']}}/"></a>
                <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin2['id'], 'tagid' => $tagid2])}}"><button class="btn2">Įsiminti</button></a>
                </div>
        @endforeach
        @foreach($pins3 as $pin3)
                <div  class="container col-md-6">
                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin3['id']}}/"></a>
                <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin3['id'], 'tagid' => $tagid3])}}"><button class="btn2">Įsiminti</button></a>
                </div>
        @endforeach
        </div>
        @csrf
        {{-- Pagination --}}
            <div class="" name="action" value='html' style="float:right">
                <div class="bottom">
                    {!! $pins->links() !!}
                </div>
            </div>
    </div>

    <div style="clear:both;" class="container">
        <hr>
            <p class="">Paslaugų perdirbimo pasiūlymai</p>
            <tr class="">Paslaugos pavadinimas</tr>
            <tr class="">Įsiminti</tr>
            <br>
            @foreach($service as $serv)
                @if($serv->service->hide == 0)
               <a class="" href="{{route('serviceshow', $serv->service->id)}}">{{$serv->service->name}}</a>
                    <a href="{{route('saveserviceinitem', ['id' => $item->id, 'servid' => $serv->service->id])}}"><button
                        <?php foreach($itemhasservice as $itemhas){
                            if($serv->services_announcement_id != $itemhas->services_announcement_id){
                            }
                            else{


                         ?> disabled
                        <?php }} ?> >Įsiminti</button></a>
                    <br>
                @endif
            @endforeach
            <p>Išsaugotos paslaugos</p>
            @foreach($itemhasservice as $serv)
                @if($serv->service->hide == 0)
                    <div style="display: flex; flex-direction: row;">
                    <a class="" href="{{route('serviceshow', $serv->service->id)}}">{{$serv->service->name}}</a>
                    <form method="POST" action="{{route('itemnoservice', ['id' => $item->id, 'someid' => $serv->id])}}" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <a><button type="submit">Pamiršti</button></a>
                    </form>
                    </div>
                    <br>
                @endif
            @endforeach
            <p>Išsaugoti pinai</p>
            <div>
            @foreach($itemhaspins as $pins)
                    <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pins->pinpicture}}/"></a>
                @endforeach
            </div>
    </div>


        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
    <script>
        var MainImg = document.getElementById('MainImg');
        var smallimg = document.getElementsByClassName('img-fluid');
        var all = 5;

        for ( var i = 0; i < 5; i++ ) (function(i){
            smallimg[i].onclick = function (){
                MainImg.src = smallimg[i].src;
            }
        })(i);
    </script>
        </body>
@endsection
