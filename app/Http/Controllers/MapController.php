<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;
use App\Fuel;

class MapController extends Controller
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
        $maps = Map::with('fuels')->orderBy('created_at', 'DESC')->get();
        return view('backend.map.maps', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-maps')) {
            $fuels = Fuel::orderBy('created_at', 'DESC')->get();
            return view('backend.map.add-map', compact('fuels'));
        } else {
            return redirect(route('map-info.index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fuel_id' => 'required',
            'title' => 'required',
            'info' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        $map = new Map();
        $map->fuel_id = $request->fuel_id;
        $map->title = $request->title;
        $map->info = $request->info;
        $map->lat = $request->lat;
        $map->lng = $request->lng;
        $map->save();
        toast('Successfully created the Map marker info', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('map-info.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('read-maps')) {
            $show = Map::where('id', $id)->first();
            return view('backend.map.show-map', compact('show'));
        } else {
            return redirect(route('map-info.index'));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-maps')) {
            $fuels = Fuel::orderBy('created_at', 'DESC')->get();
            $edit = Map::where('id', $id)->first();
            return view('backend.map.edit-map', compact('edit', 'fuels'));
        } else {
            return redirect(route('map-info.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fuel_id' => 'required',
            'title' => 'required',
            'info' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);
        $map = Map::find($id);
        $map->fuel_id = $request->fuel_id;
        $map->title = $request->title;
        $map->info = $request->info;
        $map->lat = $request->lat;
        $map->lng = $request->lng;
        $map->save();
        toast('Successfully updated Map Info', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('map-info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-maps')) {
            toast('Power plant Deleted Success!', 'success', 'top-right');
            $destroy = Map::find($id)->first();
            if ($destroy) {
                $destroy->delete();
                return redirect()->route('map-info.index');
            }
        } else {
            return redirect(route('map-info.index'));
        }
    }
}
