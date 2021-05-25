<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use Validator;

class TruckController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $mechanics = Mechanic::all();

        $trucks = Truck::all();

        if ($request->mechanic_id) {
            $trucks = Truck::where('mechanic_id', $request->mechanic_id)->get();
            $mechanic_id = $request->mechanic_id;
        }
        else {
            $trucks = Truck::all();
            $mechanic_id = 0;
        }

        if($request->sort) {
            if('asc' == $request->order) {
                if('year' == $request->sort) {
                    $trucks= $trucks->sortBy('make_year');
                    $order ='asc';
                    $sort = 'year';
                }
                elseif('maker' == $request->sort) {
                    $trucks= $trucks->sortBy('maker');
                    $order ='asc';
                    $sort = 'maker';
                }
                elseif('mechanic_id' == $request->sort) {
                    $trucks= $trucks->sortBy('mechanic_id');
                    $order ='asc';
                    $sort = 'mechanic_id';
                }
            }
            if('desc' == $request->order) {
                if('year' == $request->sort) {
                    $trucks= $trucks->sortByDesc('make_year');
                    $order ='desc';
                    $sort = 'year';
                }
                elseif('maker' == $request->sort) {
                    $trucks= $trucks->sortByDesc('maker');
                    $order ='desc';
                    $sort = 'maker';
                }
                elseif('mechanic_id' == $request->sort) {
                    $trucks= $trucks->sortByDesc('mechanic_id');
                    $order ='desc';
                    $sort = 'mechanic_id';
                }
            }
        }




        return view('truck.index', [
            'trucks' => $trucks,
            'mechanics' => $mechanics,
            'order' => $order ?? '',
            'sort' => $sort ?? '',
            'mechanic_id' => $mechanic_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mechanics = Mechanic::all();
        return view('truck.create', ['mechanics' => $mechanics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'truck_maker' => ['required', 'max:255'],
            'truck_plate' => ['required', 'min:7', 'max:20'],
            'truck_make_year' => ['required', 'min:1800', 'integer', 'max:2021'],
            'truck_mechanic_notices' => ['required'],
            'mechanic_id' =>  ['required', 'integer', 'min:1'],
        ],
        [
            'truck_maker.required' => 'Please enter truck Maker!',
            'truck_maker.max' => 'To long truck Maker name!',
            'truck_plate.required' => 'Please enter truck Plate!',
            'truck_plate.min' => 'To short truck Plate!',
            'truck_plate.max' => 'To long truck Plate!',
            'truck_make_year.required' => 'Please enter truck make Year!',
            'truck_make_year.min' => 'Invalid truck make Year!',
            'truck_make_year.max' => 'Invalid truck make Year!',
            'truck_make_year.integer' => 'Invalid make Year!',
            'truck_mechanic_notices.required' => 'Please enter demages!',
            'mechanic_id.min' => 'Please, select the Mechanic',
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 

        $truck = new Truck;
        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Success created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $mechanics = Mechanic::all();
        return view('truck.edit', ['truck' => $truck, 'mechanics' => $mechanics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $validator = Validator::make($request->all(),
        [
            'truck_maker' => ['required', 'max:255'],
            'truck_plate' => ['required', 'min:7', 'max:20'],
            'truck_make_year' => ['required', 'min:1800', 'integer', 'max:2021'],
            'truck_mechanic_notices' => ['required'],
            'mechanic_id' =>  ['required', 'integer', 'min:1'],
        ],
        [
            'truck_maker.required' => 'Please enter truck Maker!',
            'truck_maker.max' => 'To long truck Maker name!',
            'truck_plate.required' => 'Please enter truck Plate!',
            'truck_plate.min' => 'To short truck Plate!',
            'truck_plate.max' => 'To long truck Plate!',
            'truck_make_year.required' => 'Please enter truck make Year!',
            'truck_make_year.min' => 'Such year truck does not exist!',
            'truck_make_year.max' => 'Truck make year cant not be older then 2021!',
            'truck_make_year.integer' => 'Truck make Year is an integer!',
            'truck_mechanic_notices.required' => 'Please enter demages!',
            'mechanic_id.min' => 'Please, select the Mechanic',
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
 

        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->truck_mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Success edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('truck.index')->with('success_message', 'Success deleted!');
    }
}
