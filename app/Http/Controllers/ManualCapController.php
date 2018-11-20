<?php

namespace App\Http\Controllers;

use App\ManualCap;
use Illuminate\Http\Request;

class ManualCapController extends Controller
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
        $manuals = ManualCap::orderBy('created_at', 'DESC')->get();
        return view('backend.manual.manuals', compact('manuals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!ManualCap::count()) {
            if (auth()->user()->can('create-manuals')) {
                return view('backend.manual.add-manual');
            } else {
                return redirect(route('manuals.index'));
            }
        } else {
            return redirect(route('manuals.index'));
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
            'national_demand' => 'required',
            'available_capacity' => 'required',
            'transmission_capacity' => 'required',
        ]);
        $manual = new ManualCap();
        $manual->national_demand = $request->national_demand;
        $manual->available_capacity = $request->available_capacity;
        $manual->transmission_capacity = $request->transmission_capacity;
        $manual->save();
        toast('Successfully created', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('manuals.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\manual  $manual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-manuals')) {
            $edit = ManualCap::where('id', $id)->first();
            return view('backend.manual.edit-manual', compact('edit'));
        } else {
            return redirect(route('manuals.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\manual  $manual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManualCap $manual)
    {
        $this->validate($request, [
            'national_demand' => 'required',
            'available_capacity' => 'required',
            'transmission_capacity' => 'required',
        ]);

        $manual = ManualCap::find($manual->id);
        $manual->national_demand = $request->national_demand;
        $manual->available_capacity = $request->available_capacity;
        $manual->transmission_capacity = $request->transmission_capacity;
        $manual->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('manuals.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\manual  $manual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-manuals')) {
            toast('Deleted Success!', 'success', 'top-right');
            $destroy = ManualCap::find($id)->first();
            if ($destroy) {
                $destroy->delete();
                return redirect()->route('manuals.index');
            }
        } else {
            return redirect(route('manuals.index'));
        }
    }
}
