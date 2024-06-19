<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
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
</head>
<body>
    <h1>Payment</h1>
    <button onclick="pay()">Pay Now</button>
</body>
</html>