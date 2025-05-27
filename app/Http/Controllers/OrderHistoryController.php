<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::where('customer_id', Auth::id());

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_order', [$request->start_date, $request->end_date]);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by order number
        if ($request->filled('search')) {
            $query->where('no_order', 'like', '%' . $request->search . '%');
        }

        $orders = $query->orderBy('tgl_order', 'desc')->paginate(10);

        return view('order-history.index', compact('orders'));
    }

    public function show(Pesanan $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        return view('order-history.show', compact('order'));
    }
} 