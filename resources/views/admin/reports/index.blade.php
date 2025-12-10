@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-7xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-[#3a2a18] mb-8">Laporan Penjualan</h1>

    <!-- Date Filter Form -->
    <div class="bg-white p-6 rounded-2xl shadow-lg mb-8">
      <form method="GET" action="{{ route('admin.reports') }}" class="flex flex-wrap gap-4 items-end">
        <div>
          <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
          <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
        </div>
        <div>
          <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Akhir</label>
          <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                 class="border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
        </div>
        <div>
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold">
            Filter
          </button>
        </div>
      </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Total Pendapatan</h3>
        <p class="text-3xl font-bold text-green-500">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Total Pesanan</h3>
        <p class="text-3xl font-bold text-blue-500">{{ $totalOrders }}</p>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold text-gray-600">Rata-rata per Pesanan</h3>
        <p class="text-3xl font-bold text-purple-500">
          Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, ',', '.') : '0' }}
        </p>
      </div>
    </div>

    <!-- Popular Items -->
    <div class="bg-white p-6 rounded-2xl shadow-lg mb-8">
      <h2 class="text-2xl font-bold text-[#3a2a18] mb-6">Menu Terlaris</h2>
      @if(count($popularItems) > 0)
        <div class="overflow-x-auto">
          <table class="w-full table-auto">
            <thead>
              <tr class="border-b">
                <th class="text-left py-3 px-4">Menu</th>
                <th class="text-left py-3 px-4">Jumlah Terjual</th>
              </tr>
            </thead>
            <tbody>
              @foreach($popularItems as $item => $count)
              <tr class="border-b">
                <td class="py-3 px-4 font-semibold">{{ $item }}</td>
                <td class="py-3 px-4">{{ $count }} porsi</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-gray-500 text-center py-8">Belum ada data penjualan.</p>
      @endif
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-[#3a2a18] p-6 pb-0">Detail Pesanan</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto">
          <thead class="bg-gray-50">
            <tr>
              <th class="text-left py-4 px-6">Kode Pesanan</th>
              <th class="text-left py-4 px-6">Pelanggan</th>
              <th class="text-left py-4 px-6">Total</th>
              <th class="text-left py-4 px-6">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @forelse($orders as $order)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-4 px-6 font-semibold">{{ $order->order_code }}</td>
              <td class="py-4 px-6">{{ $order->user->name ?? 'N/A' }}</td>
              <td class="py-4 px-6">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
              <td class="py-4 px-6">{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="py-8 px-6 text-center text-gray-500">
                Tidak ada pesanan dalam periode ini.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-6">
      <a href="{{ route('admin.dashboard') }}" class="text-orange-600 hover:underline">
        ← Kembali ke Dashboard
      </a>
    </div>
  </div>
</section>
@endsection
