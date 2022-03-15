@extends('layouts.app')
@section('content')

<body style="margin-top: 0px;">

<div class="container">
    <div class="">
        <h4 class="">Pasirinkto daikto skelbimo informacija</h4>


        <div style="display: flex; flex-direction: row;">
            @if(Auth::user()->id == $item->user_id)
               <a style="height: 40px; margin-top:auto; margin-bottom: auto;">
                    {!! Form::open(['action' => ['App\Http\Controllers\ItemController@itemdelete',$item->id],
                                            'method'=>'POST']) !!}
                    @csrf
                    {{Form::hidden('_method','DELETE')}}

                    {{Form::submit('Ištrinti', ['class'=>'deleteButton'])}}
                    {!! Form::close() !!}
                    @if(Auth::user()->id == $item->user_id)
                        <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itemedit', $item->id)}}"><button style="cursor: pointer;">Redaguoti</button></a>
                    @endif
                    @endif
                </a>

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
        <div class="hairline"></div>
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

        @endforeach
        @foreach($pins2 as $pin2)

                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin2['id']}}/"></a>

        @endforeach
        @foreach($pins3 as $pin3)

                <a data-pin-do="embedPin" href="https://www.pinterest.com/pin/{{$pin3['id']}}/"></a>
            </div>
        @endforeach
        @csrf
        {{-- Pagination --}}
            <div class="d-flex justify-content-center" name="action" value='html'>
                <div class="bottom">
                    {!! $pins->links() !!}
                </div>
            </div>
                <a style="height: 40px; margin-top:auto; margin-bottom: auto;" href="{{route('itembuy', $item->id)}}"><button <?php if($bought != null){ ?> disabled <?php }?>  class="testProceedButton">Pirkti daiktą</button></a>

        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
    </div>
        </body>
@endsection
