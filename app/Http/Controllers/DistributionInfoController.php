<?php

namespace App\Http\Controllers;

use App\DistributionInfo;
use Illuminate\Http\Request; 
use App\Distribution;
use Image;
class DistributionInfoController extends Controller
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
        $distributions = DistributionInfo::orderBy('created_at', 'DESC')->get();
        return view('backend.distribution-info.distribution-infos', compact('distributions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if (auth()->user()->can('create-distributioninfos')) {
            $id = $id;
            $info = DistributionInfo::where('distribution_id', $id)->select('distribution_id')->first();
            if ($info) {
                toast('ERROR! Distribution Info already added.', 'error', 'top-right')->autoClose(5000);
                return redirect()->route('distributions-info.index');
            } else {
                $distributionInfo = DistributionInfo::pluck('distribution_id')->toArray();
                $distributions = Distribution::orderBy('created_at', 'DESC')->whereNotIn('id', $distributionInfo)->get();
                return view('backend.distribution-info.add-distribution-info', compact('distributions', 'id'));
            }

        } else {
            return redirect(route('distributions-info.index'));
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
            'distribution_id' => 'required',
            'info' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
        $fileName = $this->logoUpload($request);

        $distribution = new DistributionInfo();
        $distribution->distribution_id = $request->distribution_id;
        $distribution->info = $request->info;
        $distribution->lat = $request->lat;
        $distribution->lng = $request->lng;
        $distribution->logo = $fileName ? $fileName : 'photo';
        $distribution->address = $request->address;
        $distribution->email = $request->email;
        $distribution->phone = $request->phone;
        $distribution->fax = $request->fax; 
        $distribution->twitter = $request->twitter;
        $distribution->youtube = $request->youtube;
        $distribution->facebook = $request->facebook;
        $distribution->website = $request->website;
        $distribution->save();
        toast('Successfully created the power information', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('distributions-info.index');
    }
    public function logoUpload($request)
    {
        if ($request->hasFile('logo')) {
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_distribution_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/distribution/' . $fileName);
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
        if (auth()->user()->can('read-distributioninfos')) {
            $show = DistributionInfo::where('id', $id)->first();
            return view('backend.distribution-info.show-distribution-info', compact('show'));
        } else {
            return redirect(route('distributions-info.index'));
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
        if (auth()->user()->can('update-distributioninfos')) {
            $edit = DistributionInfo::where('id', $id)->first();
            $powers = Distribution::orderBy('created_at', 'DESC')->get();
            return view('backend.distribution-info.edit-distribution-info', compact('edit', 'powers'));
        } else {
            return redirect(route('distributions-info.index'));
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
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
        $fileName = $this->logoUpdate($request, $id);

        $distribution = DistributionInfo::find($id);
        $distribution->info = $request->info;
        $distribution->lat = $request->lat;
        $distribution->lng = $request->lng;
        $distribution->logo = $fileName;
        $distribution->address = $request->address;
        $distribution->email = $request->email;
        $distribution->phone = $request->phone;
        $distribution->fax = $request->fax; 
        $distribution->twitter = $request->twitter;
        $distribution->youtube = $request->youtube;
        $distribution->facebook = $request->facebook;
        $distribution->website = $request->website;
        $distribution->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('distributions-info.index');
    }
    public function logoUpdate($request, $id)
    {
        $distribution = DistributionInfo::where('id', $id)->first();
        if ($request->hasFile('logo')) {
            $file_path = $user->logo;
            $storage_path = 'uploads/distribution/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_distribution_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/distribution/' . $fileName);
        } else {
            $fileName = $distribution['logo'];
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
        if (auth()->user()->can('create-distributioninfos')) {
            toast('Power information Deleted Success!', 'success', 'top-right');
            $destroy = DistributionInfo::find($id)->first();
            if ($destroy) {
                $file_path = $destroy->logo;
                $storage_path = 'uploads/distribution/' . $file_path;
                if (\File::exists($storage_path)) {
                    unlink($storage_path);
                }
                $destroy->delete();
                return redirect()->route('distributions-info.index');
            }
        } else {
            return redirect(route('distributions-info.index'));
        }
    }
}
