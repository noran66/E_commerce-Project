<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .color-btn {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-left: 5px;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .color-btn.selected {
            border: 2px solid #333;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <!-- الصورة -->
            <div class="col-md-6">
                <div class="product-img text-center">
                    <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded mb-3" style="max-height:400px;">
                </div>
            </div>

            <!-- التفاصيل -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $product->name }}</h2>

                <!-- التقييم -->
                <div class="mb-2">
                    <span class="text-warning fs-5">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $product->reviews->avg('rating'))
                            &#9733;
                            @else
                            &#9734;
                            @endif
                            @endfor
                    </span>
                    <span class="ms-2 text-muted">({{ $product->reviews->count() }} Reviews)</span>
                </div>

                <!-- السعر -->
                <div class="mb-3">
                    <h4 class="text-success d-inline">${{ $product->price }}</h4>
                    @if($product->old_price)
                    <del class="text-muted ms-2">${{ $product->old_price }}</del>
                    @endif
                </div>

                <!-- حالة المنتج -->
                <p class="mb-3">
                    <strong>Status:</strong>
                    @if($product->stock > 0)
                    <span class="text-success">In Stock</span>
                    @else
                    <span class="text-danger">Out of Stock</span>
                    @endif
                </p>

                <!-- خيارات اللون -->
                <div class="mb-3">
                    <strong>Color:</strong>
                    @foreach($product->colors as $color)
                    <button class="color-btn" style="background-color: {{ $color->code ?? '#ffffff' }};" data-color="{{ $color->name }}"></button>
                    @endforeach
                    <input type="hidden" id="selectedColor" name="color" value="">
                </div>

                <!-- تفاصيل إضافية -->
                <ul class="list-unstyled mb-3">
                    <li><strong>Material:</strong> {{ $product->material }}</li>
                    <li><strong>Color:</strong> {{ $product->colors->pluck('name')->join(' / ') }}</li>
                    <li><strong>Weight:</strong> {{ $product->weight }}</li>
                    <li><strong>Dimensions:</strong> {{ $product->dimensions }}</li>
                </ul>

                <!-- أزرار Add to Cart & Buy Now -->
                <div class="mb-4">
                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-success btn-lg me-2">Add to Cart</button>
                    </form>

                    <a href="{{ route('checkout', $product->id) }}" class="btn btn-outline-success btn-lg">Buy Now</a>
                </div>

                <!-- خيارات إضافية -->
                <div class="mb-3">
                    <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="bi bi-bar-chart me-1"></i> Compare
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="bi bi-heart me-1"></i> Add to Wishlist
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-rulers me-1"></i> Size Chart
                    </a>
                </div>

                <!-- الشحن والتوصيل -->
                <p><i class="bi bi-truck me-2"></i>Free worldwide shipping on all orders over $200</p>
                <p><i class="bi bi-clock me-2"></i>Delivers in 3-5 working days</p>
            </div>
        </div>

        <!-- وصف المنتج -->
        <div class="mt-5">
            <h4>Description</h4>
            <p>{{ $product->description }}</p>
        </div>

        <!-- المراجعات -->
        <div class="mt-4">
            <h4>Reviews</h4>
            @foreach($product->reviews as $review)
            <div class="mb-3 border-bottom pb-2">
                <strong>{{ $review->user->name }}</strong>
                <div class="text-warning">
                    @for($i = 0; $i < $review->rating; $i++)
                        &#9733;
                        @endfor
                </div>
                <p>{{ $review->comment }}</p>
            </div>
            @endforeach
        </div>

        <!-- منتجات مشابهة -->
        <div class="mt-5">
            <h4>Similar Products</h4>
            <div class="row">
                @foreach($similarProducts as $sp)
                <div class="col-md-3 mb-3">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/' . $sp->image) }}" class="card-img-top"
                            alt="{{ $sp->name }}">
                        <div class="card-body text-center">
                            <h6 class="card-title">{{ $sp->name }}</h6>
                            <p class="text-success mb-0">${{ $sp->price }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        const colorButtons = document.querySelectorAll('.color-btn');
        const selectedInput = document.getElementById('selectedColor');

        colorButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                colorButtons.forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
                selectedInput.value = btn.getAttribute('data-color');
            });
        });
    </script>
</body>

</html>