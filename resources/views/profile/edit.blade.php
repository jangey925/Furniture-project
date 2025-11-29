
{{-- @extends('layout.app') --}}
@extends('customer.structure')

@section('title', 'Edit Profile')
<link rel="stylesheet" href="{{ asset('assets/css/editprofile.css') }}">

@section('content')
    <div class="box">
        <div class="profile-container">
            <!-- Left Sidebar -->
            <div class="profile-sidebar">
                <h1 class="profile-title">Edit Profile</h1>
                <div class="profile-image">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('default-profile.png') }}" alt="Profile Picture">
                    <i class="fa-solid fa-pen" id="editIcon"></i>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                        <!-- Hidden file input -->
                        <input type="file" name="profile_image" id="profileImageInput" accept="image/*"
                            style="display: none;">
                </div>
            </div>

            <!-- Right Content -->
            <div class="profile-content">
                <div class="tabs">
                    <button class="tab-button active" data-tab="personal-info">Personal Info</button>
                </div>

                <!-- Personal Info Tab -->
                <div class="tab-content active" id="personal-info">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" value="{{ Auth::user()->address }}">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                    </div>



                    {{-- <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="{{ Auth::user()->dob }}">
                        </div> --}}

                        <div class="form-group">
                            <label for="gender">What's Your Gender?</label>
                            <div class="gender-options">
                                <label>
                                    <input type="radio" name="gender" value="male"
                                        {{ Auth::user()->gender == 'male' ? 'checked' : '' }}> Male
                                </label>
                                <label>
                                    <input type="radio" name="gender" value="female"
                                        {{ Auth::user()->gender == 'female' ? 'checked' : '' }}> Female
                                </label>
                                <label>
                                    <input type="radio" name="other" value="other"
                                        {{ Auth::user()->gender == 'other' ? 'checked' : '' }}> Other
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Save Changes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editIcon = document.getElementById('editIcon');
            const profileImageInput = document.getElementById('profileImageInput');
            const profilePreview = document.getElementById('profilePreview');

            // Click event for pen icon
            editIcon.addEventListener('click', () => {
                profileImageInput.click();
            });

            // Preview the selected image
            profileImageInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        profilePreview.src = e.target.result; 
                    };

                    reader.readAsDataURL(file); 
                }
            });
        });
    </script>
@endsection
