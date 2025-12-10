<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    @include('admin.layouts.navbar')

    <div class="flex">
        @include('admin.layouts.sidebar')

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @include('admin.layouts.footer')

</body>
</html>
