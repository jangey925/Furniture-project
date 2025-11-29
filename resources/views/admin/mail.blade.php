@extends('layout.app')

@section('title', 'Contact Messages')

@section('content')
<div class="container mt-0">
    <div class="table-responsive mailbox-messages">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>
                        <div class="icheck-primary">
                            <input type="checkbox" id="checkAll">
                            <label for="checkAll"></label>
                        </div>
                    </th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Attachment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>
                            <div class="icheck-primary">
                                <input type="checkbox" value="{{ $contact->id }}" class="checkbox-item" id="check{{ $loop->index }}">
                                <label for="check{{ $loop->index }}"></label>
                            </div>
                        </td>
                        <td class="mailbox-name">
                            <a href="{{ route('admin.mail', $contact->id) }}">{{ $contact->name }}</a>
                        </td>
                        <td class="mailbox-subject">
                            <b>{{ $contact->subject }}</b> - {{ Str::limit($contact->message, 50) }}
                        </td>
                        <td class="mailbox-attachment">
                            @if($contact->attachment)
                                <i class="fas fa-paperclip"></i>
                            @endif
                        </td>
                        <td class="mailbox-date">
                            {{ $contact->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="card-footer p-0">
        <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                <i class="far fa-square"></i>
            </button>
            <div class="btn-group">
                <!-- Delete button -->
                <button type="button" class="btn btn-default btn-sm" id="deleteBtn">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
            <!-- Refresh button -->
            <button type="button" class="btn btn-default btn-sm" id="refreshBtn">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Select all 
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('.checkbox-item');

    checkAll.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll.checked;
        });
    });

    // Refresh button 
    document.getElementById('refreshBtn').addEventListener('click', () => {
        location.reload();
    });
});
</script>
@endsection
