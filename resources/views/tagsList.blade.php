@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div style="text-align: center">
            <h4>
                Pinterest segtukų sąrašas
            </h4>
            <hr>
            <a href="{{route('taglist')}}" ><button class="btn btn-primary" >Atgal</button></a>
            <hr>
        </div>

        <div>
            <form method="post" action="{{route('tagcreate')}}">
                @csrf
                <input size="15" name="newtag" type="text" required>
                <strong>Kategorija</strong>
                <select name="kategorija">
                    <option value="">Pasirinkite kategorija</option>
                    @foreach($cats as $cat)
                        <option name="category" value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <input type="submit" value="Sukurti" />
            </form>

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
                                    <td><a href="{{route('opentag', $tag->id)}}"><button>Atidaryti</button></a></td>
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
