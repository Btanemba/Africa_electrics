@extends(backpack_view('blank'))

@section('after_styles')
<style>
    .detail-container { max-width: 600px; margin: 0 auto; }
    .back-link { display: inline-flex; align-items: center; gap: 6px; color: #6366f1; text-decoration: none; font-weight: 600; font-size: 14px; margin-bottom: 20px; }
    .back-link:hover { color: #4f46e5; }

    .detail-card { background: #fff; border-radius: 16px; padding: 24px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f3f4f6; }
    .detail-card-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #9ca3af; margin-bottom: 16px; }

    .status-bar { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-radius: 16px; margin-bottom: 16px; }
    .status-bar.pending { background: linear-gradient(135deg, #fef3c7, #fde68a); }
    .status-bar.confirmed { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
    .status-bar.shipped { background: linear-gradient(135deg, #e0e7ff, #c7d2fe); }
    .status-bar.delivered { background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
    .status-label { font-weight: 800; font-size: 18px; color: #1f2937; }
    .status-order { font-size: 13px; color: #4b5563; font-weight: 600; }

    .info-row { display: flex; align-items: flex-start; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
    .info-row:last-child { border-bottom: none; }
    .info-icon { width: 36px; height: 36px; border-radius: 10px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .info-label { font-size: 12px; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; }
    .info-value { font-size: 15px; color: #1f2937; font-weight: 600; margin-top: 2px; }
    .info-value a { color: #6366f1; text-decoration: none; }

    .item-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f3f4f6; }
    .item-row:last-child { border-bottom: none; }
    .item-name { font-size: 15px; font-weight: 600; color: #1f2937; }
    .item-qty { font-size: 13px; color: #6b7280; margin-top: 2px; }
    .item-price { font-size: 15px; font-weight: 700; color: #1f2937; }

    .total-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 0 0; border-top: 2px solid #e5e7eb; margin-top: 8px; }
    .total-label { font-size: 16px; font-weight: 700; color: #1f2937; }
    .total-value { font-size: 22px; font-weight: 800; color: #1f2937; }

    .action-bar { position: sticky; bottom: 0; padding: 16px 0; background: linear-gradient(to top, #f9fafb 80%, transparent); }
    .btn-full {
        display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%;
        padding: 14px 20px; border-radius: 14px; font-size: 16px; font-weight: 700;
        border: none; cursor: pointer; transition: all 0.2s; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .btn-full.pickup { background: #6366f1; color: #fff; }
    .btn-full.pickup:hover { background: #4f46e5; }
    .btn-full.deliver { background: #059669; color: #fff; }
    .btn-full.deliver:hover { background: #047857; }
    .btn-full.done { background: #d1fae5; color: #065f46; cursor: default; }

    .call-btn {
        display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px;
        background: #f0fdf4; color: #059669; border-radius: 10px; text-decoration: none;
        font-weight: 600; font-size: 13px; margin-top: 6px; transition: all 0.2s;
    }
    .call-btn:hover { background: #dcfce7; }
</style>
@endsection

@section('content')
<div class="detail-container">
    <a href="{{ url('admin/driver') }}" class="back-link">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to deliveries
    </a>

    <div class="status-bar {{ $order->status }}">
        <div>
            <div class="status-label">{{ ucfirst($order->status) }}</div>
            <div class="status-order">{{ $order->order_number }}</div>
        </div>
        <div style="font-size: 13px; color: #4b5563;">{{ $order->created_at->format('M d, H:i') }}</div>
    </div>

    {{-- Customer Info --}}
    <div class="detail-card">
        <div class="detail-card-title">Customer</div>

        <div class="info-row">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <div class="info-label">Name</div>
                <div class="info-value">{{ $order->customer_name }}</div>
            </div>
        </div>

        <div class="info-row">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <div>
                <div class="info-label">Phone</div>
                <div class="info-value"><a href="tel:{{ $order->customer_phone }}">{{ $order->customer_phone }}</a></div>
                <a href="tel:{{ $order->customer_phone }}" class="call-btn">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call Customer
                </a>
            </div>
        </div>
    </div>

    {{-- Delivery Address --}}
    <div class="detail-card">
        <div class="detail-card-title">Delivery Address</div>
        <div class="info-row">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="#6366f1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div class="info-label">Address</div>
                <div class="info-value">{{ $order->address }}</div>
                @if($order->city || $order->state)
                    <div class="info-value" style="font-weight:500; color:#4b5563;">{{ collect([$order->city, $order->state, $order->postal_code])->filter()->implode(', ') }}</div>
                @endif
                @if($order->country)
                    <div style="font-size:13px; color:#6b7280; margin-top:2px;">{{ $order->country }}</div>
                @endif
            </div>
        </div>

        @if($order->notes)
        <div class="info-row">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
            </div>
            <div>
                <div class="info-label">Notes</div>
                <div class="info-value" style="font-weight:500; color:#92400e;">{{ $order->notes }}</div>
            </div>
        </div>
        @endif
    </div>

    {{-- Order Items --}}
    <div class="detail-card">
        <div class="detail-card-title">Order Items</div>
        @foreach($order->items as $item)
        <div class="item-row">
            <div>
                <div class="item-name">{{ $item->product_name }}</div>
                <div class="item-qty">Qty: {{ $item->quantity }} &times; ${{ number_format($item->unit_price, 2) }}</div>
            </div>
            <div class="item-price">${{ number_format($item->unit_price * $item->quantity, 2) }}</div>
        </div>
        @endforeach

        <div class="total-row">
            <span class="total-label">Total</span>
            <span class="total-value">${{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>

    {{-- Action Button --}}
    <div class="action-bar">
        @if($order->status === 'confirmed')
            <form action="{{ url('admin/driver/' . $order->id . '/status') }}" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="shipped">
                <button type="submit" class="btn-full pickup">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/></svg>
                    Mark as Picked Up
                </button>
            </form>
        @elseif($order->status === 'shipped')
            <form action="{{ url('admin/driver/' . $order->id . '/status') }}" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="delivered">
                <button type="submit" class="btn-full deliver">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Mark as Delivered
                </button>
            </form>
        @elseif($order->status === 'delivered')
            <div class="btn-full done">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Delivered Successfully
            </div>
        @endif
    </div>
</div>
@endsection
