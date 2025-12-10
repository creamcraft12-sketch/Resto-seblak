<nav class="bg-red-700 text-white px-6 py-4 flex justify-between">
    <h1 class="font-bold text-lg">Admin Panel</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-red-900 px-3 py-1 rounded">Logout</button>
    </form>
</nav>
