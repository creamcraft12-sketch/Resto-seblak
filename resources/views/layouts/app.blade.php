<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Seblak Lely Resto</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-[#f6f2ec] text-[#2b1b0f] font-sans">

  <!-- Navbar -->
  <nav class="fixed w-full bg-[#E63946]/95 backdrop-blur-md shadow-lg z-50 border-b border-[#F26419]/60">
    <div class="max-w-6xl mx-auto flex items-center 
      {{ request()->routeIs('menu.lainnya') || request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('order') ? 'justify-center' : 'justify-between' }} px-6 py-3">

      <!-- Logo -->
      <a href="/" class="font-bold text-lg text-[#f2d7b3]">SEBLAK LELY RESTO</a>

      <!-- Hanya tampil jika BUKAN di halaman menu.lainnya, login, atau register -->
      @if (!request()->routeIs('menu.lainnya') && !request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('order'))
        <ul class="hidden md:flex space-x-8 text-[#f6e8d5]">
          <li><a href="#beranda" class="hover:text-orange-400 transition">Beranda</a></li>
          <li><a href="#menu" class="hover:text-orange-400 transition">Menu</a></li>
          <li><a href="#about" class="hover:text-orange-400 transition">Tentang Kami</a></li>
          <li><a href="#location" class="hover:text-orange-400 transition">Lokasi</a></li>
          <li><a href="#contact" class="hover:text-orange-400 transition">Kontak</a></li>
        </ul>

        <div>
          @auth
            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit"
                class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg text-white font-semibold shadow-md transition">
                Logout
              </button>
            </form>
          @else
            <!-- Tombol Login -->
            <a href="{{ route('login') }}"
              class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg text-white font-semibold shadow-md transition">
              Login
            </a>
          @endauth
        </div>
      @endif
    </div>
  </nav>

  <!-- Konten Dinamis -->
  <main class="pt-0">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="text-center py-6 text-[#f2d7b3]"
    style="background: linear-gradient(180deg, #dc1f1fff 100%);">
    <div class="space-x-4 mb-3">
      <a href="#" class="hover:text-orange-400 font-medium transition">Kebijakan Privasi</a> | <a href="#" class="hover:text-orange-400 font-medium transition">Syarat & Ketentuan</a>
    </div>
    <div class="flex justify-center space-x-4 mb-3 text-xl">
      <a href="#" class="hover:text-orange-400 transition transform hover:scale-110">
        <i class="fab fa-instagram"></i>
      </a>
    </div>
    <p class="text-sm text-[#e9cda9]">© Resto Seblak Lely . All rights reserved.</p>
  </footer>

  <script>
    // Smooth scroll effect
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>

</body>
</html>
