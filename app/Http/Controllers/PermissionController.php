<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Session;
use DB;

class PermissionController extends Controller
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
        if (\Auth::user()->hasRole('developer')) {
            $permissions = Permission::all();
            return view('backend.auth.permissions.permission')->withPermissions($permissions);
        } else {
            return redirect(route('permissions.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-permissions')) {
            $permissions = Permission::get();
            $tables = DB::select('SHOW TABLES');
            return view('backend.auth.permissions.create', compact('tables', 'permissions'));
        } else {
            return redirect(route('permissions.index'));
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
        $permissions = Permission::get();

        foreach ($permissions as $permission) {
            if ($permission->name == $request->name) {
                toast('You Have already created permission on this Name!', 'error', 'top-right')->autoClose(5000);
                return back();
            }
        }
      
        if ($request->permission_type == 'basic') {
            $this->validateWith([
                    'display_name' => 'required|max:255',
                    'name' => 'required|max:255|alphadash|unique:permissions,name',
                    'description' => 'sometimes|max:255',
                    'per_table' => 'required'
                    ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->per_table = $request->per_table;
            $permission->save();

            toast('Successfully created the new '. $permission->display_name . ' permission in the database!', 'error', 'top-right')->autoClose(5000);
            return redirect()->route('permissions.index');
        } elseif ($request->permission_type == 'crud') {
            if (Permission::where('per_table', '=', $request->per_table)->exists()) {
                toast('You Have already created permission on this table!', 'error', 'top-right')->autoClose(5000);

                return back();
            } else {
                $this->validateWith([
                        'resource' => 'required|min:3|max:100|alpha',
                        'per_table' => 'required'
                        ]);

                $crud = explode(',', $request->crud_selected);
                if (count($crud) > 0) {
                    foreach ($crud as $x) {
                        $slug = strtolower($x) . '-' . strtolower($request->resource);
                        $display_name = ucwords($x . " " . $request->resource);
                        $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);

                        $permission = new Permission();
                        $permission->name = $slug;
                        $permission->display_name = $display_name;
                        $permission->description = $description;
                        $permission->per_table = $request->per_table;
                        $permission->save();
                    }
                    toast('Successfully created the new '. $permission->display_name . ' permission in the database!', 'success', 'top-right')->autoClose(5000);
                    return redirect()->route('permissions.index');
                }
            }
        } else {
            return redirect()->route('permissions.create')->withInput();
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
        if (auth()->user()->can('read-permissions')) {
            $permission = Permission::findOrFail($id);
            return view('backend.auth.permissions.show')->withPermission($permission);
        } else {
            return redirect(route('permissions.index'));
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
        if (auth()->user()->can('update-permissions')) {
            $permission = Permission::findOrFail($id);
            return view('backend.auth.permissions.edit')->withPermission($permission);
        } else {
            return redirect(route('permissions.index'));
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
        'display_name' => 'required|max:255',
        'description' => 'sometimes|max:255'
      ]);
        $permission = Permission::findOrFail($id);
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();

        toast('Successfully Updated the new '. $permission->display_name . ' permission in the database!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('permissions.show', $id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PowerPlant  $powerPlant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('delete-permissions')) {
            toast('Permissions Deleted Success!', 'success', 'top-right');
            $destroy = Permission::find($id)->first();
            if ($destroy) {
                $destroy->delete();
                return redirect()->route('permissions.index');
            }
        } else {
            return redirect(route('permissions.index'));
        }
    }
}
