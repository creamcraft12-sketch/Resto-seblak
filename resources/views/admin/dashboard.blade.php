@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-7xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-[#3a2a18] mb-8">Dashboard Admin</h1>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Total Pesanan</h3>
        <p class="text-3xl font-bold text-orange-500">{{ $totalOrders }}</p>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Pesanan Pending</h3>
        <p class="text-3xl font-bold text-yellow-500">{{ $pendingOrders }}</p>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Pesanan Selesai</h3>
        <p class="text-3xl font-bold text-green-500">{{ $completedOrders }}</p>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Total Pendapatan</h3>
        <p class="text-3xl font-bold text-blue-500">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-[#3a2a18] mb-6">Pesanan Terbaru</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr class="border-b">
              <th class="text-left py-3 px-4">Kode Pesanan</th>
              <th class="text-left py-3 px-4">Pelanggan</th>
              <th class="text-left py-3 px-4">Channel</th>
              <th class="text-left py-3 px-4">Total</th>
              <th class="text-left py-3 px-4">Status</th>
              <th class="text-left py-3 px-4">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recentOrders as $order)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-4">{{ $order->order_code }}</td>
              <td class="py-3 px-4">{{ $order->user->name ?? 'N/A' }}</td>
              <td class="py-3 px-4">{{ ucfirst($order->channel) }}</td>
              <td class="py-3 px-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td class="py-3 px-4">
                <span class="px-2 py-1 rounded-full text-xs font-semibold
                  @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                  @elseif($order->status == 'completed') bg-green-100 text-green-800
                  @else bg-gray-100 text-gray-800 @endif">
                  {{ ucfirst($order->status) }}
                </span>
              </td>
              <td class="py-3 px-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
      <a href="{{ route('admin.menus') }}" class="bg-orange-500 hover:bg-orange-600 text-white p-6 rounded-2xl shadow-lg text-center">
        <h3 class="text-xl font-bold mb-2">Kelola Menu</h3>
        <p>Tambah, edit, hapus menu</p>
      </a>
      <a href="{{ route('admin.orders') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-2xl shadow-lg text-center">
        <h3 class="text-xl font-bold mb-2">Kelola Pesanan</h3>
        <p>Monitor dan update status pesanan</p>
      </a>
      <a href="{{ route('admin.reports') }}" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-2xl shadow-lg text-center">
        <h3 class="text-xl font-bold mb-2">Laporan Penjualan</h3>
        <p>Lihat laporan dan analisis</p>
      </a>
    </div>
  </div>
</section>
@endsection
