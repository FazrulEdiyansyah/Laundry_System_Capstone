<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        // Ambil order aktif milik user yang sedang login
        $activeOrder = \App\Models\Order::where('user_id', auth()->id())
            ->whereIn('status', ['collected', 'in_treatment'])
            ->latest()
            ->first();

        // Ambil semua order milik user untuk riwayat
        $orders = \App\Models\Order::where('user_id', auth()->id())->get();

        return view('customer.dashboard', compact('activeOrder', 'orders'));
    }
}
