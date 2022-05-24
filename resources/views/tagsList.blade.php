@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div style="text-align: center">
            <h4>
                Pinterest segtukų sąrašas
            </h4>
            <hr>
            <a href="{{url('/')}}" ><button class="btn btn-primary" >Atgal</button></a>
            <hr>
            @if ($message = Session::get('success'))
                <center>
                    <div style="width: 70%;height: 50px;text-align: center;" class="alert alert-success">
                        <span style="text-align: center">{{ $message }}</span>
                    </div>
                </center>
            @endif
        </div>
        <br>


        <div class="col-md-11 mt-60 mx-md-auto">
            <div style="-webkit-box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0);box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0);position: center" class="login-box bg-white pl-lg-5 pl-0">
                <div class="row no-gutters align-items-center">
        <div class="col-md-6">
            <div class="form-wrap bg-white">
                <h4 class="btm-sep pb-3 mb-5">Pinterest segtukų pridėjimas</h4>
            <form method="post" action="{{route('tagcreate')}}">
                @csrf
                <div class="col-12">
                    <div class="form-group position-relative">
                <strong>Pinterest segtukas: </strong>
                <input style="width: 70%;padding-left:10px;border: 1px solid #e1e1e1;-webkit-box-shadow: none;border-radius: 5px;-webkit-transition: all .3s ease;" size="15" name="newtag" type="text" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group position-relative">
                <strong>Kategorija: </strong>
                        <br>
                <select style="width: 70%; height: 30px;border: 1px solid #e1e1e1;-webkit-box-shadow: none;border-radius: 5px;-webkit-transition: all .3s ease;" name="kategorija">
                    <option value="">Pasirinkite kategorija</option>
                    @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                    </div>
                </div>
                <input style="height: 40px;width: 110px" class="btn3 btn-primary btn-xl" type="submit" value="Sukurti" />
            </form>
        </div>
        </div>
                </div>
            </div>
        </div>
        <div class="row py-5">
            <div class="col-lg-10 mx-auto">
                <div class="card rounded shadow border-0">
                    <div class="card-body p-5 bg-white rounded">
                        <div class="table-responsive">
                            <table id="example" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Pinterest segtuko pavadiniams(LT)</th>
                                    <th>Pinterest segtuko pavadiniams(EN)</th>
                                    <th>Kategorija</th>
                                    <th>Įsiminimų skaičius</th>
                                    <th style="width: 150px">Sukūrimo data</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->namelt}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->category->name}}</td>
                                    <td>{{$tag->like}}</td>
                                    <td>{{$tag->created_at->todatestring()}}</td>
                                    <td><a href="{{route('opentag', $tag->id)}}"><button style="height: 40px;width: 110px;" class="btn3 btn-primary btn-xl">Atidaryti</button></a></td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="" name="action" value='html' style="text-align: center">
                                <div class="bottom">
                                    {!! $tags->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
