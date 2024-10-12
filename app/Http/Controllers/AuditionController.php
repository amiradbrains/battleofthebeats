<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\Audition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditionController extends Controller
{
    public $validation_fields, $validation_msgs;
    public function __construct()
    {
        $this->validation_fields = [

            'stagename' => 'nullable|string|max:255',
            'why_tup_expectations' => 'nullable|string|max:200',
            'why_we_select_you' => 'nullable|string|max:200',
            'prepared_songs' => 'nullable|string|max:200',
            'probability' => 'nullable|string|max:200',
            'contract' => 'nullable|string|max:200',
            'group_together' => 'nullable|string|max:200',
            'members' => 'nullable|array',
            'how_long_group_together' => 'nullable|string|max:200',
            'future_plan_if_win' => 'required|string|max:200',
            'unique_qualities' => 'required|string|max:200',
            'main_goal_difficulties' => 'required|string|max:200',
            'biggest_strength_support' => 'required|string|max:200',
            'favorite_judge_why' => 'required|string|max:200',
            'role_model_inspiration' => 'required|string|max:200',
            'written_composed_song_inspiration' => 'required|string|max:200',
            'previous_performance' => 'required|string|max:200',
            'rolemodel' => 'required|string|max:200',

            'choreograph' => 'required|string|max:200',
            'dance_form' => 'required|string|max:200',
            'dance_style' => 'required|string|max:200',
            'name_representing' => 'required|string|max:200',
            'responsibility' => 'required|accepted',
            'privacy_policy' => 'required|accepted',
            'terms_conditions' => 'required|accepted',
            'refund_policy' => 'required|accepted',
        ];
        $this->validation_msgs = [
            'written_composed_song_inspiration.*' => 'Please fillout your inspiration with no more than 2000 characters',

            // 'genre_of_singing.*' => 'Please fillout your genre/type of your audition with no more than 300 characters',
            // 'music_experience.*' => 'Please fillout your previous experience with no more than 5000 characters',
            // 'music_qualification.*' => 'Please fillout your music/dancing qualification with no more than 5000 characters',
        ];
    }
    public function index()
    {
        // Retrieve all user details
        $userDetail = Audition::all();

        // Pass user details to the view
        return view('audition', compact('userDetail'));
    }

    public function create()
    {
        // Return the view for creating a new user detail
        return view('audition');
    }
    function plan_id($plan)
    {
        return Plan::where('name', $plan)->first()->id ?? null;
    }
    public function store(Request $request)
    {
        $plan = $request->plan;
        $validatedData = $request->validate($this->validation_fields, $this->validation_msgs);
        $plan_id = $this->plan_id($plan);
        if (!$plan_id) {
            return redirect()->route('home')->with('error', 'Plan not found');
        }
        // if (!Payment::where('user_id', Auth::id())->where('plan_id', $plan_id)->where('payment_id', '!=', '')->where('status', '=', 'COMPLETED')->exists()) {
        //     return redirect()->route('upload-video', ['plan' => $plan]);
        // }

        //    $members_data = $validatedData['members'];

        $validatedData['plan_id'] = $plan_id;
        $validatedData['user_id'] = auth()->user()->id;
        // Create or update user details
        Audition::create(
            $validatedData
        );

        return redirect()->route('upload-video', ['plan' => $plan])->with('success', 'Audition details created successfully, Now you can upload your video.');
    }

    public function show(Audition $userDetail)
    {
        // Return the view to show a specific user detail
        return view('audition.show', compact('userDetail'));
    }

    public function edit(Audition $userDetail)
    {
        // Return the view for editing a user detail
        return view('audition.edit', compact('userDetail'));
    }

    public function update(Request $request, Audition $userDetail)
    {
        $validatedData = $request->validate($this->validation_fields, $this->validation_msgs);

        $plan = $request->plan;
        $user_id = Auth::id();
        $plan_id = $this->plan_id($plan);

        if (!$plan_id) {
            $plan = Payment::where('user_id', $user_id)->where('payment_id', '!=', '')->where('status', '=', 'COMPLETED')->first()->plan_id ?? '';
            $plan_id = $plan;
            // return redirect()->route('home')->with('error', 'Plan not found');
        }
        // if (!Payment::where('user_id', Auth::id())->where('plan_id', $plan_id)->where('payment_id', '!=', '')->where('status', '=', 'COMPLETED')->exists()) {
        //     return redirect()->route('upload-video', ['plan' => $plan]);
        // }

        // Create or update user details
        Audition::updateOrCreate(
            ['user_id' => $user_id, 'plan_id' => $plan_id], // Assuming user_id is associated with the user details
            $validatedData
        );

        // Redirect to the index page with success message
        return redirect()->route('upload-video', ['plan' => $plan])->with('success', 'Audition details updated successfully');
    }

    public function destroy(Audition $userDetail)
    {
        // Delete the user detail
        $userDetail->delete();

        // Redirect to the index page with success message
        return redirect()->route('audition')->with('success', 'Audition details deleted successfully');
    }
}
