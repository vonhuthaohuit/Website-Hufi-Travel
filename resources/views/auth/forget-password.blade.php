@extends('frontend.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/styleForgetPassword.css') }}">
@endpush
@section('renderBody')
<div class="container">
    <div class="forget-password">
        <h2 class="title">Forget Password</h2>
        <form action="{{ route('auth.forget.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="btn-reset">Send Reset Link</button>
        </form>
        <a href="/login" class="link">Back to Login</a>
    </div>
</div>

@push('script')
@endpush
@endsection
