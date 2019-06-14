<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::orderBy('updated_at', 'DESC')->paginate(5); //Listo los roles ordenados por la ultima creación y luego los pagino por 5
        return view('admin.modules.roles.index', compact('roles')); //devuelvo los roles en la variable roles.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::paginate(5);
        return view('admin.modules.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'slug' => strtolower($request['description'])
        ]); //update roles
        $role->permissions()->sync($request->get('permissions')); //update permissions
        return redirect()->route('roles.index', $role->id)->with('info', 'Role actualizado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::paginate(5);
        return view('admin.modules.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::paginate(5);
        return view('admin.modules.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all()); //update roles
        $role->permissions()->sync($request->get('permissions')); //update permissions
        return redirect()->route('roles.index', $role->id)->with('info', 'Role actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('info', 'Eliminado Correctamente');
    }
}
