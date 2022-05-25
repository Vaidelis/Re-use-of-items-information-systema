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
            <table style="width: 31%" class="content-table">
                <tbody>
                <td>
                    <form method="post" action="{{route('catcreate')}}">
                        @csrf
                        <strong>Kategorijos pavadinimas: </strong>
                        <br>
                        <input style="width: 65%;padding-left:10px;border: 1px solid #e1e1e1;-webkit-box-shadow: none;border-radius: 5px;-webkit-transition: all .3s ease;" size="15" name="newcat" type="text" required>
                        <input style="height: 40px;width: 100px" class="btn3 btn-primary btn-xl" type="submit" value="Sukurti" />
                    </form>
                </td>
                </tbody>
            </table>


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

