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
    public function index(Request $request)
    {
        $houses = House::all();
        $sortby = 'surfacedown';
        if (isset($request->sort)) {
            $sortby = $request->sort;
            if ($sortby == 'surfaceup') {
                $houses = House::orderBy('surface', 'DESC', 'id', 'DESC')->get();
            } else {
                $houses = House::orderBy('surface', 'ASC', 'id', 'DESC')->get();
            }
        } else {
            $houses = House::orderBy('surface', 'ASC', 'id', 'DESC')->get();
        }
        return view('house.index', compact('houses', 'sortby'));
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
        $sortby = 'surfacedown';
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
        return view('house.index', compact('houses', 'sortby'));
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
    public function duplicate($id)
    {
        $house = House::find($id);
        $sortby = 'surfacedown';

        $newhouse = $house->replicate();

        $newhouse->save();

        return view('house.edit', compact('house', 'sortby'));
    }

    public function update(Request $request, $id)
    {
        $sortby = 'surfacedown';
        $house = House::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'price' => 'required',
            'surface' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::to("houses/$id")->withInput()->withErrors($validator);
        }
        $house->name = $request->name;
        $house->address = $request->address;
        $house->price = $request->price;
        $house->surface = $request->surface;
        $house->save();
        return Redirect::to('houses');
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

        return Redirect::to('/houses');
    }
}
