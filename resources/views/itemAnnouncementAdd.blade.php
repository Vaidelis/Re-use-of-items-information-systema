@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Sukurti daikto skelbimą</div>
                    <div class="card-body">
                        <form method="post" action="{{route('storeitem')}}" enctype="multipart/form-data">
                            <div class="form-group">
                                @csrf
                                <label class="label">Skelbimo pavadinimas: </label>
                                <input placeholder="Skelbimo pavadinimas" type="text" name="name" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label class="label">Skelbimo kaina: </label>
                                <input placeholder="Skelbimo kaina" type="number" name="price" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label class="label">Adresas: </label>
                                <input placeholder="Adresas"  type="text" name="address" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label class="label">Informacija: </label>
                                <input placeholder="Informacija apie daiktą" type="text" name="info" class="form-control" required/>
                            </div>


                            <div class="form-group">
                                <input type="file" name="images[]" multiple class="form-control" accept="image/*" required>
                                @if ($errors->has('files'))
                                    @foreach ($errors->get('files') as $error)
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
                                    @endforeach
                                @endif
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                                <a href="{{ route('personalAnn') }}" class="btn btn-primary">Atgal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
