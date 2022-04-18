@extends('layouts.app')

@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>


    <body>
    <div class="container" style="margin-bottom: 20px">
        <div class="container" style="text-align: center">
            <h4 class="testListSplashText">{{$ownername}} perdarytų daiktų portfolio</h4>
            <hr>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
            <button <?php if($notdone != null || Auth::User()->id == $id || $exist != null){ ?> disabled <?php }?>  class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;" id="myBtn">Įvertinti tiekėją</button>
            <hr>
        </div>
    <div>
        @if($id == Auth::User()->id)
        <table class="content-table">
            <thead>
            <th colspan="3" style="text-align: center">Klientų sąrašas</th>
            </thead>
            <thead>
            <th>Klientas</th>
            <th>Skelbimo pavadinimas</th>
            <th>Veiksmai</th>
            </thead>
            <tbody>
            @foreach($port as $por)
                @if($por->name == null)

                    <tr >
                        <td>{{ $por->user->name }}</td>
                        <td>{{$por->service->name}} </td>
                        <td>
                            <a href="{{route('portfoliouploadshow',['id' => $id, 'id2' => $por->id])}}">
                                <button class="btn3 btn-primary btn-xl">Įkelti</button>
                            </a>
                        </td>
                @endif
                        @endforeach
                        </td>

                        </td>
                    </tr>
            </tbody>
        </table>
        @endif
    </div>
        <div>
        <table class="content-table">
            <thead>
            <th colspan="3" style="text-align: center">Žmonių atsiliepimai</th>
            </thead>
            <thead>
            <th>Klientas</th>
            <th>Įvertinimas</th>
            <th>Komentaras</th>
            </thead>
            <tbody>
            @foreach($comments as $com)
                    <tr >
                        <td>{{$com->buyername  }}</td>
                        <td>{{$com->rate}} </td>
                        <td>{{$com->comment}}</td>
                        @endforeach
                        </td>

                        </td>
                    </tr>
            </tbody>
        </table>
        </div>
        <div>
        <table class="content-table">
            <thead>
            <th colspan="4" style="text-align: center">Perdaryti darbai</th>
            </thead>
            <thead>
            <th>Klientas</th>
            <th>Pavadinimas</th>
            <th colspan="2" style="text-align: center">Nuotraukos</th>
            </thead>
            <tbody>
        @foreach($port as $por)
            @if($por->name != null)
            <tr>
                <th>{{$por->user->name}}</th>
                <th>{{$por->postname}}</th>
            <th>
            <a class="portfolio-box" href="">
                <img class="img-fluid" style="width: 350px; height: 350px; object-fit: cover;" src="{{asset($por->path)}}" alt="{{ $por->path }}">
                <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                        <div class="project-category text-faded">
                            Prieš
                        </div>
                    </div>
                </div>
            </a>
            </th>
                <th>
                    <a class="portfolio-box" alt="{{ $por->path2 }}">
                        <img class="img-fluid" style="width: 350px; height: 350px; object-fit: cover;" src="{{asset($por->path2)}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Po
                                </div>
                            </div>
                        </div>
                    </a>
                </th>
            </tr>
                <div class="col-lg-4 col-sm-6">
                </div>
             </div>
                </div>




            @endif
        @endforeach
            </tbody>
        </table>
        </div>

    </div>


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="post" action="{{route('servicerate', $id)}}" enctype="multipart/form-data">

            <label class="label">Komenataras apie tiekėjo suteiktas paslaugas: </label>
                @csrf
            <input placeholder="Komentaras" type="text" name="comment" class="form-control" required/>
                <br>
                <select name="stars" placeholder="Testo lygis" style="width: 300px; position: center;">
                    <option value="1">&#9733;</option>
                    <option value="2">&#9733;&#9733;</option>
                    <option value="3">&#9733;&#9733;&#9733;</option>
                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                </select>
                <br>
            <br>
            <div class="form-group">
                <input  type="submit" class="btn btn-success" />
            </div>
            </form>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    </body>
@endsection







