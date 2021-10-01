@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Mechanic</div>

               <div class="card-body">
                <form method="POST" action="{{route('mechanic.update',$mechanic)}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="mechanic_name" value="{{old('mechanic_name',$mechanic->name)}}" placeholder="Mechanic name">
                        {{-- <small class="form-text text-muted">Mechanic name</small> --}}
                    </div>

                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" name="mechanic_surname" value="{{old('mechanic_surname',$mechanic->surname)}}" placeholder="Mechanic surname">
                        {{-- <small class="form-text text-muted">Mechanic surname</small> --}}
                    </div>
                    <div class="form-group">
                        <label>Portret</label>
                        <input type="file" name="mechanic_portret" class="form-control" value="{{old('mechanic_portret', $mechanic->portret)}}" placeholder="Mechanic portret">
                        {{-- <small class="form-text text-muted">Mechanic portret</small> --}}
                    </div>
                     @csrf
                     <button type="submit" class="btn btn-primary">SAVE</button>
                  </form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection

