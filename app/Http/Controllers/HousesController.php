<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class HousesController extends Controller
{

    public function data(Request $request)
    {
        $data = new House;
        $count = $data->count();
        if (strlen($request->filter) > 0){
            $data = $data->where('name', 'like', '%' . $request->filter . '%');
        }
        if ($request['sortby'] != '' && $request['sortby'] != 'null') {
            $data = $data->orderBy($request['sortby'], $request['sortdesc'] == 'false' ? 'asc' : 'desc');
        }
        $data = $data->offset(($request['page'] - 1) * $request['size'])->limit($request['size']);
        $countWhere = $data->count();

        return response()->json([
            'data' => $data->get(),
            'count' => $count,
            'countWhere' => $countWhere
        ]);
        /* $houses = new House;
        if ($request->filter) {
            $houses = $houses->where('name', 'LIKE', "%".$request->filter."%")->orWhere('address', 'LIKE', "%".$request->filter."%");
        }
        $houses = $houses->limit($request->size)->offset(0);

        return $houses->get(); */
    }

    public function index(Request $request)
    {
        $houses = House::all();
        return view('house.index', compact('houses'));
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

    public function deleteselected(Request $request)
    {
        House::destroy($request->ids);
    }

    public function duplicate(Request $request, $id)
    {
        $house = House::find($id);
        $newhouse = $house->replicate();
        $newhouse->save();
        return $this->index($request);
    }

}
