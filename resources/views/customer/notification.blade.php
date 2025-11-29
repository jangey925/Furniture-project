@extends('customer.structure')

@section('title', 'Notifications')

@section('content')
    <h3>Notifications</h3>
    @if ($notifications->isNotEmpty())
        <ul>
            @foreach ($notifications as $notification)
                <li>
                    <div class="notification" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px;">
                        <p>{{ $notification->data['message'] }}</p>

                        {{-- @php
                            $productUrl = $notification->data['product_url'] ?? null;
                        @endphp --}}

                        @php
                           $productUrl = route('products.showdetails', ['id' => $notification->data['product_id'] ?? null]);
                         @endphp

                        

                        @if ($productUrl)
                            <a href="{{ $productUrl }}" target="_blank" style="color: #007bff; text-decoration: none;">
                                View product
                            </a>
                        @else
                            <p>Unavailable.</p>
                        @endif

                        <small style="display: block; color: rgb(34, 16, 16); margin-top: 5px;">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="no-notifications" style="text-align: center; color: gray; margin-top: 20px; font-style: italic;">
            <p>No notifications to display.</p>
        </div>
    @endif
@endsection
