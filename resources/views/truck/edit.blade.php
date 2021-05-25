@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit truck</div>

               <div class="card-body">
                <form method="POST" action="{{route('truck.update',[$truck])}}">
                    <div class="form-group">
                        <label>Maker</label>
                        <input type="text" class="form-control" name="truck_maker" value="{{old('truck_maker',$truck->maker)}}">
                        <small class="form-text text-muted">Truck maker</small>
                    </div>

                    <div class="form-group">
                        <label>Plate</label>
                        <input type="text" class="form-control" name="truck_plate" value="{{old('truck_plate',$truck->plate)}}">
                        <small class="form-text text-muted">Truck plate</small>
                    </div>

                    <div class="form-group">
                        <label>Make year</label>
                        <input type="text" class="form-control" name="truck_make_year" value="{{old('truck_make_year',$truck->make_year)}}">
                        <small class="form-text text-muted">Truck make year</small>
                    </div>

                    <div class="form-group">
                        <label>Mechanic Notices:</label><br>
                        <textarea name="truck_mechanic_notices" id="summernote">{{old('truck_mechanic_notices',$truck->mechanic_notices)}}</textarea>
                        <small class="form-text text-muted">Mechanics comments about truck</small>
                    </div>

                    <div class="form-group">
                        <label>Mechanic</label>
                        <select class="form-select" name="mechanic_id">
                            <option value="0">Select Mechanic</option>
                             @foreach ($mechanics as $mechanic)
                            <option value="{{$mechanic->id}}" @if($mechanic->id == old('mechanic_id',$truck->mechanic_id)) selected @endif> {{$mechanic->name}} {{$mechanic->surname}}</option>
                        @endforeach
                        </select>
                    </div>
                   
                     
                    @csrf
                    <button type="submit">EDIT</button>
                </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
    </script>
@endsection


