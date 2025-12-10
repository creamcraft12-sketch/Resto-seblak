<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Kopi Hitam',
                'description' => 'Kopi hitam klasik dengan rasa pahit yang kuat.',
                'price' => 15000,
                'image' => 'images/1.jpg',
                'category' => 'kopi',
                'is_available' => true,
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Espresso dengan susu kukus dan busa lembut.',
                'price' => 20000,
                'image' => 'images/2.jpg',
                'category' => 'kopi',
                'is_available' => true,
            ],
            [
                'name' => 'Latte',
                'description' => 'Kopi susu dengan rasa creamy dan lembut.',
                'price' => 22000,
                'image' => 'images/3.jpg',
                'category' => 'kopi',
                'is_available' => true,
            ],
            [
                'name' => 'Mocha',
                'description' => 'Perpaduan kopi dan cokelat yang nikmat.',
                'price' => 25000,
                'image' => 'images/4.jpg',
                'category' => 'kopi',
                'is_available' => true,
            ],
            [
                'name' => 'Roti Bakar',
                'description' => 'Roti panggang hangat dengan pilihan selai.',
                'price' => 10000,
                'image' => 'images/5.jpg',
                'category' => 'makanan',
                'is_available' => true,
            ],
            [
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng spesial dengan telur dan ayam.',
                'price' => 25000,
                'image' => 'images/nasigoreng.jpg',
                'category' => 'makanan',
                'is_available' => true,
            ],
            [
                'name' => 'Mie Rebus',
                'description' => 'Mie dengan kuah kaldu ayam yang gurih.',
                'price' => 18000,
                'image' => 'images/mierebus.jpg',
                'category' => 'makanan',
                'is_available' => true,
            ],
            [
                'name' => 'Pisang Goreng',
                'description' => 'Pisang goreng renyah dengan taburan keju.',
                'price' => 12000,
                'image' => 'images/pisanggoreng.jpg',
                'category' => 'makanan',
                'is_available' => true,
            ],
            [
                'name' => 'Es Kopi Susu Gula Aren',
                'description' => 'Perpaduan kopi, susu, dan manisnya gula aren.',
                'price' => 20000,
                'image' => 'images/aren.jpg',
                'category' => 'minuman',
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}