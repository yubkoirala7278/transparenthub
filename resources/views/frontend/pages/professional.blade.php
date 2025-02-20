@extends('frontend.layouts.master')
@section('content')
    <section class="container professionalist mt-2 mt-lg-5">
        <h2 class="mb-3 fw-semibold">Choose Professional</h2>
        <div class="row g-3">
            <div class="col-12">
                <!-- Filter Form -->
                <form id="filterForm" action="{{ route('professional') }}" method="GET">
                    <div class="row g-2 align-items-center">
                        <!-- Search Input -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <input type="text" class="form-control" placeholder="Search by professional name..."
                                name="keyword" value="{{ request('keyword') }}">
                        </div>

                        <!-- Category Dropdown -->
                        <div class="col-12 col-md-6 col-lg-2">
                            <select class="form-select" name="category">
                                <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- SubCategory Dropdown -->
                        <div class="col-12 col-md-6 col-lg-2">
                            <select class="form-select" name="sub_category">
                                <option selected disabled>Select SubCategory</option>
                                <!-- If a category is already selected, you can pre-populate the subcategories -->
                                @if (request('category'))
                                    @foreach ($subCategories->where('professional_categories_id', request('category')) as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            {{ request('sub_category') == $subCategory->id ? 'selected' : '' }}>
                                            {{ $subCategory->name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            {{ request('sub_category') == $subCategory->id ? 'selected' : '' }}>
                                            {{ $subCategory->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Location Dropdown -->
                        <div class="col-12 col-md-6 col-lg-2">
                            <select class="form-select" name="location">
                                <option selected disabled>Select Location</option>
                                @foreach ($professionalLocations as $location)
                                    <option value="{{ $location }}"
                                        {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter & Reset Buttons -->
                        <div class="col-12 col-lg-3 text-center text-lg-start d-flex gap-2">
                            <button type="submit" class="btn btn-success w-100">FILTER</button>
                            <button type="reset" class="btn btn-danger w-100" id="resetBtn">RESET</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Loading Indicator -->
            <div id="loading" class="text-center my-3" style="display:none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <!-- Professionals List Container -->
            <div id="professionalsContainer" class="row mt-4">
                @include('frontend.pages.professional-list', ['professionals' => $professionals])
            </div>

        </div>
    </section>
@endsection

@push('script')
    <script>
        // Add event listener to all parent checkboxes
        document.querySelectorAll('.parent-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const targetId = this.getAttribute('data-target');
                const targetList = document.getElementById(targetId);
                if (targetList) {
                    targetList.classList.toggle('d-none', !this.checked);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // ===============================
            // 1. Dependent SubCategory Dropdown
            // ===============================
            $('select[name="category"]').on('change', function() {
                var categoryId = $(this).val();
                var subCategorySelect = $('select[name="sub_category"]');
                subCategorySelect.html('<option selected disabled>Loading...</option>');
                $.ajax({
                    url: "{{ url('professional/get-subcategories') }}/" + categoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        subCategorySelect.empty();
                        if (data.length > 0) {
                            subCategorySelect.append(
                                '<option selected disabled>Select SubCategory</option>');
                            $.each(data, function(index, subCategory) {
                                subCategorySelect.append('<option value="' + subCategory
                                    .id + '">' + subCategory.name + '</option>');
                            });
                        } else {
                            subCategorySelect.append(
                                '<option selected disabled>No SubCategories found</option>');
                        }
                    },
                    error: function() {
                        subCategorySelect.empty().append(
                            '<option selected disabled>Error loading subcategories</option>'
                            );
                    }
                });
            });

            // ===============================
            // 2. AJAX Filter Form Submission
            // ===============================
            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $('#loading').show();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "GET",
                    data: formData,
                    dataType: "html",
                    success: function(response) {
                        $('#loading').hide();
                        // Update professionals container with the response (should be the partial view)
                        $('#professionalsContainer').html(response);
                        // If response is empty, display "Nothing to display"
                        if ($.trim(response) == '') {
                            $('#professionalsContainer').html(
                                '<div class="col-12 text-center">Nothing to display</div>');
                        }
                    },
                    error: function() {
                        $('#loading').hide();
                        alert("An error occurred while fetching data.");
                    }
                });
            });

            // ===============================
            // 3. Reset Button Behavior
            // ===============================
            $('#resetBtn').on('click', function() {
                // Optionally reset the subcategory dropdown
                $('select[name="sub_category"]').html(
                    '<option selected disabled>Select SubCategory</option>');
                // Reload the page or make an AJAX request to load all professionals
                location.reload();
            });
        });
    </script>
@endpush
