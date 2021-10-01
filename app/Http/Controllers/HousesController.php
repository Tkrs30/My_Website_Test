<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class HousesController extends Controller
{

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

    public function create()
    {
        return view('house.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'price' => 'required',
            'surface' => 'required',
        ]);

        $house = new House;
        $house->name = $request->name;
        $house->address = $request->address;
        $house->price = $request->price;
        $house->surface = $request->surface;
        $house->save();

        return $house;
    }

    public function edit(House $house)
    {
        return view('house.edit', compact('house'));
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

    public function duplicate($id)
    {
        $house = House::find($id);
        $sortby = 'surfacedown';

        $newhouse = $house->replicate();

        $newhouse->save();

        return view('house.edit', compact('house', 'sortby'));
    }

    public function show($id)
    {
        return House::find($id);
    }

    public function destroy($id)
    {
        $house = House::find($id);
        $house->delete();

        return Redirect::to('/houses');
    }

}
