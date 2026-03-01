<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // ── Daftar semua menu (paginated) ─────────────────────────
    public function index(Request $request)
    {
        $search = $request->query('search');

        $menus = Menu::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->latest()->paginate(15)->appends(['search' => $search]);

        return view('admin.menu.index', compact('menus', 'search'));
    }

    // ── Form tambah menu ───────────────────────────────────────
    public function create()
    {
        return view('admin.menu.create');
    }

    // ── Simpan menu baru ke Supabase ───────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'cat'   => ['required', Rule::in(['kopi','teh','pastri','sarapan'])],
            'price' => 'required|integer|min:0',
            'desc'  => 'nullable|string|max:1000',
            'img'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('menus', 'public');
            $validated['img'] = '/storage/' . $imgPath;
        }

        Menu::create([
            ...$validated,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    // ── Form edit menu ─────────────────────────────────────────
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // ── Simpan perubahan menu ──────────────────────────────────
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'cat'   => ['required', Rule::in(['kopi','teh','pastri','sarapan'])],
            'price' => 'required|integer|min:0',
            'desc'  => 'nullable|string|max:1000',
            'img'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img')) {
            // Hapus gambar lama jika ada dan bukan URL eksternal
            if ($menu->img && str_starts_with($menu->img, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $menu->img));
            }

            $imgPath = $request->file('img')->store('menus', 'public');
            $validated['img'] = '/storage/' . $imgPath;
        } else {
            // Pertahankan gambar lama
            $validated['img'] = $menu->img;
        }

        $menu->update([
            ...$validated,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu "' . $validated['name'] . '" berhasil diperbarui!');
    }

    // ── Hapus menu ─────────────────────────────────────────────
    public function destroy(Menu $menu)
    {
        $name = $menu->name;
        $menu->delete();

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu "' . $name . '" berhasil dihapus.');
    }

    // ── Toggle aktif / nonaktif ────────────────────────────────
    public function toggleActive(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);
        $status = $menu->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->route('admin.menu')
            ->with('success', 'Menu "' . $menu->name . '" berhasil ' . $status . '.');
    }
}
