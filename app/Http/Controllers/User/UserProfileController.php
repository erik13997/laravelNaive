<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index()
    {
        return view("auth.profile");
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required','email','string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
        ]);
        if ($request->password) {
            auth()->user()->update(["password"=> Hash::make($request->password)]);
        }
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('profile-photos', $imageName, 'public');
            auth()->user()->update(['profile'=> $imageName]);
            // $user->profile_photo = $imageName;

        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('toast_success', 'Update Profile Create Successfully!');
        
    }
}
