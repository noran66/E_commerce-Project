<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .sidebar { background-color: #fff; border-radius: 10px; padding: 20px; }
    .sidebar img { width: 100px; height: 100px; object-fit: cover; }
    .sidebar a { display: block; padding: 10px 0; color: #333; text-decoration: none; }
    .sidebar a.active { font-weight: bold; color: #0d6efd; }
    .card { border-radius: 10px; }
    .table th, .table td { vertical-align: middle; }
  </style>
</head>
<body>

      <!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">Furni<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item active">
						<a class="nav-link" href="{{ url('/') }}">Home</a>
					</li>
					<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
					<li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
					<li><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
					<li><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
					<li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>

				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li><a class="nav-link" href="{{ url('/auth') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
					<li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
				</ul>
			</div>
		</div>

	</nav>
	<!-- End Header/Navigation -->

    <!-- Start Hero Section -->
	<div class="hero" style="max-height: 100px;">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Profile <span clsas="d-block"></span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->



<div class="container mt-5">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-lg-3 mb-4">
      <div class="sidebar shadow-sm">
        <div class="text-center">
          <h5>{{ $user->name }}</h5>
          <p class="text-muted">{{ $user->email }}</p>
        </div>
        <hr>
        <nav class="nav flex-column">
          <a href="#" class="active">Dashboard</a>
          <a href="#orders">Orders</a>
          <a href="#settings">Account Settings</a>
<form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline">Logout</button>
</form>
        </nav>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
      <!-- Dashboard -->
      <div class="card shadow-sm p-4 mb-4">
        <h4 class="mb-3">Welcome, {{ $user->name }}!</h4>
        <p>Here’s a quick overview of your account and recent activity.</p>
        <div class="row text-center">
          <div class="col-md-4 mb-3">
            <div class="p-3 bg-light rounded">
              <h5>{{ $user->orders_count ?? 0 }}</h5>
              <small>Orders</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">Recent Orders</h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Date</th>
              <th>Status</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($user->cartItems as $order)
            <tr>
              <td>#{{ $order->id }}</td>
              <td>{{ $order->created_at->format('d/m/Y') }}</td>
              <td>
                @if($order->status == 'shipped')
                  <span class="badge bg-success">Shipped</span>
                @elseif($order->status == 'processing')
                  <span class="badge bg-warning text-dark">Processing</span>
                @else
                  <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
              </td>
              <td>${{ number_format($order->total, 2) }}</td>
              <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      
      <!-- Account Settings -->
      <div class="card shadow-sm p-4 mb-4" id="settings">
        <h5 class="mb-3">Account Settings</h5>
        <form action="{{ route('profile.update') }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Change Password">
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>

    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
