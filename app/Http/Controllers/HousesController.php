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


    // create
    public function create()
    {
        return view('house.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'price' => 'required|min:6',
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

    // edit
    public function edit(House $house)
    {
        return view('house.edit', compact('house'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'price' => 'required|numeric|gte:100000|lte:400000',
            'surface' => 'required',
        ]);

        $house = House::find($id);
        $house->name = $request->name;
        $house->address = $request->address;
        $house->price = $request->price;
        $house->surface = $request->surface;
        $house->save();

        return $house;
    }

    // delete
    public function delete(House $house)
    {
        return view('house.delete', compact('house'));
    }

    public function destroy($id)
    {
        $house = House::find($id);
        $house->delete();
    }

    public function show($id)
    {
        $house = House::find($id);
        return view('house.delete', compact('house'));
    }

    public function duplicate(Request $request, $id)
    {
        $house = House::find($id);
        $newhouse = $house->replicate();
        $newhouse->save();
        return $this->index($request);
    }

}
