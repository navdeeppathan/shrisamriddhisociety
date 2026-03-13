<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->where('role','!=','admin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'profile_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);

        if ($request->hasFile('profile_img')) {
            $profile_img = $request->file('profile_img');
            $profile_img_name = time() . '.' . $profile_img->getClientOriginalExtension();
            $profile_img->move(public_path('images'), $profile_img_name);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'address' => $request->address,
            'joining_date' => $request->joining_date,
            'monthly_deposit' => $request->monthly_deposit,
            'profile_img' => $profile_img_name
        ]);

        return back()->with('success','User added successfully');
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'joining_date' => $request->joining_date,
            'monthly_deposit' => $request->monthly_deposit
            
        ];

        // Upload new profile image
        if ($request->hasFile('profile_img')) {

            // delete old image
            if ($user->profile_img && File::exists(public_path('images/' . $user->profile_img))) {
                File::delete(public_path('images/' . $user->profile_img));
            }

            $profile_img = $request->file('profile_img');
            $profile_img_name = time() . '.' . $profile_img->getClientOriginalExtension();
            $profile_img->move(public_path('images'), $profile_img_name);

            $data['profile_img'] = $profile_img_name;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success','User deleted successfully');
    }

    

    public function profile()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }
}