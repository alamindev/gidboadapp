<?php

namespace App\Http\Controllers;

use App\Fuel;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class FuelController extends Controller
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
        $fuels = Fuel::orderBy('created_at', 'DESC')->get();
        return view('backend.fuel.fuels', compact('fuels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-fuels')) {
            return view('backend.fuel.add-fuel');
        } else {
            return redirect(route('fuels.index'));
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
            'total' => 'required|numeric',
            'bg_color' => 'required',
            'logo' => 'required',
            'map_icon' => 'required',
            'install_cap' => 'required',
            'install_date' => 'required'
        ]);
        $mapIcon = $this->MapIcon($request);
        $fileName = $this->logoUpload($request);

        $fuel = new Fuel();
        $fuel->name = $request->name;
        $fuel->total = $request->total;
        $fuel->bg_color = $request->bg_color;
        $fuel->install_cap = $request->install_cap;
        $fuel->install_date = Carbon::parse($request->install_date)->format('Y-m-d');
        $fuel->logo = $fileName;
        $fuel->map_icon = $mapIcon;
        $fuel->save();
        toast('Successfully created the new fuel', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('fuels.index');
    }
    public function logoUpload($request)
    {
        if ($request->hasFile('logo')) {
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_logo_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/fuel/' . $fileName);
            return $fileName;
        }
    }
    public function MapIcon($request)
    {
        if ($request->hasFile('map_icon')) {
            $picture = $request->file('map_icon');
            $images = Image::make($picture);
            $fileName = pathinfo('_map_icon_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/fuel/' . $fileName);
            return $fileName;
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('update-fuels')) {
            $show = Fuel::where('id', $id)->first();
            return view('backend.fuel.show-fuel', compact('show'));
        } else {
            return redirect(route('fuels.index'));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel $fuel)
    {
        if (auth()->user()->can('update-fuels')) {
            return view('backend.fuel.edit-fuel', compact('fuel'));
        } else {
            return redirect(route('fuels.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel $fuel)
    {
        $this->validate($request, [
            'total' => 'required|numeric',
            'name' => 'required',
            'bg_color' => 'required',
            'install_cap' => 'required',
            'install_date' => 'required',
        ]);
        $fileName = $this->logoUpdate($request, $fuel);
        $map_icon = $this->MapIconUpdate($request, $fuel);

        $fuel = Fuel::find($fuel->id);
        $fuel->name = $request->name;
        $fuel->total = $request->total;
        $fuel->bg_color = $request->bg_color;
        $fuel->install_cap = $request->install_cap;
        $fuel->install_date = Carbon::parse($request->install_date)->format('Y-m-d');
        $fuel->logo = $fileName;
        $fuel->map_icon = $map_icon;
        $fuel->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('fuels.index');
    }
    public function logoUpdate($request, $fuel)
    {
        $fuel = Fuel::where('id', $fuel->id)->first();
        if ($request->hasFile('logo')) {
            $file_path = $fuel->logo;
            $storage_path = 'uploads/fuel/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_fuel_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/fuel/' . $fileName);
        } else {
            $fileName = $fuel['logo'];
        }
        return $fileName;
    }
    public function MapIconUpdate($request, $fuel)
    {
        $fuel = Fuel::where('id', $fuel->id)->first();
        if ($request->hasFile('map_icon')) {
            $file_path = $fuel->map_icon;
            $storage_path = 'uploads/fuel/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('map_icon');
            $images = Image::make($picture);
            $fileName = pathinfo('_map_icon_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/fuel/' . $fileName);
        } else {
            $fileName = $fuel['map_icon'];
        }
        return $fileName;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-fuels')) {
            toast('Fuel Type Deleted Success!', 'success', 'top-right');
            $destroy = Fuel::find($id)->first();
            if ($destroy) {
                $file_path = $destroy->logo;
                $map_icon = $destroy->map_icon;
                $storage_path = 'uploads/fuel/' . $file_path;
                $map_icon = 'uploads/fuel/' . $map_icon;
                if (\File::exists($storage_path)) {
                    unlink($storage_path);
                }
                if (\File::exists($map_icon)) {
                    unlink($map_icon);
                }
                $destroy->delete();
                return redirect()->route('fuels.index');
            }
        } else {
            return redirect(route('fuels.index'));
        }
    }
}