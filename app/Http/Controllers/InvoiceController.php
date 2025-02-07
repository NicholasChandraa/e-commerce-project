<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Tampilkan halaman invoice untuk order tertentu.
     */
    public function show(Order $order)
    {
        // Pastikan user yang login adalah pemilik order
        if (Auth::id() !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Pastikan order sudah memiliki invoice_number (menandakan pembayaran telah dikonfirmasi)
        if (!$order->invoice_number) {
            return redirect()->back()->with('error', 'Invoice belum tersedia.');
        }

        // Load relasi orderItems beserta produk (jika belum di-load)
        $order->load('orderItems.product');

        return view('invoice.show', compact('order'));
    }
}
