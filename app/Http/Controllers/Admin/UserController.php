<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\AdminUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $users = User::with('roles')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(AdminUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $user->assignRole($data['role']);
        return redirect()->route('admin.users.index')->with('success','User created');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(AdminUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update(['name'=>$data['name'],'email'=>$data['email']]);
        // sync role
        $role = Role::where('name',$data['role'])->first();
        if ($role) $user->roles()->sync([$role->id]);
        return redirect()->route('admin.users.index')->with('success','User updated');
    }

    public function resetPassword(Request $request, User $user)
    {
        $new = $request->input('password', 'password');
        $user->password = Hash::make($new);
        $user->save();
        return redirect()->route('admin.users.index')->with('success','Password reset');
    }
}
