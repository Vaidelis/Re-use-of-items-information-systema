@extends('layouts.app')

@section('content')

 <div class="container">
     <table class="content-table">
         <thead>
         <th>Kažkas</th>
         <th>sd</th>
         </thead>
         <tbody>
        @foreach($result as $resul)
            @if(class_basename($result) == "Item")
            <tr>
                <td>
                    {{$resul->name}}
                </td>
            </tr>
             @else
                <tr><td>{{$resul->name}}</td></tr>
                @endif
     @endforeach
         </tbody>
     </table>
 </div>

@endsection
