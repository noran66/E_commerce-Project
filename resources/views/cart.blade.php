<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<title>Furni for Furniture and Interior Design Websites </title>
</head>
<style>
.btn-custom {
    border: none;
    color: #fff;
    transition: all 0.3s ease;
}

.btn-light-bg {
    background-color: black;
	text-decoration: none;
}

.btn-light-bg:hover {
    background-color: black;
    transform: scale(1.005);
	color: #fff;
	text-decoration: none;
}

.btn-dark-bg {
    background: linear-gradient(135deg, #111, #333);
}

.btn-dark-bg:hover {
    background: linear-gradient(135deg, #222, #000);
    transform: scale(1.005);
}

.hover-scale {
    transition: all 0.3s ease;
}

</style>
<body>

	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">Furni<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item ">
						<a class="nav-link" href="{{ url('/') }}">Home</a>
					</li>
					<li><a class="nav-link" href="{{ url('/shop') }}">Shop</a></li>
					<li><a class="nav-link" href="{{ url('/about') }}">About us</a></li>
					<li><a class="nav-link" href="{{ url('/service') }}">Services</a></li>
					<li><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
					<li><a class="nav-link" href="{{ url('/contact') }}">Contact us</a></li>
				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li><a class="nav-link" href="{{ auth()->check() ? route('user.dashboard') : route('login') }}"><img src="{{ asset('assets/images/user.svg') }}"></a></li>
					<li><a class="nav-link" href="{{ url('/cart') }}"><img
								src="{{ asset('assets/images/cart.svg') }}"></a></li>
				</ul>
			</div>
		</div>

	</nav>
	<!-- End Header/Navigation -->

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Cart</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="site-blocks-table">

                    {{-- form تحديث الكارت --}}
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <table class="table align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/' . $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-width: 70px;">
                                        </td>
                                        <td class="text-start">
                                            <strong>{{ $item->product->name }}</strong>
                                        </td>
                                        <td>${{ number_format($item->product->price, 2) }}</td>
                                        <td>
                                            <input type="hidden" name="products[{{ $item->product->id }}][id]" value="{{ $item->product->id }}">
                                            <input type="number" 
                                                   name="products[{{ $item->product->id }}][quantity]" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1"
                                                   class="form-control text-center mx-auto" 
                                                   style="width:80px;">
                                        </td>
                                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                        <td>
                                            {{-- بدل form داخل form --}}
                                            <a href="{{ route('cart.remove.get', $item->product->id) }}" 
												class="btn btn-danger rounded-pill px-3 py-1"
												onclick="return confirm('Remove this item?')">
												🗑 Remove
											</a>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center mt-4">
							<a href="{{ url('/shop') }}" 
							class="btn-custom btn-light-bg rounded-pill px-4 py-2 fw-semibold shadow-sm hover-scale">
								<i class="bi bi-arrow-left me-2"></i> Continue Shopping
							</a>

							<button type="submit" 
									class="btn-custom btn-dark-bg rounded-pill px-4 py-2 fw-semibold shadow-sm hover-scale">
								<i class="bi bi-arrow-repeat me-2"></i> Update Cart
							</button>
						</div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
						<li><a href="https://www.facebook.com/share/1BSnRypSHb/"><span class="fa fa-brands fa-facebook-f"></span></a></li>
						<li><a href="https://x.com/FaroukSameh6?t=wgQCfuSRYHxXxIfiW-5EHg&s=09"><span class="fa fa-brands fa-twitter"></span></a></li>
						<li><a href="https://www.instagram.com/farouksameh01?igsh=MTJvZWxwOGk0M3Jlag=="><span class="fa fa-brands fa-instagram"></span></a></li>
						<li><a href="https://www.linkedin.com/in/farouk-sameh-ba4486181?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><span class="fa fa-brands fa-linkedin"></span></a></li>
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


	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>