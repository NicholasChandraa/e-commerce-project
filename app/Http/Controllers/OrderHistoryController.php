<?php
// app/Http/Controllers/OrderHistoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function userOrderHistory($userId)
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest()->get();

        return view('users.order_history', compact('orders'));
    }

    public function adminOrderHistory()
    {
        $orders = Order::with('orderItems.product')->latest()->get();

        return view('admin.order_history', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string|in:pending,dikirim,telah sampai,selesai',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->order_status;
        $order->save();

        return redirect()->route('admin.order_history')->with('success', 'Order status updated successfully.');
    }

    public function updateResi(Request $request, Order $order)
    {
        $request->validate([
            'resi_number' => 'required|string|max:255'
        ]);

        // Debugging
        logger()->info('Updating resi', [
            'order_id' => $order->id,
            'resi' => $request->resi_number,
            'request' => $request->all()
        ]);

        try {
            $order->update([
                'resi_number' => $request->resi_number,
                'status' => 'dikirim'
            ]);
            
            logger()->info('Update successful', $order->toArray());
            return back()->with('success', 'Nomor resi berhasil diperbarui');
            
        } catch (\Exception $e) {
            logger()->error('Update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Gagal memperbarui nomor resi: '.$e->getMessage());
        }
    }
}
