@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="beranda" class="relative w-full h-screen overflow-hidden m-0 p-0">
  <!-- Wrapper Gambar -->
  <div id="hero-slider" class="relative w-full h-full">
    <div class="slide absolute inset-0 bg-cover bg-center opacity-100 scale-100 transition-all duration-[4000ms]"
      style="background-image: url('{{ asset('images/slide1.jpg') }}');"></div>
    <div class="slide absolute inset-0 bg-cover bg-center opacity-0 scale-105 transition-all duration-[4000ms]"
      style="background-image: url('{{ asset('images/slide2.jpg') }}');"></div>
    <div class="slide absolute inset-0 bg-cover bg-center opacity-0 scale-105 transition-all duration-[4000ms]"
      style="background-image: url('{{ asset('images/slide3.jpg') }}');"></div>
  </div>

  <!-- Overlay teks -->
  <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center text-white z-20">
    <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang Di Resto Seblak Lely</h1>
    <p class="text-lg md:text-xl mb-6">Nikmati sajian nikmatnya seblak gurih 🍽</p>
    <a href="#menu" class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-lg font-semibold shadow-lg">Lihat Menu</a>
  </div>

  <!-- Indikator Titik -->
  <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3 z-30">
    <span class="dot w-3 h-3 bg-white rounded-full opacity-100 cursor-pointer transition-all duration-300"></span>
    <span class="dot w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
    <span class="dot w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer transition-all duration-300"></span>
  </div>
</section>

<!-- Menu -->
<section id="menu" class="py-20 text-white text-center">
  <h2 class="text-4xl font-bold mb-12">Menu Terlaris</h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
    <!-- Menu 1 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/1.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Latte Art">
      <h3 class="text-xl font-semibold">Seblak + Komplit</h3>
      <p class="text-orange-400 font-bold mb-2">Rp25.000</p>
      <p class="mb-4 text-sm text-gray-300">Seblak komplit adalah hidangan seblak dengan isian lengkap seperti makaroni, bakso, telur, dan berbagai topping lainnya yang disajikan dengan kuah pedas gurih.</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>

    <!-- Menu 2 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/2.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Es Kopi Susu">
      <h3 class="text-xl font-semibold">Seblak + Seafood</h3>
      <p class="text-orange-400 font-bold mb-2">Rp30.000</p>
      <p class="mb-4 text-sm text-gray-300">Seblak seafood adalah seblak dengan tambahan olahan laut seperti udang dan cumi.</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>

    <!-- Menu 3 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/3.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Americano">
      <h3 class="text-xl font-semibold">Seblak + Kerongkongan</h3>
      <p class="text-orange-400 font-bold mb-2">Rp15.000</p>
      <p class="mb-4 text-sm text-gray-300">Seblak kerongkongan adalah seblak dengan isian kerongkongan ayam yang dimasak dengan kuah pedas dan beraroma khas.</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>

    <!-- Menu 4 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/4.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Cappuccino">
      <h3 class="text-xl font-semibold">Kwetiaw + Komplit</h3>
      <p class="text-orange-400 font-bold mb-2">Rp20.000</p>
      <p class="mb-4 text-sm text-gray-300">Kwetiaw komplit adalah hidangan kwetiaw dengan isian lengkap seperti bakso, sosis, telur, dan berbagai topping lainnya</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>

    <!-- Menu 5 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/5.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Mocha">
      <h3 class="text-xl font-semibold">Kwetiaw + Sosis + Telor</h3>
      <p class="text-orange-400 font-bold mb-2">Rp18.000</p>
      <p class="mb-4 text-sm text-gray-300">Kwetiaw sosis telor adalah hidangan kwetiaw yang disajikan dengan tambahan sosis dan telur yang dimasak dengan bumbu gurih.</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>

    <!-- Menu 6 -->
    <div class="bg-gray-800 p-5 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition-all duration-300">
      <img src="{{ asset('images/6.jpg') }}" class="rounded-xl mb-4 w-full h-60 object-cover" alt="Aneka Kue">
      <h3 class="text-xl font-semibold">Ceker + Komplit</h3>
      <p class="text-orange-400 font-bold mb-2">Rp22.000</p>
      <p class="mb-4 text-sm text-gray-300">Ceker komplit adalah hidangan dengan ceker ayam yang dipadukan dengan berbagai tambahan isian lengkap.</p>
      @auth
  <a href="{{ route('order') }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@else
  <a href="{{ route('login', ['info' => 'Silakan login terlebih dahulu untuk memesan.']) }}" 
     class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg">
     Pesan Sekarang
  </a>
@endauth
    </div>
  </div>
  <!-- Tombol Menu Lainnya -->
<div class="mt-20 mb-6 text-center">
  <a href="{{ route('menu.lainnya') }}" 
     class="text-orange-400 hover:text-orange-500 font-semibold text-lg transition-all duration-300 hover:underline decoration-2 underline-offset-4">
     🍽 Menu Lainnya
  </a>
</div>

</section>



<!-- Tentang Kami -->
<section id="about" class="py-20 bg-[#fdf8f3] text-[#2b1b0f]">
  <div class="max-w-6xl mx-auto px-6 md:flex items-center gap-10">
    <!-- Gambar -->
    <div class="md:w-1/2 mb-8 md:mb-0">
      <img src="{{ asset('images/slide2.jpg') }}"
           alt="Kedai Rifkan"
           class="rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300">
    </div>

    <!-- Teks -->
    <div class="md:w-1/2">
      <h2 class="text-3xl font-bold text-[#1b130d] mb-4">Tentang Resto Kami</h2>
      <p class="text-lg leading-relaxed text-[#3a281c] mb-4">
        <span class="font-semibold">"Resto Seblak Lely" </span>Resto Kami Seblak Lely merupakan sebuah tempat kuliner yang berkomitmen menyajikan aneka hidangan seblak dengan cita rasa khas, menggunakan bahan-bahan segar dan pilihan topping yang beragam, sehingga setiap pelanggan dapat menikmati pengalaman makan yang lezat, nyaman, dan memuaskan, didukung oleh pelayanan yang ramah serta suasana yang sederhana namun hangat.
      </p>
      <p class="text-lg leading-relaxed text-[#3a281c] mb-4">
       Selain menghadirkan menu seblak yang kaya rasa dan penuh pilihan, Resto Kami Seblak Lely juga terus berupaya meningkatkan kualitas pelayanan dengan menjaga kebersihan, ketepatan waktu penyajian, serta memberikan harga yang terjangkau bagi semua kalangan. Dengan konsep sederhana namun penuh kehangatan, kami berharap setiap pelanggan dapat merasa puas dan ingin kembali menikmati hidangan khas yang menjadi unggulan di Resto Seblak Lely
      </p>
      <p class="text-lg leading-relaxed text-[#3a281c]">
        Kami percaya bahwa <span class="text-orange-500 font-semibold">Resto Seblak Lely selalu menjaga kualitas rasa dan pelayanan</span> untuk memberikan kepercayaan penuh kepada setiap pelanggan.
      </p>
    </div>
  </div>
</section>

<!-- Location -->
<section id="location" class="bg-gray-900 text-white py-16 text-center">
  <h2 class="text-3xl font-bold mb-6">Lokasi Resto</h2>

  <!-- Peta -->
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0988220924396!2d106.59147907499062!3d-6.250707993737734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fd2225209419%3A0x85df177fe6451eee!2sSeblak%20Lely!5e0!3m2!1sid!2sid!4v1764775417661!5m2!1sid!2sid" 
    class="w-full h-80 border-0 rounded-lg mb-6" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>

  <!-- Tombol -->
  <a href="https://maps.app.goo.gl/BwRkyNTk2MQp5YYC8"
   target="_blank" 
   class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition-all duration-300">
  📍Google Maps
</a>
</section>


<!-- Contact -->
<section id="contact" class="bg-black text-white py-16 text-center">
  <h2 class="text-3xl font-bold mb-6">Kontak Resto</h2>
  <p>Dasana Indah Blok TB 2 No 25, RT.06/RW.021, Bojong Nangka, Kecamatan Kelapa Dua, Kabupaten Tangerang, Banten 15821</p>
  <p>Telepon: +62 852-8043-7768 | Email: creamcraft12@gmail.com</p>
  <p>Jam Buka: 08.00 - 22.00</p>
</section>



<!-- SCRIPT SLIDER -->
<script>
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');
  let current = 0;
  let interval;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.opacity = (i === index) ? '1' : '0';
      slide.style.transform = (i === index) ? 'scale(1.08)' : 'scale(1)';
      dots[i].style.opacity = (i === index) ? '1' : '0.5';
    });
    current = index;
  }

  function startAutoSlide() {
    interval = setInterval(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 4000);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      clearInterval(interval);
      showSlide(i);
      startAutoSlide();
    });
  });

  showSlide(0);
  startAutoSlide();
</script>

<!-- SCRIPT ANIMASI ZOOM MENU -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const menuCards = document.querySelectorAll("#menu .bg-gray-800");

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("zoom-in");
          observer.unobserve(entry.target); // animasi hanya muncul sekali
        }
      });
    }, { threshold: 0.2 });

    menuCards.forEach(card => observer.observe(card));
  });
</script>

<style>
  body {
    margin: 0;
    padding: 0;
    background: #f6f2ec;
    font-family: 'Poppins', sans-serif;
    color: #2b1b0f;
  }

  /* ======================= HERO ======================= */
  .slide {
    transition: transform 5s ease-in-out, opacity 1.2s ease-in-out;
  }

  #beranda::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1), rgba(20, 10, 5, 0.3));
    z-index: 1;
  }

  #beranda .absolute.text-center {
    z-index: 2;
  }

  /* ======================= DOT ======================= */
  .dot {
    width: 12px;
    height: 12px;
    background-color: #fff;
    border: 2px solid #d97706;
    border-radius: 50%;
    transition: all 0.3s ease;
  }

  .dot:hover {
    background-color: #d97706;
    opacity: 1 !important;
  }

  /* ======================= SECTION BACKGROUND ======================= */

  /* Menu — tetap dark aesthetic agar kontras */
  #menu {
    background: linear-gradient(180deg, #ee9383ff 0%, #3e2414 50%, #999592ff 100%);
    color: #fff;
  }

  /* Tentang Kami — cerah dan lembut (beige-krem) */
  #about {
    background: linear-gradient(180deg, #999592ff 100%);
    color: #3a2a18;
  }

  /* Testimoni — putih krem dengan sentuhan kopi muda */
  #testimonial {
    background: linear-gradient(180deg, #fff9f3 0%, #f5e8da 60%, #ecd9c4 100%);
    color: #3b2a17;
  }

  /* Lokasi — tone hangat tapi terang */
  #location {
    background: linear-gradient(180deg, #939290ff 100%);
    color: #2b1b0f;
  }

  /* Kontak — soft golden beige */
  #contact {
    background: linear-gradient(180deg, #d4cfcbff 100%);
    color: #3a2a18;
  }

/* ANIMASI ZOOM SAAT SCROLL */
#menu .bg-gray-800 {
  opacity: 0;
  transform: scale(0.9);
  transition: all 0.8s ease;
}

#menu .bg-gray-800.zoom-in {
  opacity: 1;
  transform: scale(1);
}

  /* ======================= CARD MENU ======================= */
  .bg-gray-800 {
    background: linear-gradient(145deg, #2b1d17, #1c1a17);
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease-in-out;
  }

  .bg-gray-800:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(234, 88, 12, 0.4);
  }

  /* Tombol */
  a.bg-orange-500 {
    background-color: #d97706;
    box-shadow: 0 0 10px rgba(217, 119, 6, 0.4);
  }

  a.bg-orange-500:hover {
    background-color: #ea580c;
    box-shadow: 0 0 15px rgba(234, 88, 12, 0.6);
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }

  /* Smooth scroll */
  html {
    scroll-behavior: smooth;
  }
</style>
@endsection
