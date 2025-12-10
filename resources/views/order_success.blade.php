@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Status Pesanan</h2>

    <div class="mb-4">
      <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
      <p><strong>Channel:</strong> {{ ucfirst($order->channel) }}</p>
      <p><strong>Total:</strong> Rp {{ number_format($order->total,0,',','.') }}</p>
      <p><strong>Status:</strong> <span id="orderStatus">{{ $order->status }}</span></p>
    </div>

    <div class="mb-4 text-center">
      <p class="mb-3">Silakan selesaikan pembayaran melalui popup yang telah muncul.</p>
      <p>Jika popup tidak muncul, klik tombol di bawah:</p>
      <button id="payButton" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded mt-2">Bayar Sekarang</button>
    </div>

    <div class="mt-4 text-right">
      <a href="{{ route('home') }}" class="bg-orange-500 text-white px-4 py-2 rounded">Kembali ke Beranda</a>
    </div>
  </div>
</section>

<!-- Include Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const orderCode = "{{ $order->order_code }}";
  const statusEl = document.getElementById('orderStatus');
  const payButton = document.getElementById('payButton');
  const snapToken = "{{ session('snap_token') }}";

  // Show Snap popup if token exists
  if (snapToken) {
    snap.pay(snapToken, {
      onSuccess: function(result) {
        statusEl.textContent = 'success';
        alert('Pembayaran berhasil!');
        window.location.href = '{{ url('/order/success/' . $order->order_code) }}';
      },
      onPending: function(result) {
        statusEl.textContent = 'pending';
        alert('Pembayaran tertunda.');
        window.location.href = '{{ url('/order/success/' . $order->order_code) }}';
      },
      onError: function(result) {
        statusEl.textContent = 'error';
        alert('Pembayaran gagal. Silakan coba lagi.');
      }
    });
  }

  // Manual payment button
  payButton.addEventListener('click', function() {
    if (snapToken) {
      snap.pay(snapToken);
    } else {
      alert('Token pembayaran tidak tersedia.');
    }
  });

  // auto-check status tiap 20 detik
  async function checkStatus(){
    try {
      // Get CSRF token
      let csrfToken = document.querySelector('meta[name="csrf-token"]');
      if (csrfToken) {
        csrfToken = csrfToken.getAttribute('content');
      } else {
        csrfToken = '{{ csrf_token() }}';
      }
      
      const res = await fetch("{{ url('/payment/status') }}/" + orderCode, {
        headers: {
          'X-CSRF-TOKEN': csrfToken
        }
      });
      if (!res.ok) return;
      const data = await res.json();
      // midtrans status structure often has transaction_status
      const st = data.transaction_status ?? data.status ?? null;
      if (st) {
        statusEl.textContent = st;
      }
      if (st === 'capture' || st === 'settlement' || st === 'success') {
        // transaksi sukses => lakukan aksi (misal notifikasi)
      }
    } catch (e) {
      console.error(e);
    }
  }

  checkStatus();
  setInterval(checkStatus, 20000);
});
</script>
@endsection