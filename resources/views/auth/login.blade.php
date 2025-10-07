<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Furni</title>
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
    }
    .auth-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .auth-container h2 {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        color: #333;
    }
    .auth-container input[type="email"],
    .auth-container input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
    }
    .auth-container button {
        width: 100%;
        padding: 12px;
        background: #3b5d50;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .auth-container button:hover {
        background: #2d453b;
    }
    .auth-container .links {
        text-align: center;
        margin-top: 15px;
    }
    .auth-container .links a {
        color: #3b5d50;
        text-decoration: none;
    }
    .auth-container .links a:hover {
        text-decoration: underline;
    }
    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: center;
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
                <li><a class="nav-link" href="{{ url('/login') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
                <li><a class="nav-link" href="{{ url('/cart') }}"><img src="{{ asset('assets/images/cart.svg') }}"></a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Form -->
<div class="auth-container">
    <h2>Login</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="links">
        <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
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
