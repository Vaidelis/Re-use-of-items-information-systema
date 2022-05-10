@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Patvirtinti daikto perdarymą</div>
                    <div class="card-body">


    <form method="post" action="{{route('storeportfolio', ['id' => $id, 'id2' => $id2])}}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf

            <label class="label">Daikto pavadinimas: </label>
            <input placeholder="Daikto pavadinimas" type="text" name="postname" class="form-control" required/>
        </div>
        <label class="label">Daiktas prieš perdarymą: </label>
        <div class="form-group">
            <label>
                <img style="height: 50px; width: 50px" src="/img/picture.svg.png">
            <input type="file" name="image" style="display: none" class="form-control" accept="image/*" onchange="loadFile(event)" required>
            @if ($errors->has('files'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
            @endif
            </label>
            <img src="/img/noimg.jpg" id="output" style="width: 200px; height: 200px; object-fit: cover;"/>
        </div>
        <label class="label">Daiktas po perdarymą: </label>
        <div class="form-group">
            <label>
                <img style="height: 50px; width: 50px" src="/img/picture.svg.png">
            <input type="file" name="image2" style="display: none" class="form-control" accept="image/*" onchange="loadFile2(event)" required>
            @if ($errors->has('files'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
            @endif
            </label>
            <img src="/img/noimg.jpg" id="output2" style="width: 200px; height: 200px; object-fit: cover;"/>
        </div>
        <div class="form-group">
            <input value="Įkelti" type="submit" class="btn btn-success" />
            <a href="{{ route('portfolioshow', $id) }}" class="btn btn-primary">Atgal</a>
        </div>
    </form>

                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFile2 = function(event) {
            var image = document.getElementById('output2');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

@endsection
