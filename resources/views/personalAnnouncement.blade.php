@extends('layouts.app')

@section('content')
<body>
<div class="container" style="margin-bottom: 20px">

    <center>
    <div class="container">
        <h4 class="testListSplashText">Skelbimų sąrašas</h4>

        <hr>
        <button class="btn btn-primary btn-xl" style="cursor: pointer;" id="myBtn">Įdėti skelbimą</button>
        <a href="{{ url('/') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
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

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h4 style="text-align: center" class="testListSplashText">Skelbimo tipas</h4>
        <hr>
            <div style="text-align: center" class="form-group">
                <a href="{{route('createitem')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Daikto</button></a>
                <a href="{{route('createservice')}}"><button class="btn btn-primary btn-xl js-scroll-trigger" style="cursor: pointer;">Paslaugos</button></a>
            </div>
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







