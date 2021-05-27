@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                    <h1>Trucks List</h1>
                    <form class="fieldset" action="{{route('truck.index')}}" method="GET"> 
                        {{-- prideti route --}}
                        <fieldset class="sort">
                            <legend>Sort by:</legend>
                                <div class="inputs">
                                    <label for="_1">Year</label>
                                    <input name="sort" type="radio" value="year" @if ($sort == 'year') checked @endif id="_1">

                                    <label for="_2">Maker</label>
                                    <input name="sort" type="radio" value="maker" @if ($sort == 'maker') checked @endif id="_2">

                                    <label for="_3">Mechanic_id</label>
                                    <input name="sort" type="radio" value="mechanic_id" @if ($sort == 'mechanic_id') checked @endif id="_3">
                                </div>
                                <div class="inputs"> 
                                    <label for="_4">Up to down</label>
                                    <input name="order" type="radio" value="asc" @if ($order == ''|| $order =='asc') checked @endif id="_4">

                                    <label for="_5">Down to up</label>
                                    <input name="order" type="radio" value="desc" @if ($order == 'desc') checked @endif  id="_5">
                                </div>
                            </fieldset>
                                <fieldset class="sort">
                                <legend>Filter by:</legend>
                                <div class="inputs">
                                    <select class="form-select" name="mechanic_id">
                                        <option value="0">Select Mechanic</option>
                                         @foreach ($mechanics as $mechanic)
                                        <option value="{{$mechanic->id}}" @if($mechanic_id == $mechanic->id) selected @endif>
                                            {{$mechanic->name}} {{$mechanic->surname}}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>   
                            </fieldset>
                        

                    <button>SORT</button>
                    <button><a href="{{route('truck.index')}}">RESET</a></button>
                    </form>


                </div>

               <div class="card-body">
                @forelse ($trucks as $truck)
                <h4>{{$truck->maker}}</h4>
                <h6>Mechanic: {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}} ID: {{$truck->mechanic_id}}</h6>
                <span>{{$truck->make_year}}</span>
                <form method="POST" action="{{route('truck.destroy', [$truck])}}">
                 @csrf
                 <button type="submit"><a href="{{route('truck.edit',[$truck])}}">EDIT</a></button>
                 <button type="submit">DELETE</button>
                </form>
                <br>

                @empty
                <div>No trucks</div>
              @endforelse
               </div>
           </div>
       </div>
   </div>
</div>
@endsection



