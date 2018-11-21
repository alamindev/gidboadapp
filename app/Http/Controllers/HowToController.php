<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HowTo;

class HowToController extends Controller
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
            if (!HowTo::count()) {
                if (auth()->user()->can('create-howtos')) {
                    return view('backend.howto.add-howto');
                } else {
                    return redirect(route('admin'));
                }
            } else {
                if (auth()->user()->can('update-howtos')) {
                    $edit = HowTo::first();
                    return view('backend.howto.edit-howto', compact('edit'));
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
        if (auth()->user()->can('update-howtos')) {
            $this->validate($request, [ 
                'help' => 'required',
                'about' => 'required',
            ]);
            $capacity = new HowTo();
            $capacity->help = $request->help; 
            $capacity->about = $request->about; 
            $capacity->save();
            toast('Successfully Created', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('howtos.index');
        } else {
            return redirect(route('howtos.index'));
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
            'help' => 'required',
            'about' => 'required',
        ]);
        $capacity = HowTo::find($id);
        $capacity->help = $request->help; 
        $capacity->about = $request->about; 
        $capacity->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('howtos.index');
    }
}
