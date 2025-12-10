<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menu;
use App\Models\Order;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware already applied in routes/web.php for admin group
    }

    public function dashboard()
    {
        // Check if user is admin
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalRevenue',
            'recentOrders'
        ));
    }

    // Menu Management
    public function menus()
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function createMenu()
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        return view('admin.menus.create');
    }

    public function storeMenu(Request $request)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menus'), $imageName);
            $data['image'] = 'images/menus/' . $imageName;
        }

        Menu::create($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan');
    }

    public function editMenu($id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $menu = Menu::findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menus'), $imageName);
            $data['image'] = 'images/menus/' . $imageName;
        }

        $menu->update($data);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diperbarui');
    }

    public function deleteMenu($id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $menu = Menu::findOrFail($id);

        // Delete image file
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus');
    }

    // Order Management
    public function orders()
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    // Sales Reports
    public function reports()
    {
        if (!Auth::user()->is_admin) {
            abort(403, 'Unauthorized');
        }

        $startDate = request('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = request('end_date', now()->format('Y-m-d'));

        $orders = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalRevenue = $orders->sum('total');
        $totalOrders = $orders->count();

        // Popular items
        $popularItems = [];
        foreach ($orders as $order) {
            $items = json_decode($order->items, true);
            foreach ($items as $item) {
                $name = $item['name'];
                if (!isset($popularItems[$name])) {
                    $popularItems[$name] = 0;
                }
                $popularItems[$name] += $item['qty'];
            }
        }
        arsort($popularItems);

        return view('admin.reports.index', compact(
            'orders',
            'totalRevenue',
            'totalOrders',
            'popularItems',
            'startDate',
            'endDate'
        ));
    }
}
