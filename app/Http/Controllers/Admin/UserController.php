<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view("admin.user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->validated();
        User::create($data);

        return redirect()->route('user.index')->with('toast_success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "password" => "nullable",
            "name" => "string",
            "email" => "nullable",
        ]);
    
        // Cek apakah ada perubahan pada password
        if ($request->password) {
            $user->update(["password" => Hash::make($request->password)]);
        }
    
        $user->update($request->except('password'));
    
        return redirect()->route("user.index")->with('toast_success', 'User Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('toast_success', 'User Deleted Successfully!');
    }
}
