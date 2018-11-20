<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
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
        $users = User::orderBy('id', 'desc')->get();
        return view('backend.auth.user.users')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-users')) {
            $roles = Role::get();
            return view('backend.auth.user.create', compact('roles'));
        } else {
            return redirect(route('users.index'));
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

        $this->validateWith([
            'user_name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|numeric',
            'roles' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $fileName = $this->uploadLogo($request);
        if (!empty($request->password)) {
            $password = trim($request->password);
        } else {
            # set the manual password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->photo = $fileName ? $fileName : 'photo';
        $user->password = Hash::make($password);
        $user->save();

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index');
    }
    public function uploadLogo($request)
    {
        if ($request->hasFile('upload')) {
            $picture = $request->file('upload');
            $images = Image::make($picture);
            $images->resize(200, 200, function ($constrain) {
                $constrain->aspectRatio();
            });
            $fileName = pathinfo('_users_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/users/' . $fileName);
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
        if (auth()->user()->can('read-users')) {
            $show = User::where('id', $id)->with('roles')->first();
            return view("backend.auth.user.show")->withShow($show);
        } else {
            return redirect(route('users.index'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('update-users')) {
            $roles = Role::all();
            $edit = User::where('id', $id)->with('roles')->first();
            return view("backend.auth.user.edit")->withEdit($edit)->withRoles($roles);
        } else {
            return redirect(route('users.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validateWith([
            'user_name' => 'required|unique:users,user_name,' . $id,
            'phone' => 'required|numeric|unique:users,phone,' . $id,
            'roles' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'string|min:6|confirmed',
        ]);

        $fileName = $this->photoUpdate($request, $id);

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->photo = $fileName;
        if ($request->password_options == 'auto') {
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $user->password = Hash::make($str);
        } elseif ($request->password_options == 'manual') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->syncRoles($request->roles);
        toast('User updated Success!', 'success', 'top-right');
        return redirect()->route('users.index');
    }
    public function photoUpdate($request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($request->hasFile('upload')) {
            $file_path = $user->photo;
            $storage_path = 'uploads/users/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $picture = $request->file('upload');
            $images = Image::make($picture);
            $images->resize(200, 200, function ($constrain) {
                $constrain->aspectRatio();
            });
            $fileName = pathinfo('_user_' . '_' . rand(), PATHINFO_FILENAME) . '.' . $picture->getClientOriginalExtension();
            $images->save('uploads/users/' . $fileName);
        } else {
            $fileName = $user['photo'];
        }
        return $fileName;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        toast('User Deleted Success!', 'success', 'top-right');
        $destroy = User::where('id', $id)->first();
        if ($destroy) {
            $file_path = $destroy->photo;
            $storage_path = 'uploads/users/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $destroy->delete();
            return redirect()->route('users.index');
        }
    }
}
