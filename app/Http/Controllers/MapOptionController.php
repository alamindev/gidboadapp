<?php

namespace App\Http\Controllers;

use App\MapOption;
use Illuminate\Http\Request;

class MapOptionController extends Controller
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
        try {
            if (!MapOption::count()) {
                if (auth()->user()->can('create-options')) {
                    return view('backend.map-options.map-options');
                } else {
                    return redirect(route('admin'));
                }
            } else {
                if (auth()->user()->can('update-options')) {
                    $edit = MapOption::first();
                    return view('backend.map-option.edit-map-options', compact('edit'));
                } else { 
                    return redirect(route('admin'));
                }
            }
        } catch (Exception $x) {
            return 'there are some problem';
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
        if (auth()->user()->can('update-options')) {
            $this->validate($request, [
                'api_key' => 'required',
                'zoom' => 'required',
                'lat' => 'required',
                'lng' => 'required'
            ]);
            $MapOption = new MapOption();
            $MapOption->api_key = $request->api_key;
            $MapOption->zoom = $request->zoom;
            $MapOption->lat = $request->lat;
            $MapOption->lng = $request->lng;
            $MapOption->save();
            toast('Successfully created Map Options', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('map-option.index');
        } else {
            return redirect(route('map-option.index'));
        }
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MapOption  $mapOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'api_key' => 'required',
            'zoom' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);
        $MapOption = MapOption::find($id);
        $MapOption->api_key = $request->api_key;
        $MapOption->zoom = $request->zoom;
        $MapOption->lat = $request->lat;
        $MapOption->lng = $request->lng;
        $MapOption->save();
        toast('Updated Map Options Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('map-option.index');
    }
}
