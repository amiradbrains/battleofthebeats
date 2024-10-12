@extends('layouts.auth')

@section('content')
    <style>
        .wizard .nav-tabsxxx>li:not(.active) a i {
            color: #000 !important;
        }
    </style>
    @include('partials.steps', ['active' => 'Audition'])
    <h4 class="mb-2">Adventure starts here 🚀</h4>
    <p class="mb-4">Just one step away!</p>
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
        action="{{ isset($userDetail) ? route('audition.update', [$userDetail->id, 'plan' => request()->plan]) : route('audition.store', ['plan' => request()->plan]) }}">
        @csrf
        @if (isset($userDetail))
            @method('PUT')
        @endif


        @php
            $ing = 'Singing';
            $er = 'singer';
            $tnclink = env('TnCTNDS');
            $prvcpclink = env('PrvpcTNDS');
            $refcanlink = env('RefCanTNDS');
            if (str_contains(request()->plan, 'TNDS')) {
                $ing = 'Dancing';
                $er = 'dancer';
                $tnclink = env('TnCTNDS');
            }
        @endphp

        @include('forms.audition-' . strtolower(Auth::user()->details['teamType']))
        {{-- <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="{{ $tnclink }}">privacy policy & terms</a>
                    <span class="required">*</span></label>
            </div>
        </div> --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="responsibility" name="responsibility" value="1"
                {{ old('responsibility', isset($userDetail) && $userDetail->responsibility) ? 'checked' : '' }}>
            <label class="form-check-label" for="responsibility">I have answered all questions to the best of my ability and
                understand that I am retaining the responsibility of representing my team and receiving all correspondence
                for
                Battle of the Beats December 2024. <span class="required">*</span></label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="privacy_policy" name="privacy_policy" value="1"
                {{ old('privacy_policy', isset($userDetail) && $userDetail->privacy_policy) ? 'checked' : '' }}>
            <label class="form-check-label" for="privacy_policy">I have understood the <a href="{{ $prvcpclink }}">
                    Privacy Policy</a> thoroughly and I
                accept it
                moving forward. <span class="required">*</span></label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="terms_conditions" name="terms_conditions" value="1"
                {{ old('terms_conditions', isset($userDetail) && $userDetail->terms_conditions) ? 'checked' : '' }}>
            <label class="form-check-label" for="terms_conditions">I have understood the <a href="{{ $tnclink }}">Terms
                    and Conditions</a> for
                participation
                thoroughly and I accept it moving forward. <span class="required">*</span></label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="refund_policy" name="refund_policy" value="1"
                {{ old('refund_policy', isset($userDetail) && $userDetail->refund_policy) ? 'checked' : '' }}>
            <label class="form-check-label" for="refund_policy">I understand the <a href="{{ $refcanlink }}">Refund and
                    cancellation</a> policy thoroughly
                and I
                accept it moving forward. <span class="required">*</span></label>
        </div>
        <button class="btn btn-primary d-grid w-100">Next: Upload Video</button>

        <!-- Add other fields here -->


    </form>
@endsection
