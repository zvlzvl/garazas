@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Mechanic</div>

               <div class="card-body">
                <form method="POST" action="{{route('mechanic.update',$mechanic)}}">
                    Name: <input type="text" name="mechanic_name" value="{{old('mechanic_name',$mechanic->name)}}">
                    Surname: <input type="text" name="mechanic_surname" value="{{old('mechanic_surname',$mechanic->surname)}}">
                    @csrf
                    <button type="submit">EDIT</button>
                 </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

