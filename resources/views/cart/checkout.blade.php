<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
    <!-- Include Bootstrap CSS (optional, if used) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-0">
        <h1 class="text-center mb-4">Checkout</h1>

        <!-- Success or Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Checkout Form -->
        @if (session()->has('cart') && count(session('cart')) > 0)
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Cart Items Listing -->
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <h2 class="section-title">Cart Items</h2>
                            <ul>
                                @foreach (session('cart') as $id => $details)
                                    <li>
                                        <div class="checkout-item">
                                            <!-- Product Image -->
                                            <div class="checkout-item-image">
                                                @if (isset($details['image']))
                                                    <img src="{{ asset('storage/' . $details['image']) }}" 
                                                         alt="{{ $details['name'] }}" style="width: 250px; height: auto;">
                                                @else
                                                    <p>No Image Available</p>
                                                @endif
                                            </div>

                                            <!-- Product Name and Quantity -->
                                            <div class="checkout-item-details">
                                                <p><strong>{{ $details['name'] }}</strong></p>
                                                <p><strong>Quantity:</strong> {{ $details['quantity'] }}</p>
                                                <p><strong>Price:</strong> Rs.{{ $details['price'] }}</p>
                                                <br>
                                                <h4><strong>Total: Rs.{{ $details['quantity'] * $details['price'] }}</strong></h4>

                                                <!-- Optional Customization Fields -->
                                                <div class="form-group">
                                                    <label for="height_{{ $id }}">Height (Optional):</label>
                                                    <input type="text" name="heights[{{ $id }}]" id="height_{{ $id }}" class="form-control" placeholder="Enter height in ft (if applicable)">
                                                </div>

                                                <div class="form-group">
                                                    <label for="width_{{ $id }}">Width (Optional):</label>
                                                    <input type="text" name="widths[{{ $id }}]" id="width_{{ $id }}" class="form-control" placeholder="Enter width in ft (if applicable)">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Payment Method Section -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <h2 class="section-title">Payment Method</h2>
                            <div class="form-group">
                                <label for="payment_method">Select Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="">-- Choose Payment Method --</option>
                                    <option value="card">Credit/Debit Card</option>
                                    <option value="bank">Bank Transfer</option>
                                    <option value="esewa">Esewa</option>
                                    <option value="khalti">Khalti</option>
                                    <option value="cod">Cash on Delivery</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information Section -->
                <div class="card mb-4">
                    <h2 class="section-title">Shipping Information</h2>
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="number" class="form-control" name="phone" required>
                    </div>
                    <!-- Province Field -->
                    <div class="form-group">
                        <label for="province">Province:</label>
                        <select class="form-control" name="province" required>
                            <option value="">Select Province</option>
                            <option value="Koshi">Koshi Province</option>
                            <option value="Madhesh">Madhesh Province</option>
                            <option value="Bagmati">Bagmati Province</option>
                            <option value="Gandaki">Gandaki Province</option>
                            <option value="Lumbini">Lumbini Province</option>
                            <option value="Karnali">Karnali Province</option>
                            <option value="Sudurpashchim">Sudurpashchim Province</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Shipping Address:</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary py-2 px-4" style="background-color: #28a745">Place Order</button>
                </div>
            </form>
        @else
            <p>Your cart is empty. Please add items to your cart before proceeding with checkout.</p>
        @endif
    </div>
</body>
</html>
