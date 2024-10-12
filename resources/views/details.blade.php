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
                <label for="members">No of Member<span style="color:red">*</span></label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="number" class="form-control" id="members" name="members"
                        value="{{ old('members', isset($userDetail) ? $userDetail->members : '') }}"
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
        <div class="row">
            <div class="col-md-4">
                <label for="instagram">Instagram profile</label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="instagram" name="instagram"
                        value="{{ old('instagram', isset($userDetail) ? $userDetail->instagram : '') }}"
                        placeholder="Enter your Instagram link">
                </div>
            </div>
            <div class="col-md-4">
                <label for="youtube">YouTube profile</label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="youtube" name="youtube"
                        value="{{ old('youtube', isset($userDetail) ? $userDetail->youtube : '') }}"
                        placeholder="Enter your YouTube link">
                </div>
            </div>
            <div class="col-md-4">
                <label for="facebook">Facebook profile</label>
                <div class="form-floating form-floating-outline mb-3">
                    <input type="url" class="form-control" id="facebook" name="facebook"
                        value="{{ old('facebook', isset($userDetail) ? $userDetail->facebook : '') }}"
                        placeholder="Enter your Facebook link">
                </div>
            </div>
        </div>
        <!-- Guardian Information -->
        <hr>
        <div class="guardanForm d-block">
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
        <label id="photoLabel" for="photo">Photo<span style="color:red">*</span></label>
        <div class="form-floating form-floating-outline mb-3">
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button class="btn btn-primary d-grid w-100">Save Profile Details</button>

        <!-- Add other fields here -->

        <!-- <button type="submit" class="btn btn-primary">{{ isset($userDetail) ? 'Update' : 'Create' }}</button> -->
    </form>
@endsection
@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Function to update form elements based on the selected team type
            function updateFormElements(selectedValue) {
                var guardianForm = $('.guardanForm');
                var photoLabel = $('#photoLabel');
                var membersInput = $('#members');

                // Toggle guardian form visibility
                if (selectedValue === 'solo-jr') {
                    guardianForm.removeClass('d-none').addClass('d-block');
                } else {
                    guardianForm.removeClass('d-block').addClass('d-none');
                }

                // Update photo label and members input based on selection
                switch (selectedValue) {
                    case 'solo-jr':
                    case 'solo':
                        photoLabel.html('Upload Solo Photo<span style="color:red">*</span>');
                        membersInput.val(1).prop('disabled', true); // Set members to 1 and disable input
                        membersInput.removeAttr('min'); // Remove min attribute when not needed
                        break;
                    case 'duet':
                        photoLabel.html('Upload Duet Photo<span style="color:red">*</span>');
                        membersInput.val(2).prop('disabled', true); // Set members to 2 and disable input
                        membersInput.removeAttr('min'); // Remove min attribute when not needed
                        break;
                    case 'group':
                        photoLabel.html('Upload Group Photo<span style="color:red">*</span>');
                        membersInput.val(3).prop('disabled', false); // Set members to 3 and enable input
                        membersInput.attr('min', 3); // Set minimum to 3 for group
                        break;
                    default:
                        photoLabel.html('Photo<span style="color:red">*</span>');
                        membersInput.val('').prop('disabled', false); // Enable input for manual entry
                        membersInput.removeAttr('min'); // Remove min attribute for default
                        break;
                }
            }

            // Run on page load if a value is already selected
            var initialValue = $('#teamType').val();
            if (initialValue) {
                updateFormElements(initialValue);
            }

            // Event listener for when the teamType is changed
            $('#teamType').on('change', function() {
                var selectedValue = $(this).val();
                updateFormElements(selectedValue);
            });
        });
    </script>
@endsection
