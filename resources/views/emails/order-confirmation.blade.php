<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: #1f2937; color: #fff; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .order-info { background: #f9fafb; border-radius: 8px; padding: 16px; margin: 16px 0; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th { background: #f3f4f6; text-align: left; padding: 8px 12px; font-size: 14px; }
        td { padding: 8px 12px; border-bottom: 1px solid #e5e7eb; font-size: 14px; }
        .total { font-size: 18px; font-weight: bold; text-align: right; margin-top: 12px; }
        .track-btn { display: inline-block; background: #1f2937; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; margin-top: 16px; }
        .footer { text-align: center; color: #9ca3af; font-size: 12px; padding: 20px; border-top: 1px solid #e5e7eb; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0;">Order Confirmation</h1>
    </div>
    <div class="content">
        <p>Hi {{ $order->customer_name }},</p>
        <p>Thank you for your order! We've received it our sales representative will contact you shortly and will begin processing your order .</p>
        <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>

        <div class="order-info">
            <p style="margin:0;"><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p style="margin:0;"><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
            <p style="margin:0;"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p style="margin:0;"><strong>Payment Method:</strong> Cash on Delivery</p>
        </div>

        <div class="order-info" style="border:1px solid #fde68a; background:#fffbeb;">
            <p style="margin:0;"><strong>Pay on Delivery</strong></p>
            <p style="margin:4px 0 0 0;">Please pay the delivery driver when your order arrives.</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: ${{ number_format($order->total_amount, 2) }}</p>

        <div class="order-info">
            <p style="margin:0;"><strong>Shipping Address:</strong></p>
            <p style="margin:0;">{{ $order->address }}</p>
            @if($order->city || $order->state || $order->postal_code)
                <p style="margin:0;">{{ collect([$order->city, $order->state, $order->postal_code])->filter()->implode(', ') }}</p>
            @endif
            @if($order->country)
                <p style="margin:0;">{{ $order->country }}</p>
            @endif
        </div>

        <p>You can track your order status anytime using the link below:</p>
        <a href="{{ url('/track-order?order_number=' . $order->order_number) }}" class="track-btn">Track Your Order</a>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Africa Electrics') }}. All rights reserved.</p>
    </div>
</body>
</html>
