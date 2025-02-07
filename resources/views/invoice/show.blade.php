@extends("layouts.mainLayout")

@section("content")
<div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar (Original Structure) -->
    <div
        class="inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20"
    >
        @include("settings.layouts.sidebar")
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-100">
        <!-- Burger Button (Original Functionality) -->
        <button id="burger" class="md:hidden bg-white p-2 w-full text-start mb-6 rounded-lg shadow-sm">
            <i class="fas fa-bars text-indigo-600"></i>
        </button>

        <!-- Invoice Card (Modern Design) -->
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-2">
                        <h1 class="text-2xl font-bold text-gray-900">
                            Invoice #{{ $order->invoice_number }}
                        </h1>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- User Info Grid -->
                <div class="grid md:grid-cols-2 gap-8 mt-8">
                    <!-- Customer Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 border-l-4 border-indigo-600 pl-3">
                            Informasi Pelanggan
                        </h3>
                        <div class="space-y-1.5 text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user w-5 text-indigo-600"></i>
                                {{ $order->name }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope w-5 text-indigo-600"></i>
                                {{ $order->email }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone w-5 text-indigo-600"></i>
                                {{ $order->phone }}
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 border-l-4 border-indigo-600 pl-3">
                            Alamat Pengiriman
                        </h3>
                        <div class="space-y-1.5 text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-map-marker-alt w-5 text-indigo-600"></i>
                                {{ $order->address }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-city w-5 text-indigo-600"></i>
                                {{ $order->city }} ({{ $order->postal_code }})
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resi Section -->
                <div class="mt-8 p-4 bg-indigo-50 rounded-lg flex items-center gap-4">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-700">Nomor Resi</h4>
                        <p class="{{ $order->resi_number ? 'text-indigo-600' : 'text-gray-400' }} font-mono">
                            {{ $order->resi_number ?: 'Belum tersedia' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Detail Produk</h2>
                
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Produk</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">Harga</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">Jumlah</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->orderItems as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-12 h-12 object-cover rounded-lg border">
                                        <div>
                                            <p class="font-medium text-gray-700">{{ $item->product->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right text-gray-600">
                                    {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-600">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 text-right font-medium text-gray-700">
                                    {{ 'Rp ' . number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Price -->
                <div class="mt-8 flex justify-end">
                    <div class="w-full md:w-1/3">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <span class="font-semibold text-gray-700">Total Pembayaran :</span>
                            <span class="text-lg font-bold text-indigo-600">
                                {{ 'Rp ' . number_format($order->total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overlay (Original Functionality) -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Original Burger Menu Functionality
    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    burger.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', function () {
        sidebar.classList.add('hidden');
        overlay.classList.add('hidden');
    });
});
</script>

@include("layouts.footer")
@endsection