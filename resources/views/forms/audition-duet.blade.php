@php
    $members = App\Models\UserDetail::where('user_id', Auth::user()->id)->value('members');
    $group_fields = ['name', 'dob', 'contact_no', 'gender', 'email', 'address'];
@endphp

<label for="group_name">Number of Group Members and Details: <span class="required">*</span></label>
<table class="table table-bordered mb-3">
    <tbody>
        <tr>
            <th>Contestants</th>
            <th>Full Name</th>
            <th>D.O.B</th>
            <th>Contact No.</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Full Address</th>
        </tr>

        @for ($i = 0; $i < $members; $i++)
            <tr>
                <th>Participant {{ $i + 1 }}</th>

                @foreach ($group_fields as $key => $group_field)
                    <td>
                        @if ($group_field === 'dob')
                            <!-- Date Selector for Date of Birth -->
                            <input type="date" class="form-control"
                                id="members[{{ $group_field }}][{{ $i }}]"
                                name="members[{{ $group_field }}][{{ $i }}]"
                                value="{{ old('members.' . $group_field . '.' . $i, isset($userDetail->members[$group_field][$i]) ? $userDetail->members[$group_field][$i] : '') }}"
                                required />
                        @elseif ($group_field === 'gender')
                            <!-- Dropdown for Gender Selection -->
                            <select class="form-control" id="members[{{ $group_field }}][{{ $i }}]"
                                name="members[{{ $group_field }}][{{ $i }}]" required>
                                <option value="">Select</option>
                                <option value="male"
                                    {{ old('members.' . $group_field . '.' . $i, isset($userDetail->members[$group_field][$i]) && $userDetail->members[$group_field][$i] == 'male' ? 'selected' : '') }}>
                                    Male</option>
                                <option value="female"
                                    {{ old('members.' . $group_field . '.' . $i, isset($userDetail->members[$group_field][$i]) && $userDetail->members[$group_field][$i] == 'female' ? 'selected' : '') }}>
                                    Female</option>
                                <option value="other"
                                    {{ old('members.' . $group_field . '.' . $i, isset($userDetail->members[$group_field][$i]) && $userDetail->members[$group_field][$i] == 'other' ? 'selected' : '') }}>
                                    Other</option>
                            </select>
                        @else
                            <!-- Default Text Input for Other Fields -->
                            <input type="text" class="form-control"
                                id="members[{{ $group_field }}][{{ $i }}]"
                                name="members[{{ $group_field }}][{{ $i }}]"
                                value="{{ old('members.' . $group_field . '.' . $i, isset($userDetail->members[$group_field][$i]) ? $userDetail->members[$group_field][$i] : '') }}"
                                required />
                        @endif
                    </td>
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>


<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="previous_performance" name="previous_performance" rows="3" required>{{ old('previous_performance', isset($userDetail) ? $userDetail->previous_performance : '') }}</textarea>
    <label for="previous_performance">Have you participated in any Dance Competition? <span
            class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="name_representing" name="name_representing" rows="3" required>{{ old('name_representing', isset($userDetail) ? $userDetail->name_representing : '') }}</textarea>
    <label for="name_representing">What should your name for representing your identity? <span
            class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="group_together" name="group_together" rows="3" required>{{ old('group_together', isset($userDetail) ? $userDetail->group_together : '') }}</textarea>
    <label for="group_together">How did you both came up together being a dance duo? <span
            class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="how_long_group_together" name="how_long_group_together" rows="3" required>{{ old('how_long_group_together', isset($userDetail) ? $userDetail->how_long_group_together : '') }}</textarea>
    <label for="how_long_group_together">For how many years you have been performing together and tell us your
        story?
        <span class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="choreograph" name="choreograph" rows="3" required>{{ old('choreograph', isset($userDetail) ? $userDetail->choreograph : '') }}</textarea>
    <label for="choreograph">Who will choreograph your performance, please share his/her details. ? <span
            class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="dance_form" name="dance_form" rows="3" required>{{ old('dance_form', isset($userDetail) ? $userDetail->dance_form : '') }}</textarea>
    <label for="dance_form">What dance form will you be performing on? <span class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="why_tup_expectations" name="why_tup_expectations" rows="3" required>{{ old('why_tup_expectations', isset($userDetail) ? $userDetail->why_tup_expectations : '') }}</textarea>
    <label for="why_tup_expectations">What are your expectations from the Competition? <span
            class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="future_plan_if_win" name="future_plan_if_win" rows="3" required>{{ old('future_plan_if_win', isset($userDetail) ? $userDetail->future_plan_if_win : '') }}</textarea>
    <label for="future_plan_if_win">What do you feel about the opportunities after participation in this Competition?
        <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="written_composed_song_inspiration" name="written_composed_song_inspiration"
        rows="3" required>{{ old('written_composed_song_inspiration', isset($userDetail) ? $userDetail->written_composed_song_inspiration : '') }}</textarea>
    <label for="written_composed_song_inspiration">Have you ever composed or performed any dance choreography by your
        own? If yes, we would like to know about your journey for the same. <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="biggest_strength_support" name="biggest_strength_support" rows="3" required>{{ old('biggest_strength_support', isset($userDetail) ? $userDetail->biggest_strength_support : '') }}</textarea>
    <label for="biggest_strength_support">Tell us some of your strengths and weaknesses. <span
            class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="main_goal_difficulties" name="main_goal_difficulties" rows="3" required>{{ old('main_goal_difficulties', isset($userDetail) ? $userDetail->main_goal_difficulties : '') }}</textarea>
    <label for="main_goal_difficulties">What is your goal and what are the difficulties you are facing to achieve the
        same? <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="unique_qualities" name="unique_qualities" rows="3" required>{{ old('unique_qualities', isset($userDetail) ? $userDetail->unique_qualities : '') }}</textarea>
    <label for="unique_qualities">What makes you better than others? <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="role_model_inspiration" name="role_model_inspiration" rows="3" required>{{ old('role_model_inspiration', isset($userDetail) ? $userDetail->role_model_inspiration : '') }}</textarea>
    <label for="role_model_inspiration">What/who is your inspiration for taking a step forward in Dancing?
        <span class="required">*</span></label>
</div>


<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="favorite_judge_why" name="favorite_judge_why" rows="3" required>{{ old('favorite_judge_why', isset($userDetail) ? $userDetail->favorite_judge_why : '') }}</textarea>
    <label for="favorite_judge_why">Who is your favorite Dancer and why? <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="rolemodel" name="rolemodel" rows="3" required>{{ old('rolemodel', isset($userDetail) ? $userDetail->rolemodel : '') }}</textarea>
    <label for="rolemodel">Whom do you consider to be your role model in Bollywood? <span
            class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="dance_style" name="dance_style" rows="3" required>{{ old('dance_style', isset($userDetail) ? $userDetail->dance_style : '') }}</textarea>
    <label for="dance_style">What Dance Style both of you can perform the best? (Any 2 Atleast)
        <span class="required">*</span></label>
</div>
