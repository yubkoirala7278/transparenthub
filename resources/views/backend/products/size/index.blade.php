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
                    <a href="{{ route('size.index') }}" style="color: #2C3E50">Product Size</a>
                </li>
            </ul>
            <a href="{{ route('size.create') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table size-datatable table-hover pt-3 w-100">
                <thead>
                    <tr>
                        <th>S.N:</th>
                        <th>Size</th>
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

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // =======Initialize DataTable with AJAX=======
            var table = $('.size-datatable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 1000,
                ajax: "{{ route('size.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
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
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        visible: false
                    }
                ],
                order: [
                    [4, 'desc']
                ], // Default sort by 'created_at'
                responsive: true,
                language: {
                    emptyTable: "No data available",
                    processing: "Loading..."
                }
            });

            // =====toggle status===================
            $(document).on('click', '.toggle-status-btn', function() {
                const slug = $(this).data('slug');
                const currentStatus = $(this).data('status');
                const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to change the status to ${newStatus}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/products_size/toggle-status/${slug}`,
                            type: 'PATCH',
                            data: {
                                status: newStatus,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                Swal.fire('Success!', response.message, 'success');
                                table.ajax.reload(); // Reload DataTable after delete
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Failed to update status.',
                                    'error');
                            },
                        });
                    }
                });
            });

            // =====delete product size========
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
                            url: '/admin/size/' + slug,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your Product Size has been deleted.',
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
        });
    </script>
@endpush
