@extends('layouts.app')

@section('content')
<section class="py-20 bg-[#fdf8f3] text-center text-[#2b1b0f]">
  <h2 class="text-4xl font-bold mb-4">Semua Menu Kami</h2>
  <p class="text-gray-600 mb-12">Nikmati berbagai pilihan Maknan Seblak🍴</p>

  <!-- Grid Menu -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
    @foreach($menus as $menu)
      <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 text-left">
        <img src="{{ asset($menu->image ?? 'images/1.jpg') }}" class="rounded-xl mb-4 w-full h-56 object-cover" alt="{{ $menu->name }}">
        <h3 class="text-xl font-semibold text-[#3a2a18]">{{ $menu->name }}</h3>
        <p class="text-orange-500 font-bold mb-2">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
        <p class="text-gray-600 text-sm mb-4">{{ $menu->description }}</p>

        @auth
          <!-- Jika user sudah login -->
          <a href="{{ route('order') }}?menu={{ urlencode($menu->name) }}&harga={{ $menu->price }}" 
             class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
             Pesan Sekarang
          </a>
        @else
          <!-- Jika belum login -->
          <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
             class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
             Pesan Sekarang
          </a>
        @endauth
      </div>
    @endforeach
  </div>

  <!-- Tombol kembali -->
  <div class="mt-16">
    <a href="{{ url('/') }}" 
       class="text-orange-600 font-semibold hover:underline transition">
      ← Kembali ke Beranda
    </a>
  </div>
</section>
@endsection