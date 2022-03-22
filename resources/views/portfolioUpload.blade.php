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
            <input type="file" name="image" class="form-control" accept="image" required>
            @if ($errors->has('files'))
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
            @endif
        </div>
        <label class="label">Daiktas po perdarymą: </label>
        <div class="form-group">
            <input type="file" name="image2" class="form-control" accept="image" required>
            @if ($errors->has('files'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
            @endif
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" />
            <a href="{{ route('portfolioshow', $id) }}" class="btn btn-primary">Atgal</a>
        </div>
    </form>

                        </div>
                    </div>
            </div>
        </div>
    </div>



@endsection
