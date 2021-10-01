<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Validator;

class MechanicController extends Controller
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
    public function index()
    {
        $mechanics = Mechanic::all();
        return view('mechanic.index', ['mechanics' => $mechanics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mechanic.create');
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
           'mechanic_name' => ['required', 'min:3', 'max:64'],
           'mechanic_surname' => ['required', 'min:3', 'max:64'],
        ],
        [
        'mechanic_name.min' => 'To short name!',
        'mechanic_name.max' => 'To long name!',
        'mechanic_name.required' => 'Please enter the name',
        'mechanic_surname.min' => 'To short surname!',
        'mechanic_surname.max' => 'To long surname!',
        'mechanic_surname.required' => 'Please enter the surname',
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

      
        $mechanic = new Mechanic;



        if ($request->has('mechanic_portret')) {

            $portret = $request->file('mechanic_portret');
    
            $imageName = $request->mechanic_name.'_'.
            $request->mechanic_surname.'_'.
            time().'.'.
            $portret->getClientOriginalExtension(); 
    
            $path= public_path().'/portrets/'; //serverio vidinis kelias
    
            $url = asset('portrets/.$imageName');//url narsyklei (isorinis)
    
            $portret->move($path, $imageName); //is serverio tmp ===> i public folderi
    
            $mechanic->portret = $url;
           }



        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Success create!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        return view('mechanic.edit', ['mechanic' => $mechanic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        $validator = Validator::make($request->all(),
       [
           'mechanic_name' => ['required', 'min:3', 'max:64'],
           'mechanic_surname' => ['required', 'min:3', 'max:64'],
       ],
       
       [
            'mechanic_name.min' => 'To short name!',
            'mechanic_name.max' => 'To long name!',
            'mechanic_name.required' => 'Please enter the name',
            'mechanic_surname.min' => 'To short surname!',
            'mechanic_surname.max' => 'To long surname!',
            'mechanic_surname.required' => 'Please enter the surname',
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Success edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
        if($mechanic->mechanicTrucks->count()){
            return redirect()->route('mechanic.index')->with('info_message', 'Unable to delete!');
        }
        $mechanic->delete();
        return redirect()->route('mechanic.index')->with('success_message', 'Success deleted!');
    }
}
