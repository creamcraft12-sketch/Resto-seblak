@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-4xl mx-auto bg-white/90 backdrop-blur-md shadow-xl rounded-2xl p-8 border border-[#e5d0b1]">
    <h2 class="text-2xl md:text-3xl font-bold text-center text-[#3a2a18] mb-4">Form Pemesanan</h2>

    <form id="orderForm" method="POST" action="{{ route('order.store') }}">
      @csrf

      <!-- Channel -->
      <div class="mb-4">
        <label class="block font-semibold">Pilih Channel</label>
        <select name="channel" id="channel" class="mt-2 w-full border rounded px-3 py-2">
          <option value="dinein">QR Meja</option>
          <option value="takeaway">Takeaway</option>
          <option value="delivery">Delivery</option>
        </select>
      </div>

      <!-- Table code (dine-in) -->
      <div id="tableField" class="mb-4 hidden">
        <label class="block font-semibold">Kode Meja</label>
        <input type="text" name="table_code" value="{{ request('table') }}" class="mt-2 w-full border rounded px-3 py-2" placeholder="contoh: M3">
      </div>

      <!-- Address (delivery) -->
      <div id="addressField" class="mb-4 hidden">
        <label class="block font-semibold">Alamat Pengiriman</label>
        <textarea name="address" class="mt-2 w-full border rounded px-3 py-2" rows="2" placeholder="Alamat lengkap..."></textarea>
      </div>

      <!-- Dynamic menu list -->
      <div id="menuList" class="space-y-3 mb-4">
        <!-- initial item prefilled from query -->
        <div class="menu-row flex gap-3 items-center">
          <select name="menus[0][name]" class="flex-1 border rounded px-3 py-2 menu-select" required>
            <option value="">Pilih Menu</option>
            @foreach($menus as $menu)
              <option value="{{ $menu->name }}" data-price="{{ $menu->price }}" 
                {{ (old('menus.0.name', $prefMenu ?? '') == $menu->name) ? 'selected' : '' }}>
                {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
              </option>
            @endforeach
          </select>
          <input type="number" name="menus[0][price]" class="w-28 border rounded px-3 py-2 price" placeholder="Harga"
                 value="{{ old('menus.0.price', $prefPrice ?? 0) }}" readonly>
          <input type="number" name="menus[0][qty]" class="w-20 border rounded px-3 py-2 qty" value="{{ old('menus.0.qty',1) }}" min="1" required>
          <button type="button" class="remove-row hidden text-sm text-red-600">✕</button>
        </div>
      </div>

      <div class="mb-4 text-right">
        <button type="button" id="addRow" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">+ Tambah Menu</button>
      </div>

      <div class="mb-6 text-right">
        <span class="font-semibold text-lg">Total: <span id="totalText">Rp0</span></span>
        <input type="hidden" name="total" id="totalInput" value="0">
      </div>

      <div class="text-center">
        <button type="submit" id="payButton" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded">Lanjutkan & Buat Pembayaran</button>
      </div>
    </form>
  </div>
</section>

<!-- Include Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const channel = document.getElementById('channel');
  const tableField = document.getElementById('tableField');
  const addressField = document.getElementById('addressField');
  const menuList = document.getElementById('menuList');
  const addRowBtn = document.getElementById('addRow');
  const totalText = document.getElementById('totalText');
  const totalInput = document.getElementById('totalInput');
  const orderForm = document.getElementById('orderForm');
  const payButton = document.getElementById('payButton');
  
  // Data menu dari PHP untuk digunakan di JavaScript
  const menuData = @json($menus->keyBy('name'));

  function toggleFields() {
    const val = channel.value;
    tableField.classList.toggle('hidden', val !== 'dinein');
    addressField.classList.toggle('hidden', val !== 'delivery');
  }
  channel.addEventListener('change', toggleFields);
  toggleFields();

  function recalc() {
    let total = 0;
    menuList.querySelectorAll('.menu-row').forEach(row => {
      const price = parseInt(row.querySelector('.price').value || 0);
      const qty = parseInt(row.querySelector('.qty').value || 0);
      total += price * qty;
    });
    totalText.textContent = 'Rp' + total.toLocaleString('id-ID');
    totalInput.value = total;
  }

  // Fungsi untuk mengatur harga berdasarkan menu yang dipilih
  function setPrice(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const price = selectedOption.getAttribute('data-price') || 0;
    const priceInput = selectElement.closest('.menu-row').querySelector('.price');
    priceInput.value = price;
    recalc();
  }

  // Event listener untuk dropdown menu
  menuList.addEventListener('change', function(e){
    if (e.target.classList.contains('menu-select')) {
      setPrice(e.target);
    }
  });

  menuList.addEventListener('input', function(e){
    if (e.target.classList.contains('qty')) {
      recalc();
    }
  });

  addRowBtn.addEventListener('click', function(){
    const index = menuList.querySelectorAll('.menu-row').length;
    const row = document.createElement('div');
    row.className = 'menu-row flex gap-3 items-center';
    row.innerHTML = `
      <select name="menus[${index}][name]" class="flex-1 border rounded px-3 py-2 menu-select" required>
        <option value="">Pilih Menu</option>
        @foreach($menus as $menu)
          <option value="{{ $menu->name }}" data-price="{{ $menu->price }}">
            {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
          </option>
        @endforeach
      </select>
      <input type="number" name="menus[${index}][price]" class="w-28 border rounded px-3 py-2 price" placeholder="Harga" readonly>
      <input type="number" name="menus[${index}][qty]" class="w-20 border rounded px-3 py-2 qty" value="1" min="1" required>
      <button type="button" class="remove-row text-sm text-red-600">✕</button>
    `;
    menuList.appendChild(row);
  });

  menuList.addEventListener('click', function(e){
    if (e.target.classList.contains('remove-row')) {
      if (menuList.querySelectorAll('.menu-row').length > 1) {
        e.target.closest('.menu-row').remove();
        recalc();
      } else {
        alert('Minimal harus ada satu menu.');
      }
    }
  });

  // Set harga untuk menu yang sudah dipilih
  document.querySelectorAll('.menu-select').forEach(select => {
    if (select.value) {
      setPrice(select);
    }
  });

  // initial calc (in case pref price is present)
  recalc();

  // Handle form submission with AJAX
  orderForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Disable the pay button during processing
    payButton.disabled = true;
    payButton.textContent = 'Memproses...';
    
    // Collect form data
    const formData = new FormData(orderForm);
    
    // Get CSRF token
    let csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
      csrfToken = csrfToken.getAttribute('content');
    } else {
      csrfToken = '{{ csrf_token() }}';
    }
    
    // Send AJAX request
    fetch('{{ route('order.store') }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.snap_token) {
        // Show Snap popup
        snap.pay(data.snap_token, {
          onSuccess: function(result) {
            // Redirect to success page
            window.location.href = '{{ url('/order/success/') }}' + data.order_code;
          },
          onPending: function(result) {
            // Redirect to success page for pending transactions
            window.location.href = '{{ url('/order/success/') }}' + data.order_code;
          },
          onError: function(result) {
            alert('Pembayaran gagal. Silakan coba lagi.');
            payButton.disabled = false;
            payButton.textContent = 'Lanjutkan & Buat Pembayaran';
          },
          onClose: function() {
            payButton.disabled = false;
            payButton.textContent = 'Lanjutkan & Buat Pembayaran';
          }
        });
      } else {
        alert('Gagal membuat pembayaran: ' + (data.message || 'Unknown error'));
        payButton.disabled = false;
        payButton.textContent = 'Lanjutkan & Buat Pembayaran';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan. Silakan coba lagi.');
      payButton.disabled = false;
      payButton.textContent = 'Lanjutkan & Buat Pembayaran';
    });
  });
});
</script>
@endsection