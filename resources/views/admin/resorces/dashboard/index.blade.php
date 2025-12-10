@extends('admin.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Dashboard Admin</h2>

<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 shadow rounded">
        <h3>Total Users</h3>
        <p class="text-2xl font-bold">10</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3>Total Pesanan</h3>
        <p class="text-2xl font-bold">25</p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h3>Pendapatan</h3>
        <p class="text-2xl font-bold">Rp 2.500.000</p>
    </div>
</div>
@endsection
