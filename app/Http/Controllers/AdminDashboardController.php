<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Order::with('user')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10)->withQueryString();

        // STATUS = persis seperti di DB
        $availableStatuses = [
            'pending'      => 'Waiting PickUp',
            'collected'    => 'Collected',
            'in_treatment' => 'In Treatment',
            'finish'       => 'Finish',
        ];

        $summary = [
            'total'        => Order::count(),
            'pending'      => Order::where('status', 'pending')->count(),
            'collected'    => Order::where('status', 'collected')->count(),
            'in_treatment' => Order::where('status', 'in_treatment')->count(),
            'finish'       => Order::where('status', 'finish')->count(),
        ];

        return view('admin.dashboard', compact(
            'orders',
            'status',
            'availableStatuses',
            'summary'
        ));
    }

    public function show(Order $order)
    {
        $order->load('user');

        return view('admin.order-show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,collected,in_treatment,finish',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Status order berhasil diperbarui.');
    }
}
