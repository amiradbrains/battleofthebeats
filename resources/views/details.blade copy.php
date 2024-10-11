@extends('layouts.auth')

@section('content')
    <style>
        .wizard .nav-tabsxxx>li:not(.active) a i {
            color: #000 !important;
        }
    </style>
    @php
        //$ing = 'Singing';
        //$er = 'singer';
        $tnclink = env('TnCTNSS');
        if (str_contains(request()->plan, 'TNDS')) {
            //$ing = 'Dancing';
            //$er = 'dancer';
            $tnclink = env('TnCTNDS');
        }
    @endphp
    @include('partials.steps', ['active' => 'Profile'])
    <h4 class="mb-2">Tell us about your self </h4>
    <p class="mb-4">Just few step away!</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST"
        action="{{ isset($userDetail) ? route('user-details.update', $userDetail->id) : route('user-details.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if (isset($userDetail))
            @method('PUT')
        @endif

        @php
            $proviences = [
                'Andhra Pradesh',
                'Arunachal Pradesh',
                'Assam',
                'Bihar',
                'Chhattisgarh',
                'Goa',
                'Gujarat',
                'Haryana',
                'Himachal Pradesh',
                'Jharkhand',
                'Karnataka',
                'Kerala',
                'Madhya Pradesh',
                'Maharashtra',
                'Manipur',
                'Meghalaya',
                'Mizoram',
                'Nagaland',
                'Odisha',
                'Punjab',
                'Rajasthan',
                'Sikkim',
                'Tamil Nadu',
                'Telangana',
                'Tripura',
                'Uttar Pradesh',
                'Uttarakhand',
                'West Bengal',
            ];

            $how_know = ['TV ads', 'Social Media', 'Newspaper ads', 'Outdoor ads', 'Others'];
        @endphp



        <div class="row">
            <div class="col-lg-4 col-md-6">
                <label for="first_name">First Name<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ old('first_name', isset($userDetail) ? $userDetail->first_name : '') }}"
                        placeholder="Enter your first name" required />

                    <input type="hidden" value="{{ request()->plan }}" name="plan">
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <label for="last_name">Last Name<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ old('last_name', isset($userDetail) ? $userDetail->last_name : '') }}"
                        placeholder="Enter your last name" required />
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="gender">Gender<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male"
                            {{ old('gender', isset($userDetail) ? $userDetail->gender : '') == 'male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="female"
                            {{ old('gender', isset($userDetail) ? $userDetail->gender : '') == 'female' ? 'selected' : '' }}>
                            Female</option>
                        <option value="other"
                            {{ old('gender', isset($userDetail) ? $userDetail->gender : '') == 'other' ? 'selected' : '' }}>
                            Other</option>
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-4">
                                                                                            <div class="form-floating form-floating-outline mb-3">
                                                                                                <input type="text" class="form-control" id="stagename" name="stagename" value="{{ old('stagename', isset($userDetail) ? $userDetail->stagename : '') }}" placeholder="Enter your stage name">
                                                                                                <label for="stagename">Stage Name<span style="color:red">*</span></label>
                                                                                            </div>
                                                                                        </div> -->

            {{-- <div class="col-lg-4 col-md-6">
                <label for="relationship_status">Relationship Status<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <select class="form-select" id="relationship_status" name="relationship_status">
                        <option value="single"
                            {{ old('relationship_status', isset($userDetail) ? $userDetail->relationship_status : '') == 'single' ? 'selected' : '' }}>
                            Single</option>
                        <option value="married"
                            {{ old('relationship_status', isset($userDetail) ? $userDetail->relationship_status : '') == 'married' ? 'selected' : '' }}>
                            Married</option>
                    </select>
                </div>
            </div> --}}

            <div class="col-lg-4 col-md-6">
                <label for="date_of_birth">Date of Birth<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                        value="{{ old('date_of_birth', isset($userDetail) ? $userDetail->date_of_birth : '') }}" required />
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="state">Team Type<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <select class="form-select" id="teamType" name="teamType" required>
                        <option value="" selected disabled>Select Team Type</option>
                        <option value="solo-jr"
                            {{ old('teamType', isset($userDetail) ? $userDetail->teamType : '') == 'solo-jr' ? 'selected' : '' }}>
                            Solo Jr</option>
                        <option value="solo"
                            {{ old('teamType', isset($userDetail) ? $userDetail->teamType : '') == 'solo' ? 'selected' : '' }}>
                            Solo</option>
                        <option value="duet"
                            {{ old('teamType', isset($userDetail) ? $userDetail->teamType : '') == 'duet' ? 'selected' : '' }}>
                            Duet</option>
                        <option value="group"
                            {{ old('teamType', isset($userDetail) ? $userDetail->teamType : '') == 'group' ? 'selected' : '' }}>
                            Group</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="city">No of Member<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="number" class="form-control" id="members" name="members"
                        value="{{ old('city', isset($userDetail) ? $userDetail->members : '') }}"
                        placeholder="No of Member" required />
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-lg-4 col-md-6">
                <label for="city">City<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city', isset($userDetail) ? $userDetail->city : '') }}"
                        placeholder="Enter your city" required />
                </div>
            </div>


            <div class="col-lg-4 col-md-6">
                <label for="state">State<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <select class="form-select" id="state" name="state" required>
                        <option value="" selected disabled>Select state</option>
                        @foreach ($proviences as $provience)
                            <option value="{{ $provience }}"
                                {{ old('state', isset($userDetail) ? $userDetail->state : '') == $provience ? 'selected' : '' }}>
                                {{ $provience }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <label for="pin_code">Postal Code<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                        value="{{ old('pin_code', isset($userDetail) ? $userDetail->pin_code : '') }}"
                        placeholder="Enter your postal code" required />
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <label for="phone">Phone<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="tel" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', isset($userDetail) ? $userDetail->phone : '') }}"
                        placeholder="Enter your phone number" required />
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <label for="address">Address<span style="color:red">*</span></label>

                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', isset($userDetail) ? $userDetail->address : '') }}"
                        placeholder="Enter your address" required />
                </div>
            </div>
        </div>
        {{-- <div class="row">
        <div class="col-md-4">
        <label for="education">Education<span style="color:red">*</span></label>

            <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="education" name="education" value="{{ old('education', isset($userDetail) ? $userDetail->education : '') }}" placeholder="Enter your education">
            </div>
        </div>
        <div class="col-md-4">
        <label for="occupation">Occupation<span style="color:red">*</span></label>

            <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', isset($userDetail) ? $userDetail->occupation : '') }}" placeholder="Enter your occupation">
            </div>
        </div>
        <div class="col-md-4">
        <label for="work_experience">Work Experience<span style="color:red">*</span></label>

            <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="work_experience" name="work_experience" value="{{ old('work_experience', isset($userDetail) ? $userDetail->work_experience : '') }}" placeholder="Enter your work experience">
            </div>
        </div>
    </div> --}}

        <div class="row">
            <div class="col-md-4">
                <label for="instagram">Instagram Link<span style="color:red">*</span></label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="instagram" name="instagram"
                        value="{{ old('instagram', isset($userDetail) ? $userDetail->instagram : '') }}"
                        placeholder="Enter your Instagram link">
                </div>
            </div>
            <div class="col-md-4">
                <label for="youtube">YouTube Link<span style="color:red">*</span></label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="youtube" name="youtube"
                        value="{{ old('youtube', isset($userDetail) ? $userDetail->youtube : '') }}"
                        placeholder="Enter your YouTube link">
                </div>
            </div>
            <div class="col-md-4">
                <label for="facebook">Facebook Link<span style="color:red">*</span></label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="facebook" name="facebook"
                        value="{{ old('facebook', isset($userDetail) ? $userDetail->facebook : '') }}"
                        placeholder="Enter your Facebook link">
                </div>
            </div>

        </div>


        <!-- Guardian Information -->
        <hr>
        <div class="guardanForm d-none">
            <div class="row">
                <div class="col-md-4">
                    <label for="g_first_name">Guardian's First Name<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_first_name" name="g_first_name"
                            value="{{ old('g_first_name', isset($userDetail) ? $userDetail->g_first_name : '') }}"
                            placeholder="Enter guardian's first name">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="g_last_name">Guardian's Last Name<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_last_name" name="g_last_name"
                            value="{{ old('g_last_name', isset($userDetail) ? $userDetail->g_last_name : '') }}"
                            placeholder="Enter guardian's last name">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="g_phone">Guardian's Phone<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="tel" class="form-control" id="g_phone" name="g_phone"
                            value="{{ old('g_phone', isset($userDetail) ? $userDetail->g_phone : '') }}"
                            placeholder="Enter guardian's phone number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="g_address">Guardian's Address<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_address" name="g_address"
                            value="{{ old('g_address', isset($userDetail) ? $userDetail->g_address : '') }}"
                            placeholder="Enter guardian's address">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="g_pin_code">Guardian's Postal Code<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_pin_code" name="g_pin_code"
                            value="{{ old('g_pin_code', isset($userDetail) ? $userDetail->g_pin_code : '') }}"
                            placeholder="Enter guardian's postal code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="g_city">Guardian's City<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_city" name="g_city"
                            value="{{ old('g_city', isset($userDetail) ? $userDetail->g_city : '') }}"
                            placeholder="Enter guardian's city">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="g_state">Guardian's State<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="text" class="form-control" id="g_state" name="g_state"
                            value="{{ old('g_state', isset($userDetail) ? $userDetail->g_state : '') }}"
                            placeholder="Enter guardian's state">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="g_email">Guardian's Email<span style="color:red">*</span></label>
                    <div class="form-floating form-floating-outline mb-3">
                        <input type="email" class="form-control" id="g_email" name="g_email"
                            value="{{ old('g_email', isset($userDetail) ? $userDetail->g_email : '') }}"
                            placeholder="Enter guardian's email">
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="previous_performance" name="previous_performance" rows="3">{{ old('previous_performance', isset($userDetail) ? $userDetail->previous_performance : '') }}</textarea>
                                                                                        <label for="previous_performance">Previous Performance<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="music_experience" name="music_experience" rows="3">{{ old('music_experience', isset($userDetail) ? $userDetail->music_experience : '') }}</textarea>
                                                                                        <label for="music_experience">Music Experience<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="music_qualification" name="music_qualification" rows="3">{{ old('music_qualification', isset($userDetail) ? $userDetail->music_qualification : '') }}</textarea>
                                                                                        <label for="music_qualification">Music Qualification<span style="color:red">*</span></label>
                                                                                    </div> -->

        {{-- <div class="form-floating form-floating-outline mb-3">
        <textarea class="form-control" id="hobbies" name="hobbies" rows="3">{{ old('hobbies', isset($userDetail) ? $userDetail->hobbies : '') }}</textarea>
        <label for="hobbies">Hobbies<span style="color:red">*</span></label>
    </div>

    <div class="form-floating form-floating-outline mb-3">
        <textarea class="form-control" id="describe_yourself" name="describe_yourself" rows="3">{{ old('describe_yourself', isset($userDetail) ? $userDetail->describe_yourself : '') }}</textarea>
        <label for="describe_yourself">Describe Yourself<span style="color:red">*</span></label>
    </div> --}}

        <!-- <div class="form-floating form-floating-outline mb-3">
                                                                                        <select class="form-select" id="state" name="state">
                                                                                            @foreach ($how_know as $hw)
    <option value="{{ $hw }}" {{ old('how_know_about_auditions', isset($userDetail) ? $userDetail->how_know_about_auditions : '') == $hw ? 'selected' : '' }}>{{ $hw }}</option>
    @endforeach
                                                                                        </select>
                                                                                        <label for="how_know_about_auditions">How did you know about auditions?<span style="color:red">*</span></label>
                                                                                    </div>


                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="how_know_about_auditions_detail" name="how_know_about_auditions_detail"
                                                                                            rows="3">{{ old('how_know_about_auditions_detail', isset($userDetail) ? $userDetail->how_know_about_auditions_detail : '') }}</textarea>
                                                                                        <label for="how_know_about_auditions_detail">Please provide details<span style="color:red">*</span></label>
                                                                                    </div> -->
        <label id="photoLabel" for="photo">Photo<span style="color:red">*</span></label>
        <div class="form-floating form-floating-outline mb-3">
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <!-- <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="why_tup_expectations" name="why_tup_expectations" rows="3">{{ old('why_tup_expectations', isset($userDetail) ? $userDetail->why_tup_expectations : '') }}</textarea>
                                                                                        <label for="why_tup_expectations">Why do you have expectations from Sa Re Ga Ma Pa?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="why_we_select_you" name="why_we_select_you" rows="3">{{ old('why_we_select_you', isset($userDetail) ? $userDetail->why_we_select_you : '') }}</textarea>
                                                                                        <label for="why_we_select_you">Why should we select you?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="future_plan_if_win" name="future_plan_if_win" rows="3">{{ old('future_plan_if_win', isset($userDetail) ? $userDetail->future_plan_if_win : '') }}</textarea>
                                                                                        <label for="future_plan_if_win">What are your future plans if you win?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="opinion_new_season_tup" name="opinion_new_season_tup" rows="3">{{ old('opinion_new_season_tup', isset($userDetail) ? $userDetail->opinion_new_season_tup : '') }}</textarea>
                                                                                        <label for="opinion_new_season_tup">What's your opinion on the new season of Sa Re Ga Ma Pa?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="written_composed_song_inspiration" name="written_composed_song_inspiration"
                                                                                            rows="3">{{ old('written_composed_song_inspiration', isset($userDetail) ? $userDetail->written_composed_song_inspiration : '') }}</textarea>
                                                                                        <label for="written_composed_song_inspiration">Have you written/composed any song? What's the inspiration behind it?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="life_changing_incident" name="life_changing_incident" rows="3">{{ old('life_changing_incident', isset($userDetail) ? $userDetail->life_changing_incident : '') }}</textarea>
                                                                                        <label for="life_changing_incident">Share a life-changing incident you've experienced.<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="change_about_self_love_about_self" name="change_about_self_love_about_self"
                                                                                            rows="3">{{ old('change_about_self_love_about_self', isset($userDetail) ? $userDetail->change_about_self_love_about_self : '') }}</textarea>
                                                                                        <label for="change_about_self_love_about_self">What would you like to change about yourself and what do you love about yourself?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="unique_qualities" name="unique_qualities" rows="3">{{ old('unique_qualities', isset($userDetail) ? $userDetail->unique_qualities : '') }}</textarea>
                                                                                        <label for="unique_qualities">Share your unique qualities.<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="main_goal_difficulties" name="main_goal_difficulties" rows="3">{{ old('main_goal_difficulties', isset($userDetail) ? $userDetail->main_goal_difficulties : '') }}</textarea>
                                                                                        <label for="main_goal_difficulties">What are your main goals and what difficulties have you faced in achieving them?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="biggest_strength_support" name="biggest_strength_support" rows="3">{{ old('biggest_strength_support', isset($userDetail) ? $userDetail->biggest_strength_support : '') }}</textarea>
                                                                                        <label for="biggest_strength_support">What's your biggest strength and what support do you have?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="favorite_judge_why" name="favorite_judge_why" rows="3">{{ old('favorite_judge_why', isset($userDetail) ? $userDetail->favorite_judge_why : '') }}</textarea>
                                                                                        <label for="favorite_judge_why">Who's your favorite judge and why?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="role_model_inspiration" name="role_model_inspiration" rows="3">{{ old('role_model_inspiration', isset($userDetail) ? $userDetail->role_model_inspiration : '') }}</textarea>
                                                                                        <label for="role_model_inspiration">Who's your role model and what inspires you about them?<span style="color:red">*</span></label>
                                                                                    </div>

                                                                                    <div class="form-floating form-floating-outline mb-3">
                                                                                        <textarea class="form-control" id="prepared_songs" name="prepared_songs" rows="3">{{ old('prepared_songs', isset($userDetail) ? $userDetail->prepared_songs : '') }}</textarea>
                                                                                        <label for="prepared_songs">What songs are you prepared to perform?<span style="color:red">*</span></label>
                                                                                    </div> -->
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="{{ $tnclink }}">privacy policy & terms</a>
                    <span style="color:red">*</span></label>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100">Save Profile Details</button>

        <!-- Add other fields here -->

        <!-- <button type="submit" class="btn btn-primary">{{ isset($userDetail) ? 'Update' : 'Create' }}</button> -->
    </form>
@endsection
@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#teamType').on('change', function() {
                var selectedValue = $(this).val();
                var guardianForm = $('.guardanForm');
                var photoLabel = $('#photoLabel');

                // Toggle guardian form visibility
                if (selectedValue === 'solo-jr') {
                    guardianForm.removeClass('d-none').addClass('d-block');
                } else {
                    guardianForm.removeClass('d-block').addClass('d-none');
                }

                // Update photo label based on selection
                switch (selectedValue) {
                    case 'solo-jr':
                    case 'solo':
                        photoLabel.html('Solo Photo<span style="color:red">*</span>');
                        break;
                    case 'duet':
                        photoLabel.html('Duet Photo<span style="color:red">*</span>');
                        break;
                    case 'group':
                        photoLabel.html('Group Photo<span style="color:red">*</span>');
                        break;
                    default:
                        photoLabel.html('Photo<span style="color:red">*</span>');
                        break;
                }
            });
        });
    </script>
@endsection
