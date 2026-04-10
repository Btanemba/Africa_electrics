<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index(Request $request)
    {
        $filter = $request->get('filter', 'active');

        $query = Order::where('assigned_to', backpack_user()->id);

        if ($filter === 'active') {
            $query->whereIn('status', ['confirmed', 'shipped']);
        } elseif ($filter === 'delivered') {
            $query->where('status', 'delivered');
        } elseif ($filter === 'pending') {
            $query->where('status', 'pending');
        }

        $orders = $query->latest()->get();

        $counts = [
            'active' => Order::where('assigned_to', backpack_user()->id)->whereIn('status', ['confirmed', 'shipped'])->count(),
            'pending' => Order::where('assigned_to', backpack_user()->id)->where('status', 'pending')->count(),
            'delivered' => Order::where('assigned_to', backpack_user()->id)->where('status', 'delivered')->count(),
        ];

        return view('admin.driver.index', compact('orders', 'filter', 'counts'));
    }

    public function show(Order $order)
    {
        abort_if($order->assigned_to !== backpack_user()->id, 403);

        $order->load('items');

        return view('admin.driver.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        abort_if($order->assigned_to !== backpack_user()->id, 403);

        $request->validate([
            'status' => 'required|in:shipped,delivered',
        ]);

        $order->update(['status' => $request->status]);

        $statusLabel = $request->status === 'shipped' ? 'picked up' : 'delivered';

        return back()->with('success', "Order #{$order->order_number} marked as {$statusLabel}!");
    }
}
