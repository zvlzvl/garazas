

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                   <h1>New Mechanic</h1>
                </div>
               <div class="card-body">
                 <form method="POST" action="{{route('mechanic.store')}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="mechanic_name" class="form-control" value="{{old('mechanic_name')}}" placeholder = "Mechanic name">
                    </div>

                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" name="mechanic_surname" class="form-control" value="{{old('mechanic_surname')}}" placeholder = "Mechanic surname">
                    </div>
                    <div class="form-group">
                        <label>Portret</label>
                        <input type="file" name="mechanic_portret" class="form-control" value="{{old('mechanic_portret')}}" placeholder = "Mechanic portret">
                    </div>
                     @csrf
                     <button type="submit" class="btn btn-primary">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


