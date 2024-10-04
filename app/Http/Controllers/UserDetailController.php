<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\Video;
use Illuminate\Http\Request;

class UserDetailController extends Controller
{
    public function index()
    {
        // Retrieve all user details
        $userDetails = UserDetail::all();

        // Pass user details to the view
        return view('details', compact('userDetails'));
    }

    public function create()
    {
        // Return the view for creating a new user detail
        return view('details');
    }

    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'teamType' => 'required|string|max:255',
            'members' => 'required|numeric|min:1|max:1000',
            'pin_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'education' => 'nullable|string',
            'occupation' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'describe_yourself' => 'nullable|string',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'facebook' => 'nullable|url',
            'photo' => 'image|max:11264|mimes:jpeg,png,jpg,gif,svg',

              // 'g_first_name' => 'required|string|max:255',
            // 'g_last_name' => 'required|string|max:255',
            // 'g_address' => 'required|string|max:255',
            // 'g_city' => 'required|string|max:255',
            // 'g_state' => 'required|string|max:255',
            // 'g_pin_code' => 'required|string|max:20',
            // 'g_phone' => 'required|string|max:20',
            // 'g_email' => 'required|email|max:255',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['plan_id'] = "TNDS-S1";


        $path = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('profile/', $fileName, 'public');
        }

        $validatedData['photo'] = $path;
        UserDetail::updateOrCreate(
            ['user_id' => $validatedData['user_id']],
            $validatedData
        );

        return redirect()->route('upload-video', ['plan' => $request->plan])->with('success', 'User detail created successfully. #199');
    }

    public function show(UserDetail $userDetail)
    {
        return view('details.show', compact('userDetail'));
    }

    public function edit(UserDetail $userDetail)
    {
        return view('details.edit', compact('userDetail'));
    }

    public function update(Request $request, UserDetail $userDetail)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'teamType' => 'required|string|max:255',
            'pin_code' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|max:11264|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('profile/', $fileName, 'public');
            $validatedData['photo'] = $path;
        }
        $userDetail->update($validatedData);
        return redirect()->back()->with('success', 'Your profile was updated successfully.');
    }

    public function destroy(UserDetail $userDetail)
    {
        $userDetail->delete();
        return redirect()->route('user-details')->with('success', 'User detail deleted successfully.');
    }
}
