@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-[#fdf8f3] pt-28 pb-20">
  <div class="max-w-2xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-[#3a2a18] mb-8">Edit Menu</h1>

    <div class="bg-white p-8 rounded-2xl shadow-lg">
      <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Menu</label>
          <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                 required>
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
          <textarea id="description" name="description" rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('description', $menu->description) }}</textarea>
          @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
          <select id="category" name="category"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500" required>
            <option value="kopi" {{ old('category', $menu->category) == 'kopi' ? 'selected' : '' }}>Kopi</option>
            <option value="makanan" {{ old('category', $menu->category) == 'makanan' ? 'selected' : '' }}>Makanan</option>
            <option value="minuman" {{ old('category', $menu->category) == 'minuman' ? 'selected' : '' }}>Minuman</option>
            <option value="dessert" {{ old('category', $menu->category) == 'dessert' ? 'selected' : '' }}>Dessert</option>
          </select>
          @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
          <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" min="0"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
                 required>
          @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Menu</label>
          @if($menu->image)
            <div class="mb-2">
              <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
          @endif
          <input type="file" id="image" name="image" accept="image/*"
                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
          <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
          @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label class="flex items-center">
            <input type="checkbox" name="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
            <span class="ml-2 text-sm font-semibold text-gray-700">Tersedia</span>
          </label>
        </div>

        <div class="flex justify-between">
          <a href="{{ route('admin.menus') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
            Batal
          </a>
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold">
            Update Menu
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
