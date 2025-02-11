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
                    <a href="{{ route('admin.orders') }}" style="color: #2C3E50">Orders</a>
                </li>
            </ul>
        </div>
        <div class="table-responsive">
            <table class="table order-datatable table-hover pt-3 w-100">
                <thead>
                    <tr>
                        <th>S.N:</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Total(Rs)</th>
                        <th>Date Purchased</th>
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
            var table = $('.order-datatable').DataTable({
                processing: true,
                serverSide: true,
                searchDelay: 1000,
                ajax: "{{ route('admin.orders') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: null,
                        name: 'first_name',
                        render: function(data, type, row) {
                            return `${row.first_name} ${row.last_name}`;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center'
                    },
                    {
                        data: 'total_charge',
                        name: 'total_charge',
                        render: function(data, type, row) {
                            return `${parseFloat(data).toLocaleString()}`;
                        },
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    }
                ],
                order: [
                    [6, 'desc'] // Sort by 'created_at'
                ],
                responsive: true,
                language: {
                    emptyTable: "No data available",
                    processing: "Loading..."
                }
            });
        });
    </script>
@endpush
