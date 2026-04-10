@extends(backpack_view('blank'))

@section('after_styles')
<style>
    .driver-container { max-width: 600px; margin: 0 auto; }
    .filter-tabs { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 4px; -webkit-overflow-scrolling: touch; }
    .filter-tab {
        padding: 8px 18px; border-radius: 999px; font-size: 14px; font-weight: 600;
        white-space: nowrap; text-decoration: none; transition: all 0.2s;
        border: 2px solid #e5e7eb; color: #6b7280; background: #fff;
    }
    .filter-tab:hover { border-color: #6366f1; color: #6366f1; }
    .filter-tab.active { background: #6366f1; color: #fff; border-color: #6366f1; }
    .filter-tab .count { background: rgba(255,255,255,0.25); padding: 2px 8px; border-radius: 999px; margin-left: 6px; font-size: 12px; }
    .filter-tab:not(.active) .count { background: #f3f4f6; }

    .order-card {
        background: #fff; border-radius: 16px; padding: 20px; margin-bottom: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        border: 1px solid #f3f4f6; transition: all 0.2s;
    }
    .order-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); transform: translateY(-1px); }

    .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
    .order-number { font-weight: 700; font-size: 15px; color: #1f2937; }
    .status-badge {
        padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-confirmed { background: #dbeafe; color: #1e40af; }
    .status-shipped { background: #e0e7ff; color: #4338ca; }
    .status-delivered { background: #d1fae5; color: #065f46; }

    .order-customer { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
    .customer-avatar {
        width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 14px; flex-shrink: 0;
    }
    .customer-name { font-weight: 600; font-size: 15px; color: #1f2937; }
    .customer-phone { font-size: 13px; color: #6b7280; }
    .customer-phone a { color: #6366f1; text-decoration: none; }

    .order-address { display: flex; align-items: flex-start; gap: 8px; padding: 10px 12px; background: #f9fafb; border-radius: 10px; margin-bottom: 12px; }
    .order-address svg { flex-shrink: 0; margin-top: 2px; }
    .order-address-text { font-size: 13px; color: #4b5563; line-height: 1.4; }

    .order-footer { display: flex; justify-content: space-between; align-items: center; padding-top: 12px; border-top: 1px solid #f3f4f6; }
    .order-total { font-weight: 700; font-size: 18px; color: #1f2937; }
    .order-items-count { font-size: 13px; color: #9ca3af; }

    .order-actions { display: flex; gap: 8px; margin-top: 14px; }
    .btn-action {
        flex: 1; display: flex; align-items: center; justify-content: center; gap: 6px;
        padding: 10px 16px; border-radius: 12px; font-size: 14px; font-weight: 600;
        text-decoration: none; transition: all 0.2s; border: none; cursor: pointer;
    }
    .btn-view { background: #f3f4f6; color: #374151; }
    .btn-view:hover { background: #e5e7eb; color: #1f2937; }
    .btn-pickup { background: #6366f1; color: #fff; }
    .btn-pickup:hover { background: #4f46e5; }
    .btn-deliver { background: #059669; color: #fff; }
    .btn-deliver:hover { background: #047857; }

    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon { width: 80px; height: 80px; margin: 0 auto 20px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    .empty-title { font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 6px; }
    .empty-text { font-size: 14px; color: #9ca3af; }

    .success-toast {
        background: #059669; color: #fff; padding: 14px 20px; border-radius: 12px;
        margin-bottom: 16px; font-weight: 600; font-size: 14px;
        display: flex; align-items: center; gap: 10px; animation: slideIn 0.3s ease;
    }
    @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    .driver-greeting { margin-bottom: 20px; }
    .driver-greeting h2 { font-size: 24px; font-weight: 800; color: #1f2937; margin: 0 0 4px; }
    .driver-greeting p { font-size: 14px; color: #9ca3af; margin: 0; }
</style>
@endsection

@section('content')
<div class="driver-container">
    <div class="driver-greeting">
        <h2>Hey, {{ backpack_user()->first_name }} 👋</h2>
        <p>{{ now()->format('l, M d') }} &middot; {{ $counts['active'] }} active {{ Str::plural('delivery', $counts['active']) }}</p>
    </div>

    @if(session('success'))
        <div class="success-toast">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="filter-tabs mb-3">
        <a href="{{ url('admin/driver?filter=active') }}" class="filter-tab {{ $filter === 'active' ? 'active' : '' }}">
            Active <span class="count">{{ $counts['active'] }}</span>
        </a>
        <a href="{{ url('admin/driver?filter=pending') }}" class="filter-tab {{ $filter === 'pending' ? 'active' : '' }}">
            Pending <span class="count">{{ $counts['pending'] }}</span>
        </a>
        <a href="{{ url('admin/driver?filter=delivered') }}" class="filter-tab {{ $filter === 'delivered' ? 'active' : '' }}">
            Delivered <span class="count">{{ $counts['delivered'] }}</span>
        </a>
    </div>

    @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <span class="order-number">{{ $order->order_number }}</span>
                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="order-customer">
                <div class="customer-avatar">{{ strtoupper(substr($order->customer_name, 0, 1)) }}</div>
                <div>
                    <div class="customer-name">{{ $order->customer_name }}</div>
                    <div class="customer-phone">
                        <a href="tel:{{ $order->customer_phone }}">{{ $order->customer_phone }}</a>
                    </div>
                </div>
            </div>

            @if($order->address || $order->city)
            <div class="order-address">
                <svg width="16" height="16" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="order-address-text">
                    {{ collect([$order->address, $order->city, $order->state, $order->postal_code])->filter()->implode(', ') }}
                </span>
            </div>
            @endif

            <div class="order-footer">
                <div>
                    <div class="order-total">${{ number_format($order->total_amount, 2) }}</div>
                    <div class="order-items-count">{{ $order->items_count ?? $order->items()->count() }} {{ Str::plural('item', $order->items()->count()) }}</div>
                </div>
                <div style="font-size: 12px; color: #9ca3af;">{{ $order->created_at->diffForHumans() }}</div>
            </div>

            <div class="order-actions">
                <a href="{{ url('admin/driver/' . $order->id) }}" class="btn-action btn-view">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Details
                </a>
                @if($order->status === 'confirmed')
                    <form action="{{ url('admin/driver/' . $order->id . '/status') }}" method="POST" style="flex:1;display:flex;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="shipped">
                        <button type="submit" class="btn-action btn-pickup" style="width:100%;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/></svg>
                            Pick Up
                        </button>
                    </form>
                @elseif($order->status === 'shipped')
                    <form action="{{ url('admin/driver/' . $order->id . '/status') }}" method="POST" style="flex:1;display:flex;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="delivered">
                        <button type="submit" class="btn-action btn-deliver" style="width:100%;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Delivered
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="36" height="36" fill="none" stroke="#9ca3af" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div class="empty-title">No deliveries here</div>
            <div class="empty-text">
                @if($filter === 'active') You have no active deliveries right now.
                @elseif($filter === 'pending') No pending orders assigned to you.
                @else No delivered orders yet.
                @endif
            </div>
        </div>
    @endforelse
</div>
@endsection
