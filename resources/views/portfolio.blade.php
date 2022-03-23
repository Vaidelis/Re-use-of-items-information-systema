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
        <div class="container">
            <h4 class="testListSplashText">Perdarytų daiktų portfolio</h4>
            <a href="{{ url('/') }}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Atgal</button></a>
            <button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;" id="myBtn">Įvertinti tiekėją</button>
        </div>
@if($id == Auth::User()->id)
        <h4 class="testListSplashText">Klientų sąrašas</h4>
        <table class="">
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
                                <button class="btn btn-primary btn-xl js-scroll-trigger">Įkelti</button>
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
        <h4 class="testListSplashText">Padaryti darbai</h4>
        <table class="">
            <thead>
            <th>Klientas</th>
            <th>Pavadinimas</th>
            </thead>
            <tbody>
        @foreach($port as $por)
            @if($por->name != null)

            <tr>
                <th>{{$por->user->name}}</th>
                <th>{{$por->postname}}</th>
            </tr>


            <tr>
            <table class="p-0" id="portfolio">
                <div class="container-fluid p-0">
                    <div class="row no-gutters popup-gallery">
                        <div class="col-lg-4 col-sm-6">
                            <a class="portfolio-box" href="">
                                <img class="img-fluid" src="{{asset($por->path)}}" alt="{{ $por->path }}">
                                <div class="portfolio-box-caption">
                                    <div class="portfolio-box-caption-content">
                                        <div class="project-category text-faded">
                                            Prieš
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" alt="{{ $por->path2 }}">
                        <img class="img-fluid" src="{{asset($por->path2)}}" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Po
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
             </div>
                </div>
            </table>

            </tr>



            @endif
        @endforeach
            </tbody>
        </table>

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







