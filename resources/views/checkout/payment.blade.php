<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        function pay() {
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    window.location.href = "{{ route('payment.success') }}";
                },
                // Optional
                onPending: function(result) {
                    window.location.href = "{{ route('payment.pending') }}";
                },
                // Optional
                onError: function(result) {
                    window.location.href = "{{ route('payment.error') }}";
                }
            });
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/njs-logo-2.jpg') }}" type="image/x-icon">
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Modal Background -->
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-sm p-6 space-y-4">
            <div class="flex flex-col items-center">
                <!-- Icon -->
                <img src="{{ asset('images/cashless-payment.png') }}" alt="Notification Icon" class="mb-4 h-10">
                <!-- Title -->
                <h2 class="text-lg font-semibold text-center">Klik bayar sekarang untuk memproses</h2>
                <!-- Description -->
                <p class="text-gray-600 text-center text-sm">Kalau kamu klik batal barang dikeranjang akan hilang.</p>
            </div>
            <!-- Buttons -->
            <div class="flex flex-col space-y-2 mt-4 w-full">
                <button onclick="pay()"
                    class="px-4 py-2 bg-purple-500 text-white rounded-lg text-sm font-medium hover:bg-purple-600 w-full">Bayar
                    Sekarang</button>
                <a href="{{ route('home') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium text-center hover:bg-gray-300 w-full">Batal</a>
            </div>
        </div>
    </div>
</body>

</html>
