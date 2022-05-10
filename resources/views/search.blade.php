@extends('layouts.app')

@section('content')

    <body>
    <div class="container" style="margin-bottom: 20px">

        <center>
            <div class="container">
                <h4 class="">Skelbimų sąrašas</h4>

                <hr>
                <a href="{{ url('/') }}"><button class="btn3 btn-primary btn-xl" style="cursor: pointer;">Atgal</button></a>
            </div>

        </center>
        <hr>
        <div class="container">
            <table style="margin-top: -10px;margin-left: 60px" class="content-table">

                <thead>
                <th>Paieška pagal kategorijas</th>
                </thead>
                <form action="{{route('searchitemsservices')}}">
                    <tbody>
                    <?php $smth = 0; ?>
            @foreach($cats as $cat)
                <?php $smth = 0; ?>
                @foreach($countitem as $ci)
                    @if($cat->categorys_id == $ci->categorys_id && $loop->count > $smth)
                        <?php $smth++; ?>
                <tr>
                    <td><input type="radio" class="single-checkbox" name="searchcat" value="{{$cat->category->id}}"> {{$cat->category->name}} (Daiktai - ({{$ci->count}})

                        @break
                    @endif
                @endforeach
                        @foreach($countservice as $cs)
                            @if($cat->categorys_id == $cs->categorys_id)
                                (Paslaugos - ({{$cs->count}})
                        </td>
                </tr>
                @endif
                @endforeach
            @endforeach
            <tr><td><button class="btn3 btn-primary">Ieškoti</button></td></tr>

                    </tbody>

                </form>
            </table>
        </div>

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
        @foreach($result as $resul)
            @if(class_basename($resul) == "Item")
                <?php $smth = 0;?>
                @foreach($images as $image)
                    @if($resul->hide == 0 && $resul->id == $image->item->id && $smth == 0)
                        <?php $smth++; ?>
            <tr>
                <td> <img class="img-fluid" src="{{asset($image->path)}}" alt="{{ $image->path }}" style="width: 100px; height: 100px; object-fit: cover;" /> </td>
                <td>{{$resul->name}}</td>
                <td>{{$resul->price}}</td>
                <td>
                    <a href="{{route('itemshow', $resul->id)}}">
                        <button class="btn btn-primary btn3">Pasirinkti</button>
                    </a>
                </td>
            </tr>
                        @endif
                        @endforeach
                @endif
     @endforeach
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
             @foreach($result as $resul)
                 @if(class_basename($resul) == "Service" && $resul->hide == 0)
                     <tr>
                         <td>{{$resul->name}}</td>
                         <td>{{$resul->price}}</td>
                         <td>
                             <a href="{{route('serviceshow', $resul->id)}}">
                                 <button class="btn btn-primary btn3">Pasirinkti</button>
                             </a>
                         </td>
                     </tr>
                 @endif
             @endforeach  <tbody>


             </tbody>
         </table>
     </div>
 </div>

    </div>
    </body>
@endsection
