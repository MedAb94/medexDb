<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        return view('pages.users.index');

    }

    public function getDT()
    {
        $users =User::query()->orderByDesc('id');
        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return view('pages.users.actions', ["user" => $user])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function formAdd()
    {
        return view('pages.users.add',[
            'roles'=>\Spatie\Permission\Models\Role::all(),
        ]);
    }
    public function formEdit($id)
    {
        $user = User::find($id);
        return view('pages.users.get',[
            'user'=>$user,
            'roles'=>\Spatie\Permission\Models\Role::all(),

        ]);
    }

    public function save()
    {
        $this->validate(request(),[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',
            'role'=>'required',
        ]);
        $user = new User();
        $user->name=request()->input('name');
        $user->email=request()->input('email');
        $user->password = bcrypt(request()->input('password'));
        $user->save();
        $user->assignRole(request()->input('role'));
        return response()->json($user->id);
    }
    public function update()
    {
        $this->validate(request(),[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.request()->input('id'),
            'password'=>'nullable|min:6',
            'password_confirmation'=>'nullable|same:password',
            'role'=>'required',
        ]);
        $user = User::find(request()->input('id'));
        $user->name=request()->input('name');
        $user->email=request()->input('email');
        if(request()->input('password')){
            $user->password = bcrypt(request()->input('password'));
        }
        $user->save();
        $user->syncRoles(request()->input('role'));
        return response()->json($user->id);
    }
    public function delete($id)
    {

        $user = User::find($id);
        $user->delete();
        return response()->json($user->id);
    }
}
