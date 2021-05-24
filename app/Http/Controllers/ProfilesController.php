<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show($id)
    {
        $profile = User::find($id);

        return view('profile.profile')->with('profile', $profile);
    }

    public function edit($id)
    {
        $profile = User::find($id);

        return view('profile.edit')->with('profile', $profile);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'mobile' => 'required|string|max:11',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|integer',
            'profilePic' => 'mimes:jpg,png,jpeg|max:25000'
        ]);
        
        $newProfileName = $request->input('oldprofile');

        if($request->profilePic){
            $newProfileName = time() . '-' . $request->name . '.' . $request->profilePic->extension();

            $request->profilePic->move(public_path('images'), $newProfileName);
        }
        
        $profile = User::where('id', $id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'mobile' => $request->input('mobile'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip' => $request->input('zip'),
            'profilePic' => $newProfileName,
        ]);

        return redirect('/posts');
    }
}
