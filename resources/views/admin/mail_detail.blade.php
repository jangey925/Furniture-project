@extends('layout.app')

@section('title', 'Mail Detail')

@section('content')
<div class="container mt-4">
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>{{ $contact->subject }}</h3>
            <small>From: {{ $contact->name }} ({{ $contact->email }})</small>
        </div>
        <div class="card-body">
            <p>{{ $contact->message }}</p>
            @if($contact->attachment)
                <p>Attachment: <a href="{{ asset('storage/' . $contact->attachment) }}" target="_blank">Download</a></p>
            @endif
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="replyBtn">Reply</button>
        </div>
    </div>

    <div id="replyForm" class="mt-4" style="display: none;">
        <form method="POST" action="{{ route('admin.reply', $contact->id) }}">
            @csrf
            <div class="form-group">
                <label for="replyMessage">Your Reply</label>
                <textarea class="form-control" id="replyMessage" name="replyMessage" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Send Reply</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const replyBtn = document.getElementById('replyBtn');
        const replyForm = document.getElementById('replyForm');

        replyBtn.addEventListener('click', () => {
            replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>
@endsection
