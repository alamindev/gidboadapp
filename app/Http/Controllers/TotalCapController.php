<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TotalCap;

class TotalCapController extends Controller
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
            if (!TotalCap::count()) {
                if (auth()->user()->can('create-capacities')) {
                    return view('backend.total_cap.add-total-cap');
                } else {
                    return redirect(route('admin'));
                }
            } else {
                if (auth()->user()->can('update-capacities')) {
                    $edit = TotalCap::first();
                    return view('backend.total_cap.edit-total-cap', compact('edit'));
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
        if (auth()->user()->can('update-capacities')) {
            $this->validate($request, [ 
                'info_pie' => 'required',
                'supply_mix' => 'required',
            ]);
            $capacity = new TotalCap(); 
            $capacity->info_pie = $request->info_pie;
            $capacity->supply_mix = $request->supply_mix;
            $capacity->save();
            toast('Successfully created Total Capacity', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('total-capacity.index');
        } else {
            return redirect(route('total-capacity.index'));
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
            'info_pie' => 'required',
            'supply_mix' => 'required',
        ]);
        $capacity = TotalCap::find($id); 
        $capacity->info_pie = $request->info_pie;
        $capacity->supply_mix = $request->supply_mix;
        $capacity->save();
        toast('Updated Total Capacity Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('total-capacity.index');
    }
}
