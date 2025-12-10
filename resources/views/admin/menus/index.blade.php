@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-[#3a2a18]">Kelola Menu</h1>
      <a href="{{ route('admin.menus.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold">
        + Tambah Menu
      </a>
    </div>

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
              <th class="text-left py-4 px-6">Gambar</th>
              <th class="text-left py-4 px-6">Nama</th>
              <th class="text-left py-4 px-6">Kategori</th>
              <th class="text-left py-4 px-6">Harga</th>
              <th class="text-left py-4 px-6">Status</th>
              <th class="text-left py-4 px-6">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($menus as $menu)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-4 px-6">
                @if($menu->image)
                  <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-16 h-16 object-cover rounded-lg">
                @else
                  <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                  </div>
                @endif
              </td>
              <td class="py-4 px-6 font-semibold">{{ $menu->name }}</td>
              <td class="py-4 px-6">{{ ucfirst($menu->category) }}</td>
              <td class="py-4 px-6">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
              <td class="py-4 px-6">
                <span class="px-2 py-1 rounded-full text-xs font-semibold
                  @if($menu->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                  {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                </span>
              </td>
              <td class="py-4 px-6">
                <div class="flex space-x-2">
                  <a href="{{ route('admin.menus.edit', $menu->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                    Edit
                  </a>
                  <form action="{{ route('admin.menus.delete', $menu->id) }}" method="POST" class="inline"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="py-8 px-6 text-center text-gray-500">
                Belum ada menu yang ditambahkan.
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
