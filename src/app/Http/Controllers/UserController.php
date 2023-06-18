<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if (!empty($request->query('keywrod'))) {
            $data = User::orderBy('id', 'DESC')
                ->where('name', 'LIKE', '%' . $request->query('keywrod') . '%')
                ->orWhere('email', 'LIKE', '%' . $request->query('keywrod') . '%')
                ->paginate(5);
        } else {
            $data = User::orderBy('id', 'DESC')->paginate(5);
        }
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            Log::info('User created successfully');
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            Log::info('Show User : ' . $user);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        try {
            $user = User::find($id);
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $user->roles->pluck('name', 'name')->all();
            Log::info('Edit User : ' . $user);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',
                'roles' => 'required'
            ]);

            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));
            Log::info('User updated successfully : ' . $user);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    { 
        try {
            User::find($id)->delete();
            Log::info(' User deleted successfully ');
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
