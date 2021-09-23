<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use Validator;
use Redirect;

class HousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        return view('house.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'price' => 'required',
            'surface' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::to('houses/create')->withInput()->withErrors($validator);
        }
        if (isset($request->id)) {
            $house = House::find($request->id);
        } else {
            $house = new House;
        }
        $house->name = $request->name;
        $house->address = $request->address;
        $house->price = $request->price;
        $house->surface = $request->surface;
        $house->save();
        $houses = House::all();
        return view('house.index', compact('houses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $house = House::find($id);

        return view('house.edit', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    public function edit(Houses $houses)
    {
        dd("heyyy2");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd("heyyy2");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Houses  $houses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::find($id);
        $house->delete();

        $houses = House::all();
        return view('house.index', compact('houses'));
    }
}
