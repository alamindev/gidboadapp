<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PowerInfo;
use App\PowerPlant;
use Image;

class PowerInfoController extends Controller
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
        $power_infos = PowerInfo::orderBy('created_at', 'DESC')->get();
        return view('backend.power-info.power-infos', compact('power_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if (auth()->user()->can('create-infos')) {
            $id = $id;
            $info = powerInfo::where('power_id', $id)->select('power_id')->first();
            if ($info) {
                toast('ERROR! Power info added for the powerplant', 'error', 'top-right')->autoClose(5000);
                return redirect()->route('power-info.index');
            } else {
                $powerinfo = powerInfo::pluck('power_id')->toArray();
                $powers = PowerPlant::orderBy('created_at', 'DESC')->whereNotIn('id', $powerinfo)->get();
                return view('backend.power-info.add-power-info', compact('powers', 'id'));
            }

        } else {
            return redirect(route('power-info.index'));
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
            'power_id' => 'required',
            'info' => 'required',
            'map_lat' => 'required|numeric',
            'map_lng' => 'required|numeric',
            'marker_lat' => 'required|numeric',
            'marker_lng' => 'required|numeric',
            'zoom' => 'required|numeric',
        ]);
        $fileName = $this->logoUpload($request);

        $power_info = new PowerInfo();
        $power_info->power_id = $request->power_id;
        $power_info->info = $request->info;
        $power_info->map_lat = $request->map_lat;
        $power_info->map_lng = $request->map_lng;
        $power_info->marker_lat = $request->marker_lat;
        $power_info->marker_lng = $request->marker_lng; 
        $power_info->zoom = $request->zoom; 
        $power_info->logo = $fileName ? $fileName : 'photo';
        $power_info->address = $request->address;
        $power_info->email = $request->email;
        $power_info->phone = $request->phone;
        $power_info->fax = $request->fax; 
        $power_info->twitter = $request->twitter;
        $power_info->youtube = $request->youtube;
        $power_info->facebook = $request->facebook;
        $power_info->website = $request->website;
        $power_info->save();
        toast('Successfully created the power information', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('power-info.index');
    }
    public function logoUpload($request)
    {
        if ($request->hasFile('logo')) {
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_power_info_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/power_info/' . $fileName);
            return $fileName;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('read-infos')) {
            $show = PowerInfo::where('id', $id)->first();
            return view('backend.power-info.show-power-info', compact('show'));
        } else {
            return redirect(route('power-info.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-infos')) {
            $edit = PowerInfo::where('id', $id)->first();
            $powers = PowerPlant::orderBy('created_at', 'DESC')->get();
            return view('backend.power-info.edit-power-info', compact('edit', 'powers'));
        } else {
            return redirect(route('power-info.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'info' => 'required',
            'map_lat' => 'required|numeric',
            'map_lng' => 'required|numeric',
            'marker_lat' => 'required|numeric',
            'marker_lng' => 'required|numeric',
            'zoom' => 'required|numeric',
        ]);
        $fileName = $this->logoUpdate($request, $id);

        $power_info = PowerInfo::find($id);
        $power_info->info = $request->info;
        $power_info->map_lat = $request->map_lat;
        $power_info->map_lng = $request->map_lng;
        $power_info->marker_lat = $request->marker_lat;
        $power_info->marker_lng = $request->marker_lng; 
        $power_info->zoom = $request->zoom; 
        $power_info->logo = $fileName;
        $power_info->address = $request->address;
        $power_info->email = $request->email;
        $power_info->phone = $request->phone;
        $power_info->fax = $request->fax; 
        $power_info->twitter = $request->twitter;
        $power_info->youtube = $request->youtube;
        $power_info->facebook = $request->facebook;
        $power_info->website = $request->website;
        $power_info->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('power-info.index');
    }
    public function logoUpdate($request, $id)
    {
        $power_info = PowerInfo::where('id', $id)->first();
        if ($request->hasFile('logo')) {
            $file_path = $user->logo;
            $storage_path = 'uploads/power_info/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_power_info_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/power_info/' . $fileName);
        } else {
            $fileName = $power_info['logo'];
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
        if (auth()->user()->can('create-infos')) {
            toast('Power information Deleted Success!', 'success', 'top-right');
            $destroy = PowerInfo::find($id)->first();
            if ($destroy) {
                $file_path = $destroy->logo;
                $storage_path = 'uploads/power_info/' . $file_path;
                if (\File::exists($storage_path)) {
                    unlink($storage_path);
                }
                $destroy->delete();
                return redirect()->route('power-info.index');
            }
        } else {
            return redirect(route('power-info.index'));
        }
    }
}