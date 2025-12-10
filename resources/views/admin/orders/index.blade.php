@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-7xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-[#3a2a18] mb-8">Kelola Pesanan</h1>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead class="bg-gray-50">
            <tr>
              <th class="text-left py-4 px-6">Kode Pesanan</th>
              <th class="text-left py-4 px-6">Pelanggan</th>
              <th class="text-left py-4 px-6">Channel</th>
              <th class="text-left py-4 px-6">Items</th>
              <th class="text-left py-4 px-6">Total</th>
              <th class="text-left py-4 px-6">Status</th>
              <th class="text-left py-4 px-6">Tanggal</th>
              <th class="text-left py-4 px-6">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($orders as $order)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-4 px-6 font-semibold">{{ $order->order_code }}</td>
              <td class="py-4 px-6">{{ $order->user->name ?? 'N/A' }}</td>
              <td class="py-4 px-6">{{ ucfirst($order->channel) }}</td>
              <td class="py-4 px-6">
                @php
                  $items = json_decode($order->items, true);
                  $itemCount = count($items);
                @endphp
                {{ $itemCount }} item{{ $itemCount > 1 ? 's' : '' }}
              </td>
              <td class="py-4 px-6">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td class="py-4 px-6">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="inline">
                  @csrf
                  <select name="status" onchange="this.form.submit()"
                          class="border border-gray-300 rounded px-2 py-1 text-sm focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                </form>
              </td>
              <td class="py-4 px-6">{{ $order->created_at->format('d/m/Y H:i') }}</td>
              <td class="py-4 px-6">
                <button onclick="showOrderDetails({{ $order->id }})"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                  Detail
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="py-8 px-6 text-center text-gray-500">
                Belum ada pesanan.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($orders->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t">
          {{ $orders->links() }}
        </div>
      @endif
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.dashboard') }}" class="text-orange-600 hover:underline">
        ← Kembali ke Dashboard
      </a>
    </div>
  </div>
</section>

<!-- Order Details Modal -->
<div id="orderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Detail Pesanan</h3>
          <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
            <span class="text-2xl">&times;</span>
          </button>
        </div>
        <div id="orderDetailsContent">
          <!-- Content will be loaded here -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function showOrderDetails(orderId) {
  // This would typically make an AJAX call to get order details
  // For now, we'll show a simple message
  document.getElementById('orderDetailsContent').innerHTML = `
    <p class="text-center text-gray-500">Fitur detail pesanan akan diimplementasikan dengan AJAX.</p>
    <p class="text-center mt-4">
      <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
    </p>
  `;
  document.getElementById('orderModal').classList.remove('hidden');
}

function closeModal() {
  document.getElementById('orderModal').classList.add('hidden');
}
</script>
@endsection
