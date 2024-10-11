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
    <textarea class="form-control" id="choreograph " name="choreograph " rows="3" required>{{ old('choreograph ', isset($userDetail) ? $userDetail->choreograph : '') }}</textarea>
    <label for="choreograph ">Who will choreograph your performance, please share his/her details. ? <span
            class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="dance_form" name="dance_form" rows="3" required>{{ old('dance_form', isset($userDetail) ? $userDetail->dance_form : '') }}</textarea>
    <label for="dance_form">What dance form will you be performing on? <span class="required">*</span></label>
</div>
<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="future_plan_if_win" name="future_plan_if_win" rows="3" required>{{ old('future_plan_if_win', isset($userDetail) ? $userDetail->future_plan_if_win : '') }}</textarea>
    <label for="future_plan_if_win">What do you feel about the opportunities after participation in this competition?
        <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="biggest_strength_support" name="biggest_strength_support" rows="3" required>{{ old('biggest_strength_support', isset($userDetail) ? $userDetail->biggest_strength_support : '') }}</textarea>
    <label for="biggest_strength_support">Tell us some of your strengths and weaknesses. <span
            class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="favorite_judge_why" name="favorite_judge_why" rows="3" required>{{ old('favorite_judge_why', isset($userDetail) ? $userDetail->favorite_judge_why : '') }}</textarea>
    <label for="favorite_judge_why">Who is your favorite Dancer and why? <span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="rolemodel" name="rolemodel" rows="3" required>{{ old('rolemodel', isset($userDetail) ? $userDetail->rolemodel : '') }}</textarea>
    <label for="rolemodel">Whom do you consider to be your role model?<span class="required">*</span></label>
</div>

<div class="form-floatingXXX  d-flex flex-column-reverse form-floating-outline mb-3">
    <textarea class="form-control" id="dance_style" name="dance_style" rows="3" required>{{ old('dance_style', isset($userDetail) ? $userDetail->dance_style : '') }}</textarea>
    <label for="dance_style">What Dance Style you can perform the best? (Any 2 Atleast)
        <span class="required">*</span></label>
</div>
