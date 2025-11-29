@extends('layout.layout')

@section('title', 'Contact Us')

<link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">

@section('content')
 @auth
<section class="contact-container">
    <div class="contact-form">
       
        <h2>Contact Us</h2>
        <p>Drop us a message</p>
        @if (session('success'))
            <div class="alert alert-success"
                style="border-radius: 5px; padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger"
                style="border-radius: 5px; padding: 15px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="7" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        @else
            <script>
                window.location.href = "{{ route('login') }}";
            </script>
        @endauth
    </div>

    <div class="contact-image">
        <img src="{{ asset('assets/images/home/contactus.png') }}" alt="Image" />
    </div>
</section>
@endsection
