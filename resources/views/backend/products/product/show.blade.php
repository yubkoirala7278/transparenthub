@extends('backend.layouts.master')
@section('content')
    <!-- [ Main Content ] start -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house" style="color: #2C3E50"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}" style="color: #2C3E50">Products</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #2C3E50">Product Details</li>
            </ul>
            <a href="{{ route('products.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>

        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white  py-3">
                <h4 class="mb-0 text-white">{{ $product->name }}</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-lg-5 text-center">
                        <img src="{{ asset($product->feature_image) }}" alt="{{ $product->name }}"
                            class="img-fluid rounded shadow" style="max-height: 350px; object-fit: cover;" loading="lazy">
                    </div>

                    <!-- Product Details -->
                    <div class="col-lg-7">
                        <h5 class="text-muted">Category: <span
                                class="text-dark">{{ $product->category->name ?? 'N/A' }}</span></h5>
                        <h5 class="text-muted">Subcategory: <span
                                class="text-dark">{{ $product->subCategory->name ?? 'N/A' }}</span></h5>
                        <h5 class="text-muted">Brand: <span class="text-dark">{{ $product->brand->name ?? 'N/A' }}</span>
                        </h5>
                        <h5 class="text-muted">Status:
                            <span
                                class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }} text-white">{{ ucfirst($product->status) }}</span>
                        </h5>

                        <h3 class="text-danger fw-bold mt-3">Rs. {{ number_format($product->price, 2) }}
                            @if ($product->compare_price)
                                <span class="text-muted ms-2" style="text-decoration: line-through;">Rs.
                                    {{ number_format($product->compare_price, 2) }}</span>
                            @endif
                        </h3>

                        @if ($product->colors->isNotEmpty())
                            <div class="mt-4">
                                <h5 class="fw-bold">Available Colors</h5>
                                <div class="d-flex">
                                    @foreach ($product->colors as $color)
                                        @php
                                            // Convert color name to lowercase and replace spaces with hyphens
                                            $bgColor = strtolower(str_replace(' ', '', $color->name)); // e.g., 'Light Green' → 'lightgreen'

                                            // Check if the color is white and replace it with wheat
                                            $displayColor = $bgColor === 'white' ? '#F2F2F2' : $bgColor;

                                            // Determine text color: black for light backgrounds, white for dark
                                            $lightColors = [
                                                'white',
                                                'yellow',
                                                'lightgray',
                                                'lightblue',
                                                'lightgreen',
                                                'lightpink',
                                                'ivory',
                                                '#F2F2F2',
                                            ];
                                            $textColor = in_array($displayColor, $lightColors) ? 'black' : 'white';
                                        @endphp
                                        <span class="badge"
                                            style="background-color: {{ $displayColor }}; color: {{ $textColor }}; padding: 8px 16px; border-radius: 8px; margin-right: 10px;">
                                            {{ ucfirst($color->name) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif




                        @if ($product->sizes->isNotEmpty())
                            <div class="mt-4">
                                <h5 class="fw-bold">Available Size</h5>
                                <div class="d-flex">
                                    @foreach ($product->sizes as $size)
                                        <span class="badge"
                                            style="background-color: rgb(15, 14, 14); color: white; padding: 8px 16px; border-radius: 8px; margin-right: 10px;">{{ ucfirst($size->name) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-4">
                            <h5 class="fw-bold">Featured Product</h5>
                            <span
                                class="badge {{ $product->is_featured == 'Yes' ? 'bg-primary' : 'bg-secondary' }} text-white">{{ $product->is_featured }}</span>
                        </div>

                        <div class="mt-4">
                            <h5 class="fw-bold">Shipping Charge</h5>
                            <p>Inside Valley: {{$product->shipping_charge_inside_valley}}</p>
                            <p>Outside Valley: {{$product->shipping_charge_outside_valley}}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-5">
                    <h4 class="mark">Description</h4>
                    <p class="text-muted">{!! $product->description ?? 'No description available.' !!}</p>
                </div>

                <!-- Shipping & Returns -->
                <div class="mt-4">
                    <h4 class="mark">Shipping & Returns Protocol</h4>
                    <p class="text-muted">{!! $product->shipping_returns ?? 'No information available.' !!}</p>
                </div>

                <!-- Product Gallery -->
                @if ($product->images->isNotEmpty())
                    <div class="mt-5">
                        <h4 class="mark">Product Gallery</h4>
                        <div class="row mt-3">
                            @foreach ($product->images as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset($image->image) }}" alt="Product Image"
                                        class="img-fluid rounded shadow" style="max-height: 200px; object-fit: cover;"
                                        loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
@endsection
