@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-2xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-[#3a2a18] mb-8">Tambah Menu Baru</h1>

    <div class="bg-white p-8 rounded-2xl shadow-lg">
      <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Menu</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                 required>
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
          <textarea id="description" name="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('description') }}</textarea>
          @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
          <select id="category" name="category"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>
            <option value="kopi" {{ old('category') == 'kopi' ? 'selected' : '' }}>Kopi</option>
            <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>Makanan</option>
            <option value="minuman" {{ old('category') == 'minuman' ? 'selected' : '' }}>Minuman</option>
            <option value="dessert" {{ old('category') == 'dessert' ? 'selected' : '' }}>Dessert</option>
          </select>
          @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
          <input type="number" id="price" name="price" value="{{ old('price') }}" min="0"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                 required>
          @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Menu</label>
          <input type="file" id="image" name="image" accept="image/*"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
          @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label class="flex items-center">
            <input type="checkbox" name="is_available" value="1" {{ old('is_available') ? 'checked' : 'checked' }}
                   class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
            <span class="ml-2 text-sm font-semibold text-gray-700">Tersedia</span>
          </label>
        </div>

        <div class="flex justify-between">
          <a href="{{ route('admin.menus') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
            Batal
          </a>
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold">
            Simpan Menu
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
