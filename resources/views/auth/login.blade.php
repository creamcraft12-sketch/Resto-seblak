@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-[#999592ff] pt-24">
  <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-10 w-full max-w-md border border-[#e5d0b1]">

    <!-- Judul -->
    <h2 class="text-3xl font-bold text-center text-[#3a2a18] mb-2">Selamat Datang Di Resto Seblak Lely 🍽</h2>
    <p class="text-center text-[#6b5434] mb-6">Harap Masuk Untuk Memesan Menu Kami</p>

    <!-- Pesan sukses dari register -->
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <!-- Pesan jika diarahkan dari tombol "Pesan Sekarang" -->
    @if (request('info'))
      <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-2 rounded mb-4">
        {{ request('info') }}
      </div>
    @endif

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-left font-semibold text-[#2b1b0f] mb-1">Email</label>
        <input type="email" id="email" name="email"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="contoh@email.com" required autofocus>
      </div>

      <div>
        <label for="password" class="block text-left font-semibold text-[#2b1b0f] mb-1">Kata Sandi</label>
        <input type="password" id="password" name="password"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="••••••••" required>
      </div>

      <div class="flex justify-between items-center text-sm text-[#5c4a36]">
        <label><input type="checkbox" class="mr-2 accent-orange-500">Ingat saya</label>
        <a href="#" class="text-orange-500 hover:underline">Lupa kata sandi?</a>
      </div>

      <button type="submit"
        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition">
        Masuk
      </button>
    </form>

    <p class="text-center text-[#3a2a18] mt-6">
      Belum memiliki akun?
      <a href="{{ route('register') }}" class="text-orange-500 hover:underline font-semibold">Daftar Sekarang</a>
    </p>
  </div>
</section>
@endsection
