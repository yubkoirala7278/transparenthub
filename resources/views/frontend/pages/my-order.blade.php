@extends('frontend.layouts.master')

@section('content')
    <main class="wrapper-contain bg-light py-5">
        <div class="container">
            <h2>My Orders</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Orders #</th>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($orders)>0)
                            @foreach ($orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>
                                    @if($order->status === 'pending')
                                        <span class="badge bg-warning text-light">Pending</span>
                                    @elseif($order->status === 'shipped')
                                        <span class="badge bg-primary">Shipped</span>
                                    @elseif($order->status === 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>{{$order->total_charge}}</td>
                                <td>
                                    <a href="{{route('my-order-details',$order->slug)}}" class="btn btn-success btn-sm rounded-0">View</a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="30">No Orders to display..</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{$orders->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </main>
@endsection
