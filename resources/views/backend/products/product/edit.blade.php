@extends('backend.layouts.master')

@section('header-links')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
            </ul>
            <a href="{{ route('products.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Update Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->slug) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- product name --}}
                                        <div class="form-group">
                                            <label for="name" class="font-weight-bold h5">Product Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Product Name" value="{{ old('name', $product->name) }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        {{-- description --}}
                                        <div class="form-group">
                                            <label for="description" class="font-weight-bold h5">Product Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ old('description', $product->description) }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        {{-- shipping returns --}}
                                        <div class="form-group">
                                            <label for="shipping_returns" class="font-weight-bold h5">Product Shipping &
                                                Returns
                                                Protocol</label>
                                            <textarea class="form-control" id="shipping_returns" name="shipping_returns"
                                                placeholder="Enter the shipping and returns protocol">{{ old('shipping_returns', $product->shipping_returns) }}</textarea>
                                            @if ($errors->has('shipping_returns'))
                                                <span class="text-danger">{{ $errors->first('shipping_returns') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- Feature Image --}}
                                        <div class="form-group">
                                            <label for="feature_image" class="font-weight-bold h5">Upload Feature Image
                                                <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control-file" id="feature_image"
                                                name="feature_image"
                                                accept="image/jpeg, image/png, image/jpg, image/gif, image/webp, image/svg">

                                            @if ($errors->has('feature_image'))
                                                <span class="text-danger">{{ $errors->first('feature_image') }}</span>
                                            @endif

                                            <!-- Image preview container -->
                                            <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                                                <div style="position: relative; display: inline-block;">
                                                    <img id="imagePreview" src="" alt="Preview"
                                                        style="max-width: 200px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                                    <button id="removeImage" type="button" class="btn btn-danger btn-sm"
                                                        style="position: absolute; top: -10px; right: -10px; clip-path:circle()">×</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- product images --}}
                                        <div class="form-group">
                                            <label for="gallery" class="font-weight-bold h5">Upload Product Images <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control-file" id="gallery" name="gallery[]"
                                                multiple
                                                accept="image/jpeg, image/png, image/jpg, image/gif, image/webp, image/svg">
                                            @if ($errors->has('gallery'))
                                                <span class="text-danger">{{ $errors->first('gallery') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- price --}}
                                        <div class="form-group">
                                            <label for="price" class="font-weight-bold h5">Product Price <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                placeholder="Enter Product Price"
                                                value="{{ old('price', $product->price) }}">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                        {{-- compare price --}}
                                        <div class="form-group">
                                            <label for="compare_price" class="font-weight-bold h5">Product Compare
                                                Price</label>
                                            <input type="number" class="form-control" id="compare_price"
                                                name="compare_price" placeholder="Enter Product Compare Price"
                                                value="{{ old('compare_price',$product->compare_price) }}">
                                            @if ($errors->has('compare_price'))
                                                <span
                                                    class="text-danger">{{ $errors->first('compare_price') }}</span>
                                            @endif
                                        </div>
                                        <span class="text-muted">To show a reduced price, move the product’s original price
                                            into Compare at price. Enter a lower value into Price. </span>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- sku --}}
                                        <div class="form-group">
                                            <label for="sku" class="font-weight-bold h5">SKU (Stock Keeping
                                                Unit) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="sku" name="sku"
                                                placeholder="Enter SKU (Stock Keeping Unit)"
                                                value="{{ old('sku', $product->sku) }}">
                                            @if ($errors->has('sku'))
                                                <span class="text-danger">{{ $errors->first('sku') }}</span>
                                            @endif
                                        </div>
                                        {{-- track quantity --}}
                                        <div class="form-group my-3">
                                            <!-- Hidden input to ensure unchecked checkbox submits a value -->
                                            <input type="hidden" name="track_qty" value="0">

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="track_qty"
                                                    name="track_qty" value="1"
                                                    {{ old('track_qty', isset($product) && $product->track_qty ? 1 : 0) == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label font-weight-bold h5"
                                                    for="track_qty">Track Quantity</label>
                                            </div>

                                            @error('track_qty')
                                                <span class="text-danger d-block">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- product quantity --}}
                                        <div class="form-group">
                                            <label for="qty" class="font-weight-bold h5">Product Quantity</label>
                                            <input type="number" class="form-control" id="qty" name="qty"
                                                placeholder="Enter Product Quantity"
                                                value="{{ old('qty', $product->qty) }}">
                                            @if ($errors->has('qty'))
                                                <span class="text-danger">{{ $errors->first('qty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- status --}}
                                        <div class="form-group">
                                            <label for="status" class="font-weight-bold h5">Product Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="active"
                                                    {{ old('status', isset($product) ? $product->status : 'active') === 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status', isset($product) ? $product->status : '') === 'inactive' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>

                                            @if ($errors->has('status'))
                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- Category --}}
                                        <div class="form-group">
                                            <label for="category_id" class="font-weight-bold h5">
                                                Product Category <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option selected disabled>Select Product Category</option>
                                                @if (count($categories) > 0)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if ($errors->has('category_id'))
                                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                            @endif
                                        </div>

                                        {{-- Sub Category --}}
                                        <div class="form-group">
                                            <label for="sub_category_id" class="font-weight-bold h5">
                                                Product Sub Category
                                            </label>
                                            <select class="form-control" name="sub_category_id" id="sub_category_id">
                                                <option selected disabled>Select Product Sub Category</option>
                                                @if (count($sub_categories) > 0)
                                                    @foreach ($sub_categories as $sub_category)
                                                        <option value="{{ $sub_category->id }}"
                                                            {{ old('sub_category_id', isset($product) ? $product->sub_category_id : '') == $sub_category->id ? 'selected' : '' }}>
                                                            {{ $sub_category->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if ($errors->has('sub_category_id'))
                                                <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- Brand --}}
                                        <div class="form-group">
                                            <label for="brand_id" class="font-weight-bold h5">Product Brand</label>
                                            <select class="form-control" name="brand_id" id="brand_id">
                                                <option selected disabled>Select Product Brand</option>
                                                @if (count($brands))
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ old('brand_id', isset($product) ? $product->brand_id : '') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if ($errors->has('brand_id'))
                                                <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- Color --}}
                                        <div class="form-group">
                                            <label for="color_id" class="font-weight-bold h5">Product Color</label>
                                            <select class="form-control" name="color_id[]" id="color_id" multiple>
                                                @if (count($colors) > 0)
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}"
                                                            {{ in_array($color->id, old('color_id', isset($product) ? $product->colors->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                            {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('color_id'))
                                                <span class="text-danger">{{ $errors->first('color_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- size --}}
                                        <div class="form-group">
                                            <label for="size_id" class="font-weight-bold h5">Product Size</label>
                                            <select class="form-control" name="size_id[]" id="size_id" multiple>
                                                @if (count($sizes) > 0)
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}"
                                                            {{ in_array($size->id, old('size_id', isset($product) ? $product->sizes->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                                            {{ $size->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('size_id'))
                                                <span class="text-danger">{{ $errors->first('size_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow bg-white rounded ">
                                    <div class="card-body">
                                        {{-- featured or not --}}
                                        <div class="form-group">
                                            <label for="is_featured" class="font-weight-bold h5">Featured Product <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="is_featured" id="is_featured">
                                                <option value="Yes"
                                                    {{ old('is_featured', isset($product) ? $product->is_featured : 'Yes') === 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('is_featured', isset($product) ? $product->is_featured : 'Yes') === 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>

                                            @if ($errors->has('is_featured'))
                                                <span class="text-danger">{{ $errors->first('is_featured') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('script')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // =====display and remove feature image when uploaded=======
        document.getElementById("feature_image").addEventListener("change", function(event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("imagePreview").src = e.target.result;
                    document.getElementById("imagePreviewContainer").style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById("removeImage").addEventListener("click", function() {
            let inputField = document.getElementById("image");
            let previewContainer = document.getElementById("imagePreviewContainer");

            // Reset input field
            inputField.value = "";

            // Hide preview container
            previewContainer.style.display = "none";
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#shipping_returns'), {
                removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                    'Indent', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error.stack);
            });
    </script>
    <script>
        $(document).ready(function() {
            $('#color_id').select2({
                placeholder: 'Select Product Colors',
                allowClear: true,
                closeOnSelect: false
            });

            // Add "Select All" functionality
            var selectAllOption = new Option('Select All', 'select_all', false, false);
            $('#color_id').prepend(selectAllOption); // Prepend "Select All" option

            // Handle "Select All" functionality
            $('#color_id').on('select2:select', function(e) {
                if (e.params.data.id === 'select_all') {
                    $('#color_id > option').prop('selected', true);
                    $('#color_id').trigger('change');
                }
            });

            // Handle deselecting "Select All" functionality
            $('#color_id').on('select2:unselect', function(e) {
                if (e.params.data.id === 'select_all') {
                    $('#color_id > option').prop('selected', false);
                    $('#color_id').trigger('change');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#size_id').select2({
                placeholder: 'Select Product Sizes',
                allowClear: true,
                closeOnSelect: false
            });

            // Add "Select All" functionality
            var selectAllOption = new Option('Select All', 'select_all', false, false);
            $('#size_id').prepend(selectAllOption); // Prepend "Select All" option

            // Handle "Select All" functionality
            $('#size_id').on('select2:select', function(e) {
                if (e.params.data.id === 'select_all') {
                    $('#size_id > option').prop('selected', true);
                    $('#size_id').trigger('change');
                }
            });

            // Handle deselecting "Select All" functionality
            $('#size_id').on('select2:unselect', function(e) {
                if (e.params.data.id === 'select_all') {
                    $('#size_id > option').prop('selected', false);
                    $('#size_id').trigger('change');
                }
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload.product') . '?_token=' . csrf_token() }}',
                },
            })
            .then(editor => {
                let previousImages = [];

                // Detect content changes in CKEditor
                editor.model.document.on('change:data', () => {
                    const content = editor.getData();
                    const currentImages = extractImageSources(content);

                    // Compare previous and current images to find deleted ones
                    const deletedImages = previousImages.filter(img => !currentImages.includes(img));
                    if (deletedImages.length > 0) {
                        deleteImagesFromServer(deletedImages);
                    }

                    previousImages = currentImages; // Update the image list
                });

                // Extract image URLs from content
                function extractImageSources(content) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    const images = Array.from(tempDiv.querySelectorAll('img')).map(img => img.getAttribute('src'));
                    return images;
                }

                // Send a request to delete images from the server
                function deleteImagesFromServer(images) {
                    fetch('{{ route('ckeditor.delete.product') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                images
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                console.error('Failed to delete images:', data.message);
                            }
                        })
                        .catch(error => console.error('Error deleting images:', error));
                }
            })
            .catch(error => console.error('Error initializing CKEditor:', error));
    </script>
@endpush
