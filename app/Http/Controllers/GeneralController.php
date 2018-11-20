<?php

namespace App\Http\Controllers;

use App\General;
use Illuminate\Http\Request;
use Image;

class GeneralController extends Controller
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
            if (!General::count()) {
                if (auth()->user()->can('create-generals')) {
                    return view('backend.general.general-setting');
                } else {
                    return redirect(route('admin'));
                }
            } else {
                if (auth()->user()->can('update-generals')) {
                    $edit = General::first();
                    return view('backend.general.edit-general', compact('edit'));
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
        if (auth()->user()->can('update-generals')) {
            $this->validate($request, [
                'main_logo' => 'required|mimes :png',
                'fav_icon' => 'required',
                'distri_text' => 'required',
                'side_icon_1' => 'required|mimes :png',
                'side_icon_2' => 'required|mimes :png',
                'side_icon_3' => 'required|mimes :png',
                'side_icon_5' => 'required|mimes :png',
                'side_icon_6' => 'required|mimes :png',
                'side_icon_7' => 'required|mimes :png',
                'side_icon_8' => 'required|mimes :png',
                'side_title_1' => 'required',
                'side_title_2' => 'required',
                'side_title_3' => 'required',
                'side_title_5' => 'required',
                'side_title_6' => 'required',
                'side_title_7' => 'required',
                'side_title_8' => 'required',
            ]);
            $distri_logo = $this->DistributionLogo($request);
            $main_logo = $this->main_logo($request);
            $fav_icon = $this->fav_icon($request);
            $side_icon_1 = $this->side_icon_1($request);
            $side_icon_2 = $this->side_icon_2($request);
            $side_icon_3 = $this->side_icon_3($request);
            $side_icon_4 = $this->side_icon_4($request);
            $side_icon_5 = $this->side_icon_5($request);
            $side_icon_6 = $this->side_icon_6($request);
            $side_icon_7 = $this->side_icon_7($request);
            $side_icon_8 = $this->side_icon_8($request);

            $general = new General();
            $general->main_logo = $main_logo;
            $general->distri_logo = $distri_logo ? $distri_logo : 'distri_logo';
            $general->distri_text = $request->distri_text;
            $general->fav_icon = $fav_icon;
            $general->side_icon_1 = $side_icon_1;
            $general->side_icon_2 = $side_icon_2;
            $general->side_icon_3 = $side_icon_3;
            $general->side_icon_4 = $side_icon_4 ? $side_icon_4 : 'side_icon_4';
            $general->side_icon_5 = $side_icon_5;
            $general->side_icon_6 = $side_icon_6;
            $general->side_icon_7 = $side_icon_7;
            $general->side_icon_8 = $side_icon_8;
            $general->side_title_1 = $request->side_title_1;
            $general->side_title_1 = $request->side_title_1;
            $general->side_title_2 = $request->side_title_2;
            $general->side_title_3 = $request->side_title_3;
            $general->side_title_4 = $request->side_title_4 ? $request->side_title_4 : 'no text';
            $general->side_title_5 = $request->side_title_5;
            $general->side_title_6 = $request->side_title_6;
            $general->side_title_7 = $request->side_title_7;
            $general->side_title_8 = $request->side_title_8;
            $general->save();
            toast('Successfully created General Setting', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('general-setting.index');
        } else {
            return redirect(route('general-setting.index'));
        }
    }
    //for upload website logo
    public function DistributionLogo($request)
    {
        if ($request->hasFile('distri_logo')) {
            $picture = $request->file('distri_logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_distri_logo_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website logo
    public function main_logo($request)
    {
        if ($request->hasFile('main_logo')) {
            $picture = $request->file('main_logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_main_logo_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website fav icon
    public function fav_icon($request)
    {
        if ($request->hasFile('fav_icon')) {
            $picture = $request->file('fav_icon');
            $images = Image::make($picture);
            $fileName = pathinfo('_fav_icon_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_1
    public function side_icon_1($request)
    {
        if ($request->hasFile('side_icon_1')) {
            $picture = $request->file('side_icon_1');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_1_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_2
    public function side_icon_2($request)
    {
        if ($request->hasFile('side_icon_2')) {
            $picture = $request->file('side_icon_2');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_2_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_3
    public function side_icon_3($request)
    {
        if ($request->hasFile('side_icon_3')) {
            $picture = $request->file('side_icon_3');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_3_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }

    //for upload website side_icon_4
    public function side_icon_4($request)
    {
        if ($request->hasFile('side_icon_4')) {
            $picture = $request->file('side_icon_4');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_4_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_5
    public function side_icon_5($request)
    {
        if ($request->hasFile('side_icon_5')) {
            $picture = $request->file('side_icon_5');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_5_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_6
    public function side_icon_6($request)
    {
        if ($request->hasFile('side_icon_6')) {
            $picture = $request->file('side_icon_6');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_6_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_7
    public function side_icon_7($request)
    {
        if ($request->hasFile('side_icon_7')) {
            $picture = $request->file('side_icon_7');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_7_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
        }
    }
    //for upload website side_icon_8
    public function side_icon_8($request)
    {
        if ($request->hasFile('side_icon_8')) {
            $picture = $request->file('side_icon_8');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_8_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
            return $fileName;
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
            'distri_text' => 'required',
            'side_title_1' => 'required',
            'side_title_2' => 'required',
            'side_title_3' => 'required',
            'side_title_5' => 'required',
            'side_title_6' => 'required',
            'side_title_7' => 'required',
            'side_title_8' => 'required',
        ]);
        $distri_logo = $this->update_distri_logo($request, $id);
        $update_main_logo = $this->update_main_logo($request, $id);
        $update_fav_icon = $this->update_fav_icon($request, $id);
        $update_side_icon_1 = $this->update_side_icon_1($request, $id);
        $update_side_icon_2 = $this->update_side_icon_2($request, $id);
        $update_side_icon_3 = $this->update_side_icon_3($request, $id);
        $update_side_icon_4 = $this->update_side_icon_4($request, $id);
        $update_side_icon_5 = $this->update_side_icon_5($request, $id);
        $update_side_icon_6 = $this->update_side_icon_6($request, $id);
        $update_side_icon_7 = $this->update_side_icon_7($request, $id);
        $update_side_icon_8 = $this->update_side_icon_8($request, $id);


        $general = General::find($id);
        $general->distri_logo = $distri_logo; 
         $general->distri_text = $request->distri_text;
        $general->main_logo = $update_main_logo;
        $general->fav_icon = $update_fav_icon;
        $general->side_icon_1 = $update_side_icon_1;
        $general->side_icon_2 = $update_side_icon_2;
        $general->side_icon_3 = $update_side_icon_3;
        $general->side_icon_5 = $update_side_icon_5;
        $general->side_icon_6 = $update_side_icon_6;
        $general->side_icon_7 = $update_side_icon_7;
        $general->side_icon_8 = $update_side_icon_8;
        $general->side_title_1 = $request->side_title_1;
        $general->side_title_2 = $request->side_title_2;
        $general->side_title_3 = $request->side_title_3;
        $general->side_title_5 = $request->side_title_5;
        $general->side_title_6 = $request->side_title_6;
        $general->side_title_7 = $request->side_title_7;
        $general->side_title_8 = $request->side_title_8;
        $general->save();
        toast('Updated Successfully', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('general-setting.index');
    }
    //update main logo
    public function update_distri_logo($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('distri_logo')) {
            $file_path = $general->distri_logo;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('distri_logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_distri_logo_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['distri_logo'];
        }
        return $fileName;
    }
    //update main logo
    public function update_main_logo($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('main_logo')) {
            $file_path = $general->main_logo;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('main_logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_main_logo_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['main_logo'];
        }
        return $fileName;
    }
    //update fav icon
    public function update_fav_icon($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('fav_icon')) {
            $file_path = $general->fav_icon;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('fav_icon');
            $images = Image::make($picture);
            $fileName = pathinfo('_fav_icon_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['fav_icon'];
        }
        return $fileName;
    }
    //update side_icon_1
    public function update_side_icon_1($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_1')) {
            $file_path = $general->side_icon_1;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_1');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_1_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_1'];
        }
        return $fileName;
    }
    //update side_icon_2
    public function update_side_icon_2($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_2')) {
            $file_path = $general->side_icon_2;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_2');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_2_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_2'];
        }
        return $fileName;
    }
    //update side_icon_3
    public function update_side_icon_3($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_3')) {
            $file_path = $general->side_icon_3;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_3');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_3_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_3'];
        }
        return $fileName;
    }
    //update side_icon_4
    public function update_side_icon_4($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_4')) {
            $file_path = $general->side_icon_4;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_4');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_4_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_4'];
        }
        return $fileName;
    }
    //update side_icon_5
    public function update_side_icon_5($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_5')) {
            $file_path = $general->side_icon_5;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_5');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_5_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_5'];
        }
        return $fileName;
    }
    //update side_icon_6
    public function update_side_icon_6($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_6')) {
            $file_path = $general->side_icon_6;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_6');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_6_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_6'];
        }
        return $fileName;
    }
    //update side_icon_7
    public function update_side_icon_7($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_7')) {
            $file_path = $general->side_icon_7;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_7');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_7_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_7'];
        }
        return $fileName;
    }
    //update side_icon_8
    public function update_side_icon_8($request, $id)
    {
        $general = General::where('id', $id)->first();
        if ($request->hasFile('side_icon_8')) {
            $file_path = $general->side_icon_8;
            $storage_path = 'uploads/general/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('side_icon_8');
            $images = Image::make($picture);
            $fileName = pathinfo('_side_icon_8_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/general/' . $fileName);
        } else {
            $fileName = $general['side_icon_8'];
        }
        return $fileName;
    }
}
