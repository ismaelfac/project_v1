<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = Auth::id();
        $users = User::name($request->get('name'))->with('roles')->whereNotIn('id', ['1', $id])->orderBy('updated_at', 'DESC')->paginate(5);
        return view('admin.modules.users.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles_unique = Role::where('special', 'all-access')->orWhere('special', 'no-access')->get();
        $roles_personalized = Role::where('special', null)->paginate(5);
        return view('admin.modules.users.create', compact('roles_unique', 'roles_personalized'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user = User::create([
            'name' => ($request->last_name . ' ' . $request->first_name),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => $request->is_active
        ]);
        $user->roles()->sync($request->get('roles_personalized')); //update roles
        return redirect()->route('users.index')->with('info', 'Usuario Guardado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles_unique = ($user->isAdministrador() ? $this->getRoles_inv($user) : Role::find($user)->where('special', null));
        return view('admin.modules.users.show', compact('user', 'roles_unique'));
    }
    public function getRoles_inv($user)
    {
        return Role::find($user)->where('special', 'all-access')->Where('special', 'no-access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles_unique = ($user->isAdministrador() ? $this->getRoles_inv() : Role::find($user));
        $roles_personalized = Role::where('special', null)->paginate(5);
        return view('admin.modules.users.edit', compact('user', 'roles_unique', 'roles_personalized'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all()); //update user
        $user->roles()->sync($request->get('roles')); //update roles
        return redirect()->route('users.index', $user->id)->with('info', 'Usuario Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->is_active) {
            $user->update(['is_active' => false]);
            return back()->with('info', 'Usuario Desactivado Correctamente');
        } else {
            $user->update(['is_active' => true]);
            return back()->with('info', 'Usuario Activado Correctamente');
        }
    }
    public function delete(User $user)
    {
        $user->delete();
    }
}
