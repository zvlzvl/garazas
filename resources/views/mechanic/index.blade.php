@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   <h1>Mechanic List</h1>
               </div>
               <div class="card-body">
                @foreach ($mechanics as $mechanic)
                <div>
                    <div>
                        <h4>{{$mechanic->name}} {{$mechanic->surname}}</h4>
                    </div>
                    @if($mechanic->portret)
                    <div class="list-img">
                        <img src="{{$mechanic->portret}}" alt="{{$mechanic->name}} {{$mechanic->surname}}">
                    </div>
                    @else
                    <div class="list-img">
                        <img src="{{asset('portrets/person_blank.png')}}" alt="{{$mechanic->name}} {{$mechanic->surname}}">
                    </div>
                    @endif
                    
                </div>
                <form method="POST" action="{{route('mechanic.destroy', $mechanic)}}">
                 @csrf
                    <button type="submit"> <a href="{{route('mechanic.edit',[$mechanic])}}">EDIT</a></button>
                    <button type="submit">DELETE</button>
                </form>
                <div class="line">

                </div>
              @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

