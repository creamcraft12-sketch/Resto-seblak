@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-[#fdf8f3] pt-24">
  <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-10 w-full max-w-md border border-[#e5d0b1]">

    <!-- Judul -->
    <h2 class="text-3xl font-bold text-center text-[#3a2a18] mb-2">Bergabung dengan resto seblak lely 🍽</h2>
    <p class="text-center text-[#6b5434] mb-6">Nikmat dan gurih dari seblak</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block text-left font-semibold text-[#2b1b0f] mb-1">Nama Lengkap</label>
        <input type="text" id="name" name="name"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="Nama kamu" required>
      </div>

      <div>
        <label for="email" class="block text-left font-semibold text-[#2b1b0f] mb-1">Email</label>
        <input type="email" id="email" name="email"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="contoh@email.com" required>
      </div>

      <div>
        <label for="password" class="block text-left font-semibold text-[#2b1b0f] mb-1">Kata Sandi</label>
        <input type="password" id="password" name="password"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="••••••••" required>
      </div>

      <div>
        <label for="password_confirmation" class="block text-left font-semibold text-[#2b1b0f] mb-1">Konfirmasi Kata Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
          class="w-full border border-[#d1bfa4] focus:border-orange-400 focus:ring-1 focus:ring-orange-400 rounded-lg px-4 py-2 outline-none"
          placeholder="Ulangi kata sandi" required>
      </div>

      <button type="submit"
        class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-lg shadow-md transition">
        Daftar Sekarang
      </button>
    </form>

    <p class="text-center text-[#3a2a18] mt-6">
      Sudah memiliki akun?
      <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-semibold">Masuk di sini</a>
    </p>
  </div>
</section>
@endsection
