@extends('layouts.app')
@section('content')

<body style="margin-top: 0px;">

<div class="container">
    <div class="">
        <h4 class="">Pasirinkto daikto skelbimo informacija</h4>


        <div style="display: flex; flex-direction: row;">
            @if(Auth::user()->id == $item->user_id)
                   <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('itemdestroy', $item->id)}}"><button style="cursor: pointer;">Išimti skelbimą</button></a>
                    @if(Auth::user()->id == $item->user_id)
                        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itemedit', $item->id)}}"><button style="cursor: pointer;">Redaguoti</button></a>
                    @endif
                    @endif

                <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{ url('personalAnnouncement') }}"><button style="cursor: pointer;">Atgal</button></a>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto; margin-right: -10px;" href="{{route('rememberitem', $item->id)}}"><button <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                <form method="POST" action="{{route('itemforget', $item->id)}}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                </form>
        </div>
    </div>

    <div class="">
        @if($bought != null)
        <p style="color:red" class="name"><b>Daiktas yra nupirktas</b></p>
        @endif
        <p class="name"><b>{{ $item->name }}</b></p>
        <div class="hairline"></div>

        <div class="left-info" style="text-align: left;">


        </div>
        <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
        <p>Skelbimo kaina(eurai)  - <b>{{ $item->price }}</b></p>
        <p>Skelbimo adresas  - <b>{{ $item->address }}</b></p>
            @if($item->change == 1)
            <p><b style="color:red">Vartotoją domina keitimasis daiktais</b></p>
                @endif
        <div class="hairline"></div>
            @if(Auth::user()->id != $item->user_id)
                <p> <a href="{{route('createmessage', $item->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a> </p>
            @endif
        <p class="infoHeader">Aprašymas</p>
        <p class="info"><b>{{ $item->information }}</b><p>
        <p class="infoHeader">Nuotraukos</p>
        @foreach($image as $image)
            @if($image->post_id == $item->id && $image->see == 0)
                <img src="{{asset($image->path)}}" alt="{{ $image->path }}" height="100px" width="100px" />
                <hr />
            @endif
        @endforeach
        @foreach($pins as $pin)
        <div>
        <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin['id']}}/"></a>
            <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin['id']])}}"><button>Įsiminti</button></a>
        @endforeach
        @foreach($pins2 as $pin2)

                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin2['id']}}/"></a>
                <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin2['id']])}}"><button>Įsiminti</button></a>
        @endforeach
        @foreach($pins3 as $pin3)

                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin3['id']}}/"></a>
                <a href="{{route('savepininitem', ['id' => $item->id, 'pin' => $pin3['id']])}}"><button>Įsiminti</button></a>
            </div>
        @endforeach
        @csrf
        {{-- Pagination --}}
            <div class="d-flex justify-content-center" name="action" value='html'>
                <div class="bottom">
                    {!! $pins->links() !!}
                </div>
            </div>
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
            <br>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itembuy', ['id' => $item->id, 'userid' => $item->user_id])}}"><button <?php if($bought != null || Auth::User()->id == $item->user_id){ ?> disabled <?php }?>  class="">Pirkti daiktą</button></a>

        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
    </div>
        </body>
@endsection
