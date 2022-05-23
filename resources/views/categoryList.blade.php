@extends('layouts.app')

@section('content')
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

