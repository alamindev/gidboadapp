<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
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
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return view('backend.slider.sliders', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-sliders')) {
            return view('backend.slider.add-slider');
        } else {
            return redirect(route('slider.index'));
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
            'title' => 'required',
            'details' => 'required',
            'logo' => 'required',
        ]);
        $fileName = $this->logoUpload($request);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->details = $request->details;
        $slider->logo = $fileName;
        $slider->save();
        toast('Successfully created Slider and info', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('slider.index');
    }

    public function logoUpload($request)
    {
        if ($request->hasFile('logo')) {
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_slider_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/slider/' . $fileName);
            return $fileName;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('read-sliders')) {
            $show = Slider::where('id', $id)->first();
            return view('backend.slider.show-slider', compact('show'));
        } else {
            return redirect(route('slider.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-sliders')) {
            $edit = Slider::where('id', $id)->first();
            return view('backend.slider.edit-slider', compact('edit'));
        } else {
            return redirect(route('slider.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'details' => 'required',
        ]);
        $fileName = $this->logoUpdate($request, $id);

        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->details = $request->details;
        $slider->logo = $fileName;
        $slider->save();
        toast('Updated Successfully!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('slider.index');
    }
    public function logoUpdate($request, $id)
    {
        $slider = Slider::where('id', $id)->first();
        if ($request->hasFile('logo')) {
            $file_path = $slider->logo;
            $storage_path = 'uploads/slider/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('logo');
            $images = Image::make($picture);
            $fileName = pathinfo('_slider_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/slider/' . $fileName);
        } else {
            $fileName = $slider['logo'];
        }
        return $fileName;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-sliders')) {
            toast('Slider Deleted Success!', 'success', 'top-right');
            $destroy = Slider::find($id)->first();
            if ($destroy) {
                $file_path = $destroy->logo;
                $storage_path = 'uploads/slider/' . $file_path;
                if (\File::exists($storage_path)) {
                    unlink($storage_path);
                }
                $destroy->delete();
                return redirect()->route('slider.index');
            }
        } else {
            return redirect(route('slider.index'));
        }
    }
}
