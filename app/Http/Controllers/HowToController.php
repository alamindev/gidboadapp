<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HowTo;
use Image;
use App\MediaUpload;
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
    public function show()
    {
        return  url('/'); 
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

    public function howToUpload(Request $request){
        $this->validate($request, [
            'images' => 'required', 
        ],[
            'images.required' => 'Please Before Select An Image and click Upload!'
        ]);
       $exploded = explode(',', $request->images);
        $decode = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg')){
            $extension = 'jpg';
        }else{
            $extension = 'png';
        } 
        $images = Image::make($decode);
        $fileName =  str_random().'.' . $extension;
        $images->save('uploads/media/' . $fileName);

        $media = new MediaUpload();
        $media->image = $fileName;
        $media->save();
        return response()->json(['success','Upload Completed!']);
    }
    public function howToUploadAll(){ 
        return MediaUpload::get();  
    }
   
    public function howToDeleteImg($id){
        $destroy = MediaUpload::find($id)->first();
        if ($destroy) {
            $file_path = $destroy->image;
            $storage_path = 'uploads/media/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $destroy->delete();
            return response()->json(['delete'=>'Image Deleted Successfully']);
        }
    }
}