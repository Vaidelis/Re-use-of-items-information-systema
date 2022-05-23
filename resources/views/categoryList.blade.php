@extends('layouts.app')

@section('content')
    <div style="text-align: center">
        <h4>
            Kategorijų sąrašas
        </h4>
        <hr>
        <a href="{{url('/')}}" ><button class="btn btn-primary" >Atgal</button></a>
        <hr>
    </div>
    <div class="container">
        <div>
            <form method="post" action="{{route('catcreate')}}">
                @csrf
                <input size="15" name="newcat" type="text" required>
                <input type="submit" value="Sukurti" />
            </form>

        </div>
<div class="form-group">
    <table class="content-table">
        <thead>
        <th>Kategorijos pavadinimas</th>
        </thead>
        <tbody>
        @foreach($cats as $cat)
            <tr>
            <td>{{$cat->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


        </div>
    </div>

@endsection

