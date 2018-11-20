<?php

namespace App\Http\Controllers;

use App\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
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
        $distributions = Distribution::orderBy('created_at', 'DESC')->get();
        return view('backend.distributions.distributions', compact('distributions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-distributions')) {
            return view('backend.distributions.add-distribution');
        } else {
            return redirect(route('distributions.index'));
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
            'name' => 'required',
            'demand' => 'required|numeric',
            'receive' => 'required|numeric',
        ]);
        $distribution = new Distribution();
        $distribution->name = $request->name;
        $distribution->demand = $request->demand;
        $distribution->receive = $request->receive;
        $distribution->save();
        toast('Successfully created the Distribution', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('distributions.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-distributions')) {
            $edit = Distribution::where('id', $id)->first();
            return view('backend.distributions.edit-distribution', compact('edit'));
        } else {
            return redirect(route('distributions.index'));
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
            'name' => 'required',
            'demand' => 'required|numeric',
            'receive' => 'required|numeric',
        ]);
        $distribution = Distribution::find($id);
        $distribution->name = $request->name;
        $distribution->demand = $request->demand;
        $distribution->receive = $request->receive;
        $distribution->save();
        toast('Successfully updated', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('distributions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-distributions')) {
            toast('Distribution Deleted Success!', 'success', 'top-right');
            $destroy = Distribution::where('id', $id)->first();
            if ($destroy) {
                $destroy->delete();
                return redirect()->route('distributions.index');
            }
        } else {
            return redirect(route('distributions.index'));
        }
    }
}
