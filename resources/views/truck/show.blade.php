@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h1>{{$truck->type}}</h1></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Maker: {{$truck->maker}}</li>
                            <li class="list-group-item">Plate: {{$truck->plate}}</li>
                            <li class="list-group-item">Make year: {{$truck->make_year}}</li>
                            <li class="list-group-item">Mechanic notices: {!!$truck->mechanic_notices!!}</li>
                            <li class="list-group-item">Mechanic: {{$truck->truckMechanic->name}} {{$truck->truckMechanic->surname}}</li>
                        </ul>
                        <br>
                        <button><a href="{{route('truck.edit',[$truck])}}">Edit</a></button>
                        <button><a href="{{route('truck.pdf',[$truck])}}">Save as PDF</a></button>
                         

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection