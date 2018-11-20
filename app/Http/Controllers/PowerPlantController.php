<?php

namespace App\Http\Controllers;

use App\PowerPlant;
use App\Fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Backup;
use App\Temp;

class PowerPlantController extends Controller
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
        $powers = PowerPlant::with('fuels')->orderBy('created_at', 'DESC')->get();
        return view('backend.power.powers', compact('powers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-plants')) {
            $fuels = Fuel::orderBy('created_at', 'DESC')->get();
            return view('backend.power.add-power', compact('fuels'));
        } else {
            return redirect(route('powers.index'));
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
            'name' => 'required',
            'output' => 'required|numeric',
            'capability' => 'required|numeric'
        ]);
        $power = new PowerPlant();
        $power->fuel_id = $request->fuel_id;
        $power->name = $request->name;
        $power->output = $request->output;
        $power->capability = $request->capability;
        $power->plant_time = Carbon::now()->format('H:i:s');
        $power->plant_date = Carbon::now()->format('Y-m-d');
        $power->save();
        toast('Successfully created the new Power Plant', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('powers.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function edit(PowerPlant $power)
    {
        if (auth()->user()->can('update-plants')) {
            $fuels = Fuel::orderBy('created_at', 'DESC')->get();

            return view('backend.power.edit-power', compact('power', 'fuels'));
        } else {
            return redirect(route('powers.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PowerPlant $power)
    {
        $this->validate($request, [
            'fuel_id' => 'required',
            'name' => 'required',
            'output' => 'required|numeric',
            'capability' => 'required|numeric'
        ]);
        $power = PowerPlant::find($power->id);
        $power->name = $request->name;
        $power->fuel_id = $request->fuel_id;
        $power->output = $request->output;
        $power->capability = $request->capability;
        $power->plant_time = Carbon::now()->format('H:i:s');
        $power->plant_date = Carbon::now()->format('Y-m-d');
        $power->save();
        $this->BackUpData($request, $power);
        toast('Successfully updated', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('powers.index');
    }
    /**
     * function for backup table
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    protected function BackUpData($request, $power)
    {
        $time = Carbon::now()->format('H');
        $backups = Backup::whereDate('plant_date', Carbon::today())->get();
        $powerPlant = PowerPlant::where('fuel_id', $request->fuel_id)->sum('output');
        foreach ($backups as $backup) {
            $plant_time = Carbon::parse($backup->plant_time)->format('H');
        }
        if (empty($plant_time)) {
            $backup = new Backup();
            $backup->fuel_id = $request->fuel_id;
            $backup->total_output = $powerPlant;
            $backup->plant_time = Carbon::now()->format('H:i:s');
            $backup->plant_date = Carbon::now()->format('Y-m-d');
            $backup->save();
        } else {
            if ($plant_time == $time) {
                if ($backup->fuel_id == $request->fuel_id) {
                    $backup = Backup::find($backup->id)
                        ->update(
                            ['total_output' => $powerPlant]
                        );
                } else {
                    $backup = new Backup();
                    $backup->fuel_id = $request->fuel_id;
                    $backup->total_output = $powerPlant;
                    $backup->plant_time = Carbon::now()->format('H:i:s');
                    $backup->plant_date = Carbon::now()->format('Y-m-d');
                    $backup->save();
                }
            } else {
                $backup = new Backup();
                $backup->fuel_id = $request->fuel_id;
                $backup->total_output = $powerPlant;
                $backup->plant_time = Carbon::now()->format('H:i:s');
                $backup->plant_date = Carbon::now()->format('Y-m-d');
                $backup->save();
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-plants')) {
            toast('Power plant Deleted Success!', 'success', 'top-right');
            $destroy = PowerPlant::find($id)->first();
            if ($destroy) {
                $destroy->delete();
                return redirect()->route('powers.index');
            }
        } else {
            return redirect(route('powers.index'));
        }
    }
}
