<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Mengambil semua menu dari database
        $menus = Menu::all();
        
        return view('menu.lainnya', compact('menus'));
    }
}