@extends(backpack_view('blank'))

@php
    use App\Models\Order;
    use App\Models\User;

    $isDriver = backpack_user()->hasRoleCode('DRV') && !backpack_user()->hasRoleCode('ADM');
@endphp

@section('content')
@if($isDriver)
    {{-- Driver Dashboard: redirect to custom delivery interface --}}
    <script>window.location.href = "{{ url('admin/driver') }}";</script>
@else
@php
    $totalOrders = Order::count();
    $pendingOrders = Order::where('status', 'pending')->count();
    $confirmedOrders = Order::where('status', 'confirmed')->count();
    $shippedOrders = Order::where('status', 'shipped')->count();
    $deliveredOrders = Order::where('status', 'delivered')->count();
    $cancelledOrders = Order::where('status', 'cancelled')->count();
    $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
    $totalIncome = Order::where('status', 'delivered')->sum('total_amount');
    $totalStaff = User::count();
    $recentOrders = Order::latest()->take(5)->get();
@endphp
<div class="row mb-3">
    <div class="col-md-4 col-lg-2">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $totalOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Total Orders</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $pendingOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card text-white bg-info mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $confirmedOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Confirmed</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card text-dark bg-light mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $shippedOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Shipped</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card text-white bg-success mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $deliveredOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Delivered</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold">{{ $cancelledOrders }}</div>
                <div class="small text-uppercase font-weight-bold opacity-75">Cancelled</div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold text-success">${{ number_format($totalRevenue, 2) }}</div>
                <div class="small text-uppercase font-weight-bold text-muted">Total Revenue (excl. cancelled)</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="text-value-lg font-weight-bold text-primary">{{ $totalStaff }}</div>
                <div class="small text-uppercase font-weight-bold text-muted">Total Staff</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Recent Orders</strong>
                <a href="{{ backpack_url('order') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><a href="{{ backpack_url('order/' . $order->id . '/show') }}">{{ $order->order_number }}</a></td>
                            <td>{{ $order->customer_name }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'confirmed' => 'info',
                                        'shipped' => 'secondary',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No orders yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
