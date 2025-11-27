<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua order aktif
        $activeOrders = Order::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'collected', 'in_treatment'])
            ->latest()
            ->get();

        // Ambil riwayat order yang sudah selesai
        $orderHistory = Order::where('user_id', auth()->id())
            ->where('status', 'finish')
            ->latest()
            ->take(10)
            ->get();

        return view('customer.dashboard', compact('activeOrders', 'orderHistory'));
    }

    public function create()
    {
        return view('customer.order.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|in:cuci_setrika,setrika_lipat',
            'duration' => 'required|in:1,2,3',
            'fragrance' => 'required|string',
            'whatsapp' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $basePrice = $validated['service_type'] == 'cuci_setrika' ? 7000 : 4500;
        $durationCharge = $validated['duration'] == 2 ? 1000 : ($validated['duration'] == 1 ? 2000 : 0);
        $totalPrice = $basePrice + $durationCharge;

        $orderCode = 'LDR-' . strtoupper(uniqid());

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => $orderCode,
            'service_type' => $validated['service_type'],
            'duration' => $validated['duration'],
            'fragrance' => $validated['fragrance'],
            'whatsapp' => $validated['whatsapp'],
            'address' => $validated['address'],
            'weight' => 0, // tambahkan ini!
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Request pick-up berhasil!');
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        return view('customer.order.show', compact('order'));
    }

    public function tracking($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        return view('customer.order.tracking', compact('order'));
    }
}
