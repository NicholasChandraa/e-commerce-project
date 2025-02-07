<!-- resources/views/admin/order_history.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order History</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/njs-logo-2.jpg') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
    <style>
        @media (max-width: 768px) {
            .responsive-table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .responsive-table thead,
            .responsive-table tbody,
            .responsive-table th,
            .responsive-table td,
            .responsive-table tr {
                display: block;
            }

            .responsive-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .responsive-table tr {
                border: 1px solid #ddd;
                margin-bottom: 10px;
            }

            .responsive-table td {
                border: none;
                border-bottom: 1px solid #ddd;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            .responsive-table td:before {
                position: absolute;
                top: 50%;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                transform: translateY(-50%);
                text-align: left;
                font-weight: bold;
                content: attr(data-label);
            }
        }

        .responsive-table img {
            width: 100%;
            max-width: 50px;
            height: auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    @include('products.layouts.navigation')

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Semua Pesanan</h2>
        <div class="responsive-table">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Order ID</th>
                        <th class="py-2 px-4 border-b">Nama</th>
                        <th class="py-2 px-4 border-b">Gambar Produk</th>
                        <th class="py-2 px-4 border-b">Nama Produk</th>
                        <th class="py-2 px-4 border-b">Jumlah</th>
                        <th class="py-2 px-4 border-b">Total Harga</th>
                        <th class="py-2 px-4 border-b">Invoice Number</th>
                        <th class="py-2 px-4 border-b">Nomor Resi</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="py-2 px-4 border-b" data-label="Order ID">{{ $order->id }}</td>
                                <td class="py-2 px-4 border-b" data-label="User ID">{{ $order->name }}</td>
                                <td class="py-2 px-4 border-b" data-label="Product Image">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                </td>
                                <td class="py-2 px-4 border-b" data-label="Product Name">{{ $item->product->name }}</td>
                                <td class="py-2 px-4 border-b" data-label="Quantity">{{ $item->quantity }}</td>
                                <td class="py-2 px-4 border-b" data-label="Total Price">{{ 'Rp. ' . number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b" data-label="Invoice Number">{{ $order->invoice_number ?? 'Belum ada' }}</td>
                                <td class="py-2 px-4 border-b" data-label="Resi Number">
                                    <div class="resi-container">
                                        <!-- View Mode -->
                                        <div class="view-mode flex items-center gap-2">
                                            <span class="resi-display">
                                                {{ $order->resi_number ?? 'Belum ada' }}
                                            </span>
                                            <button onclick="toggleEdit(this)" 
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>

                                        <!-- Edit Mode (Hidden Initially) -->
                                        <form class="edit-mode hidden flex gap-2 items-center" 
                                            action="{{ route('admin.update_resi', $order) }}" 
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <input type="text" 
                                                name="resi_number" 
                                                value="{{ $order->resi_number ?? '' }}"
                                                class="border p-1 w-32 md:w-48 text-sm rounded"
                                                placeholder="Masukkan resi"
                                                required>
                                            
                                            <div class="flex gap-1">
                                                <button type="submit" 
                                                        class="bg-green-500 text-white px-2 py-1 text-sm rounded hover:bg-green-600">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" 
                                                        onclick="cancelEdit(this)"
                                                        class="bg-red-500 text-white px-2 py-1 text-sm rounded hover:bg-red-600">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b" data-label="Status">{{ $order->status }}</td>
                                <td class="py-2 px-4 border-b" data-label="Date">{{ strftime('%d %B %Y', strtotime($order->created_at)) }}</td>
                                <td class="py-2 px-4 border-b" data-label="Actions">
                                    <form action="{{ route('admin.update_order_status', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="order_status" class="border p-1">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="telah sampai" {{ $order->status == 'telah sampai' ? 'selected' : '' }}>Telah Sampai</option>
                                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-2 py-1">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    function toggleEdit(button) {
        const container = button.closest('.resi-container');
        container.querySelector('.view-mode').classList.add('hidden');
        container.querySelector('.edit-mode').classList.remove('hidden');
    }

    function cancelEdit(button) {
        const container = button.closest('.resi-container');
        container.querySelector('.edit-mode').classList.add('hidden');
        container.querySelector('.view-mode').classList.remove('hidden');
    }
</script>
</html>
