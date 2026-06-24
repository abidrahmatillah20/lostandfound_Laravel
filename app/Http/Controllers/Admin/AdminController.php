<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Dashboard admin
    public function dashboard()
    {
        $stats = [
            'total'    => Item::count(),
            'pending'  => Item::where('status', 'pending')->count(),
            'approved' => Item::where('status', 'approved')->count(),
            'rejected' => Item::where('status', 'rejected')->count(),
            'returned' => Item::where('status', 'returned')->count(),
            'lost'     => Item::where('lost_or_found', 'lost')->count(),
            'found'    => Item::where('lost_or_found', 'found')->count(),
            'users'    => User::where('role', 'user')->count(),
        ];

        $recentItems = Item::with(['user', 'category'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentItems'));
    }

    // Daftar semua laporan
    public function items(Request $request)
    {
        $query = Item::with(['user', 'category']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('lost_or_found', $request->type);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $items      = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.items', compact('items', 'categories'));
    }

    // Update status laporan
    public function updateStatus(Request $request, Item $item)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,returned',
        ]);

        $item->update(['status' => $request->status]);

        $messages = [
            'approved' => 'Laporan berhasil disetujui.',
            'rejected' => 'Laporan berhasil ditolak.',
            'returned' => 'Status barang diubah menjadi sudah dikembalikan.',
            'pending'  => 'Status laporan direset ke pending.',
        ];

        return back()->with('success', $messages[$request->status]);
    }

    // Hapus laporan oleh admin
    public function destroyItem(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return back()->with('success', 'Laporan berhasil dihapus.');
    }

    // ============ CRUD KATEGORI ============

    public function categories()
    {
        $categories = Category::withCount('items')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Kategori sudah ada.',
        ]);

        Category::create(['name' => $request->name]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Kategori sudah ada.',
        ]);

        $category->update(['name' => $request->name]);

        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->items()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih ada laporan terkait.');
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
