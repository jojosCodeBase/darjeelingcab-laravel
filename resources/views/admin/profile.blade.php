@extends('layouts/admin-main')
@section('title', 'Profile Edit')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-12   ">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4>Profile Information</h4>
                                <p>Update your account's profile information and email address.</p>
                                <form method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="@if(session('errors')){{ old('email') }} @else{{ Auth::user()->email }}@endif" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="submit" class="btn btn-primary w-25" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-12   ">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h4>Update Password</h4>
                                <p>Ensure your account is using a long, random password to stay secure.</p>
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password">
                                        <div class="mt-2 text-danger">
                                            @if ($errors->updatePassword->has('current_password'))
                                                <span>{{ $errors->updatePassword->first('current_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password">
                                        <div class="mt-2 text-danger">
                                            @if ($errors->updatePassword->has('password'))
                                                <span>{{ $errors->updatePassword->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="submit" class="btn btn-primary w-25" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
