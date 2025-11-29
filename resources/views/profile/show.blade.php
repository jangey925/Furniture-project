{{-- @extends('layout.app') --}}
@extends('customer.structure')
@section('title', 'Profile')

<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="profile-card-container">
        <div class="profile-card">
            <div class="profile-header">
                @if (Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile Image" class="profile-image">
                @else
                    <div class="profile-placeholder">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="profile-info-header">
                    <h3 class="profile-name">{{ Auth::user()->name }}</h3>
                    <p class="profile-email">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="profile-details">
                <div class="detail-row">
                    <span class="detail-title">Name</span>
                    <span class="detail-value">{{ Auth::user()->name }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-title">Email account</span>
                    <span class="detail-value">{{ Auth::user()->email }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-title">Gender</span>
                    <span class="detail-value">{{ ucfirst(Auth::user()->gender) }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-title">Mobile number</span>
                    <span class="detail-value">
                        {{ Auth::user()->phone }}
                    </span>
                </div>

                <div class="detail-row">
                    <span class="detail-title">Address</span>
                    <span class="detail-value">{{ Auth::user()->address }}</span>
                </div>
            </div>

            <!-- Save Change Button -->
            <div class="btn-container">
                <a href="{{ route('profile.edit') }}" class="edit-btn">Edit Profile</a>
                <a href="{{ route('password.change') }}" class="edit-btn change-btn">Change Password</a>
            </div>
        </div>
    </div>
@endsection
