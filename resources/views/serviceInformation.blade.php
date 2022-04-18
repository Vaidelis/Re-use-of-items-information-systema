@extends('layouts.app')
@section('content')

    <body style="margin-top: 0px;">

    <div class="container">
        <div style="text-align: center">
            <h4 class="">Pasirinktos paslaugos skelbimo informacija</h4>
            <hr>
            @Auth
                @if(Auth::user()->id == $service->user_id)
                    <a  href="{{route('servicedestroy', $service->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Ištrinti</button></a>
                        @if(Auth::user()->id == $service->user_id)
                            <a href="{{route('serviceedit', $service->id)}}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Redaguoti</button></a>
                        @endif
                        @endif
                    @endauth
                    <a  href="{{ url('personalAnnouncement') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
            @auth
                    <a  href="{{route('rememberservice', $service->id)}}"><button class="btn3 btn-primary btn-xlr" <?php if($remember != null){ ?> hidden <?php }?> style="cursor: pointer;">Įsiminti</button></a>

                    <form method="POST" action="{{route('serviceforget', $service->id)}}" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button class="btn3 btn-primary btn-xl" <?php if($remember == null){ ?> hidden <?php }?> type="submit">Pamiršti</button>
                    </form>
            @endauth
            <hr>
        </div>

        <?php $counter = 0; ?>
        <div class="row">
        <div class="col-lg-5 col-md-12 col-12">
            @foreach($portphotos as $image)

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

                            @endforeach
                        </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <p class="name"><b>{{ $service->name }}</b></p>
            <div class="hairline"></div>

            <div class="left-info" style="text-align: left;">


            </div>
            <p>Skelbimo savininkas  - <b>{{ $name }}</b></p>
            <p>Skelbimo kaina  - <b>{{ $service->price }}</b> €</p>
            <div class="hairline"></div>
            <a style="position: center"  href="{{route('portfolioshow', $service->user_id)}}">Tiekėjo informacija</a>
            @auth
            @if(Auth::user()->id != $service->user_id)
                <a href="{{route('createmessage', $service->user_id)}}" class="block w-full p-2 text-center text-black bg-indigo-400 hover:bg-indigo-600">Parašyti žinute</a>
            @endif
            @endauth
            <p class="infoHeader">Aprašymas</p>
            <p class="info"><b>{{ $service->information }}</b><p>
                @auth
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('servicebuy', [ 'id' => $service->id, 'userid' => $service->user_id])}}"><button <?php if($bought != null || Auth::User()->id == $service->user_id){ ?> disabled <?php }?> class="btn3 btn-primary btn-xl" >Pirkti</button></a>
                @endauth
        </div>

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
