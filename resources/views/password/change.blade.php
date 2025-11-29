{{-- @extends('layout.app') --}}
@extends('customer.structure')

@section('title', 'Change Password')
<link rel="stylesheet" href="{{ asset('assets/css/editprofile.css') }}">

@section('content')

    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="box">
        <div class="profile-container">
            <!-- Left Sidebar -->
            <div class="profile-sidebar">
                <h1 class="profile-title">Change Password</h1>
            </div>

            <!-- Right Content -->
            <div class="profile-content">
                <div class="tabs">
                    <button class="tab-button active" data-tab="change-password">Change Password</button>
                </div>

                <!-- Change Password Tab -->
                <div class="tab-content active" id="change-password">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <!-- Show validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-row">
                            <div class="form-group">
                                <label for="current_password">Old Password</label>
                                <div class="password-container">
                                    <input type="password" name="current_password" id="current_password" placeholder="Enter old password" required>
                                    <a href="#" class="show-password" onclick="togglePassword(event, 'current_password')">👁️</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <div class="password-container">
                                    <input type="password" name="new_password" id="new_password" placeholder="Enter new password" required>
                                    <a href="#" class="show-password" onclick="togglePassword(event, 'new_password')">👁️</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="new_password_confirmation">Re-Enter New Password</label>
                                <div class="password-container">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Re-enter new password" required>
                                    <a href="#" class="show-password" onclick="togglePassword(event, 'new_password_confirmation')">👁️</a>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="{{asset('assets/js/login.js')}}"></script>
@endsection
