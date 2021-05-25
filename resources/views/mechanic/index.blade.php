@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Mechanic List</div>

               <div class="card-body">
                @foreach ($mechanics as $mechanic)

                <h6>{{$mechanic->name}} {{$mechanic->surname}}</h6>
                <form method="POST" action="{{route('mechanic.destroy', $mechanic)}}">
                 @csrf
                 <button type="submit"> <a href="{{route('mechanic.edit',[$mechanic])}}">EDIT</a></button>
                 <button type="submit">DELETE</button>
                </form>
                <br>
              @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

