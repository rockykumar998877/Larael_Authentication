<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function usershow(){
        $users = User::all();
        return view('index', compact('users'));
    }


    // Register a new user
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|alpha|max:50',
            'last_name' => 'nullable|alpha|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20|regex:/[A-Z]/|regex:/[a-z]/|regex:/[@$!%*#?&]/',
            'mobile' => 'required|unique:users|max:10|min:10',
            'pan_card' => 'required|size:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);


        $file = $request->file('profile_image');

        $fileName = time().''.$file->getClientOriginalName();

        $imagePath = $file->storeAs('profile_image',$fileName,'public');


        // $imagePath = null;
        // if ($request->hasFile('profile_image')) {
        //     $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        // }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'pan_card' => $request->pan_card,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'profile_image' => $imagePath,
        ]);

        return redirect()->route('/index');

    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    // Logout the user
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user
    
        return redirect()->route('loginform')->with('success', 'Logged out successfully.');
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('edit-user', compact('user'));
    }
   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'first_name' => 'nullable|alpha|max:50',
            'last_name' => 'nullable|alpha|max:50',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'mobile' => 'nullable|unique:users,mobile,' . $user->id . '|max:10|min:10',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2024',
        ]);
    
        if ($request->hasFile('profile_image')) {

            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }
    
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath; 
        }
        $user->update($request->except('profile_image')); 
        return redirect()->route('/index');
    }
    

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users-list');
    }


   
}


