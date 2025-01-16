@extends('backend.layouts.master')
@section('content')
    <!-- [ Main Content ] start -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-2">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house" style="color: #2C3E50"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('blogs.index')}}" style="color: #2C3E50">Blogs</a>
                </li>
            </ul>
            <a href="{{ route('blogs.create') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table blog-datatable table-hover pt-3 w-100">
                <thead>
                    <tr>
                        <th>S.N:</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="vertical-align: middle">
                    <!-- Data will be populated via DataTables -->
                </tbody>
            </table>
        </div>


    </div>
    <!-- [ Main Content ] end -->
@endsection

@section('modal')
    <!-- Modal for Image Preview -->
    <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalLabel">Blog Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- Modal Image -->
                    <img id="modal-blog" src="" alt="Blog Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable with AJAX
            var table = $('.blog-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('blogs.index') }}", // Data source URL
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                         className: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        render: function(data, type, row) {
                            return `<div style="word-wrap: break-word; white-space: normal;">${data}</div>`;
                        }
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                scrollX: true, // Enables horizontal scrolling
                responsive: true, // Adds responsive behavior
                autoWidth: false, // Prevents automatic column width adjustments
                language: {
                    emptyTable: "No data available in the table",
                    processing: "Loading..."
                }
            });

            // Handle delete with SweetAlert2
            $(document).on('click', '.delete-btn', function() {
                var slug = $(this).data('slug');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform delete via AJAX
                        $.ajax({
                            url: '/admin/blogs/' + slug,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your blog has been deleted.',
                                        'success'
                                    );
                                    table.ajax
                                        .reload(); // Reload DataTable after delete
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong!',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            //display image in modal
            $(document).on('click', '.blog-image', function() {
                var blogUrl = $(this).data('url'); // Get the image URL from the data-url attribute
                $('#modal-blog').attr('src', blogUrl); // Set the image source in the modal
                $('#blogModal').modal('show'); // Show the modal using Bootstrap 4
            });
        });
    </script>
@endpush
