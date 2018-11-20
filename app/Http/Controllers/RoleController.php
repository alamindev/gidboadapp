<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Session;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
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
            $roles = Role::get();
        } else {
            $roles = Role::where('name', '!=', 'developer')->get();
        }
        
        return view('backend.auth.roles.roles')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create-roles')) {
            $permissions = Permission::all();
            $view_tables = DB::table('view_tables')->get();
            $tables = DB::select('SHOW TABLES');
            return view('backend.auth.roles.role-create', compact('view_tables', 'tables'))->withPermissions($permissions);
        } else {
            return redirect(route('roles.index'));
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
        'display_name' => 'required|max:255',
        'name' => 'required|max:100|alpha_dash|unique:roles',
        'description' => 'sometimes|max:255'
      ]);

        $role = new Role();
        $role->display_name = $request->display_name;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        if ($request->permission) {
            $role->syncPermissions($request->permission);
        }
        toast('Successfully created the new '. $role->display_name . ' role in the database!', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('read-roles')) {
            $role = Role::where('id', $id)->first();
            if ($role) {
                $role = Role::where('id', $id)->with('permissions', 'users')->first();
                return view('backend.auth.roles.show')->withRole($role);
            } else {
                return redirect()->route('roles.index');
            }
        } else {
            return redirect(route('roles.index'));
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
        if (auth()->user()->can('update-roles')) {
            $role = Role::where('id', $id)->first();
            if ($role) {
                $edit = Role::where('id', $id)->with('permissions')->first();
                $permissions = Permission::all();
                $view_tables = DB::table('view_tables')->get();
                $tables = DB::select('SHOW TABLES');
                return view('backend.auth.roles.role-edit', compact('view_tables', 'tables'))->withEdit($edit)->withPermissions($permissions);
            } else {
                return redirect()->route('roles.index');
            }
        } else {
            return redirect(route('roles.index'));
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

        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        if ($request->permission) {
            $role->syncPermissions($request->permission);
        }
        toast('Successfully update the '. $role->display_name . ' role in the database.', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('roles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * store database table name which you can permission give
     * @param init $id
     * @return Illuminate\Http\Request  $request
     */
    public function showPermission(Request $request)
    {
        $request->validate([
        'per_table' => 'required',
        ], [
          'per_table.required' => 'Please Select A Table :)-',
        ]);
        if (DB::table('view_tables')->where('t_name', '=', $request->per_table)->exists()) {
            toast('You Have already created permission on this table!', 'error', 'top-right')->autoClose(5000);
            return back();
        } else {
            $per = DB::table('view_tables')->insert([
        't_name' => $request->per_table
      ]);
            toast('Table Name Inserted Successfully Complated!', 'error', 'top-right')->autoClose(5000);
            return redirect()->route('roles.create');
        }
    }
}
