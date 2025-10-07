<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    .dashboard-container {
        display: flex;
        max-width: 1200px;
        margin: 50px auto;
        gap: 30px;
    }
    .profile, .cart {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        flex: 1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .profile h2, .cart h2 {
        margin-bottom: 20px;
        color: #333;
    }
    .profile p {
        margin-bottom: 10px;
        font-size: 16px;
    }
    .cart table {
        width: 100%;
        border-collapse: collapse;
    }
    .cart table th, .cart table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    .cart table th {
        background: #f4f4f4;
    }
    button {
        padding: 10px 20px;
        background: #dc3545;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #c82333;
    }
</style>
</head>
<body>
<div class="dashboard-container">

    <div class="profile">
        <h2>Profile Information</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Member since:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="cart">
        <h2>Your Cart</h2>
        @if($cartItems->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

</div>
</body>
</html>
