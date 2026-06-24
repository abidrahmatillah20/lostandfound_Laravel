<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    use AuthorizesRequests;

    // Halaman publik: daftar semua barang yang approved
    public function publicIndex(Request $request)
    {
        $query = Item::with(['user', 'category'])
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('type')) {
            $query->where('lost_or_found', $request->type);
        }

        $items      = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('public.items', compact('items', 'categories'));
    }

    // Detail barang publik
    public function publicShow(Item $item)
    {
        $item->loadMissing(['user', 'category']);

        $canViewPrivate = auth()->check()
            && (auth()->id() === $item->user_id || auth()->user()->isAdmin());

        if ($item->status !== 'approved' && ! $canViewPrivate) {
            abort(404);
        }

        return view('public.show', compact('item'));
    }

    // Dashboard user: laporan miliknya sendiri
    public function dashboard(Request $request)
    {
        $query = auth()->user()->items()->with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        return view('items.dashboard', compact('items'));
    }

    // Form tambah laporan
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    // Simpan laporan baru
    public function store(ItemRequest $request)
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();
        $data['status']  = 'pending';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil dikirim! Menunggu verifikasi admin.');
    }

    // Form edit laporan
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    // Update laporan
    public function update(ItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $data           = $request->validated();
        $data['status'] = 'pending'; // reset ke pending setelah diedit

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil diperbarui!');
    }

    // Hapus laporan
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
