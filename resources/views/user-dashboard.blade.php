<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard</title>
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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

  <!-- Navbar -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Furni<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
                <li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
                <li><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
                <li><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
                <li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link" href="#"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
                <li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
            </ul>
        </div>
    </div>
</nav>


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
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

</div>

	<!-- Start Footer Section -->
	<footer class="footer-section">
		<div class="container relative">

			<div class="sofa-img">
				<img src="{{ asset('assets/images/sofa.png') }}" alt="Image" class="img-fluid">
			</div>

			<div class="row">
				<div class="col-lg-8">

					

					@if(session('success'))
					<div class="alert alert-success mt-3">
						{{ session('success') }}
					</div>
					@endif


					<div class="subscription-form">
						<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('assets/images/envelope-outline.svg') }}"
									alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

						<form action="{{ route('subscribe.store') }}" method="POST" class="row g-3">
							@csrf
							<div class="col-auto">
								<input 
									type="text" 
									name="name" 
									class="form-control @error('name') is-invalid @enderror" 
									placeholder="Enter your name" 
									value="{{ old('name') }}"
									required
								>
								@error('name')
									<div class="invalid-feedback d-block">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-auto">
								<input 
									type="email" 
									name="email" 
									class="form-control @error('email') is-invalid @enderror" 
									placeholder="Enter your email" 
									value="{{ old('email') }}"
									required
								>
								@error('email')
									<div class="invalid-feedback d-block">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="col-auto">
								<button type="submit" class="btn btn-primary">
									<span class="fa fa-paper-plane"></span>
								</button>
							</div>

							@if (session('success'))
								<div class="col-12">
									<div class="alert alert-success mt-2 mb-0 p-2 text-center">
										{{ session('success') }}
									</div>
								</div>
							@endif
						</form>
					</div>
				</div>
			</div>

			<div class="row g-5 mb-5">
				<div class="col-lg-4">
					<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
					<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus
						malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.
						Pellentesque habitant</p>

					<ul class="list-unstyled custom-social">
						<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
					</ul>
				</div>

				<div class="col-lg-8">
					<div class="row links-wrap">
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="{{ url('/about') }}">About us</a></li>
								<li><a href="{{ url('/service') }}">Services</a></li>
								<li><a href="{{ url('/blog') }}">Blog</a></li>
								<li><a href="{{ url('/contact') }}">Contact us</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Support</a></li>
								<li><a href="#">Knowledge base</a></li>
								<li><a href="#">Live chat</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Jobs</a></li>
								<li><a href="#">Our team</a></li>
								<li><a href="#">Leadership</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Nordic Chair</a></li>
								<li><a href="#">Kruzo Aero</a></li>
								<li><a href="#">Ergonomic Chair</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;
							<script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Designed with love by team2 
						</p>
					</div>

					<div class="col-lg-6 text-center text-lg-end">
						<ul class="list-unstyled d-inline-flex ms-auto">
							<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</div>

				</div>
			</div>

		</div>
	</footer>
	<!-- End Footer Section -->

<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
