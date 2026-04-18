@extends(backpack_view('blank'))

@section('content')

@php
    $entries = $crud->getEntries();

    $statusColors = [
        'pending' => 'warning',
        'confirmed' => 'info',
        'shipped' => 'primary',
        'delivered' => 'success',
        'cancelled' => 'danger',
    ];
@endphp

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Orders</h2>
    </div>

    <div class="row">
        @forelse($entries as $entry)

            @php
                $statusColor = $statusColors[$entry->status] ?? 'secondary';
            @endphp

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-start border-4 border-{{ $statusColor }}">

                    <div class="card-body">

                        <!-- Order Number + Status -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0 text-primary">
                                #{{ $entry->order_number }}
                            </h5>

                            <span class="badge bg-{{ $statusColor }}">
                                {{ ucfirst($entry->status) }}
                            </span>
                        </div>

                        <!-- Customer -->
                        <p class="mb-1">
                            <strong>{{ $entry->customer_name ?? 'Unknown Customer' }}</strong>
                        </p>

                        <p class="text-muted small mb-2">
                            {{ $entry->customer_email ?? 'No email' }}
                        </p>

                        <!-- Total -->
                        <p class="mb-2">
                            <strong>${{ number_format($entry->total_amount, 2) }}</strong>
                        </p>

                        <!-- Driver -->
                        <p class="small text-muted mb-2">
                            Driver:
                            {{ $entry->assignedTo->full_name ?? 'Not assigned' }}
                        </p>

                        <!-- Date -->
                        <p class="small text-muted">
                            {{ optional($entry->created_at)->format('d M Y, H:i') }}
                        </p>

                    </div>

                    <!-- Actions -->
                    <div class="card-footer d-flex justify-content-between align-items-center">

                        <!-- View -->
                        <a href="{{ url($crud->route.'/'.$entry->id.'/show') }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="la la-eye"></i> View
                        </a>

                        <div class="d-flex gap-1">

                            <!-- Update -->
                            <a href="{{ url($crud->route.'/'.$entry->id.'/edit') }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="la la-edit"></i> Update
                            </a>

                            <!-- Delete (Admin Only) -->
                            @if(backpack_auth()->check() && backpack_auth()->user()->hasRoleCode('ADM'))
                                <form method="POST"
                                      action="{{ url($crud->route.'/'.$entry->id) }}"
                                      onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="la la-trash"></i> Delete
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                </div>
            </div>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No orders found</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
