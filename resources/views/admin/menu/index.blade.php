@extends('admin.layout', ['pageTitle' => 'Kelola Menu', 'pageSubtitle' => 'Daftar semua item menu dari Supabase'])

@section('content')
<div class="bg-white rounded-xl border border-coffee-200 overflow-hidden">

    {{-- Header --}}
    <div class="px-5 py-4 border-b border-coffee-100 flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
        <div>
            <h3 class="font-black text-coffee-900 text-base">Daftar Menu</h3>
            <p class="text-xs text-slate-400 mt-0.5">
                Total: <span class="font-bold text-coffee-900">{{ $menus->total() }}</span> item
                @if(!$search)
                &nbsp;|&nbsp;
                Aktif: <span class="font-bold text-green-600">{{ $menus->getCollection()->where('is_active', true)->count() }}</span>
                &nbsp;|&nbsp;
                Nonaktif: <span class="font-bold text-slate-400">{{ $menus->getCollection()->where('is_active', false)->count() }}</span>
                @endif
            </p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <form action="{{ route('admin.menu') }}" method="GET" class="relative w-full sm:w-64">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama menu..."
                       class="w-full pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:border-primary focus:ring-primary shadow-sm bg-slate-50">
            </form>
            <a href="{{ route('admin.menu.create') }}"
               class="flex items-center gap-2 bg-primary text-white px-4 py-2.5 rounded-lg font-bold text-sm hover:bg-primary/90 transition shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i> <span class="hidden sm:inline">Tambah Menu</span>
            </a>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="mx-5 mt-4 p-3 rounded-lg bg-green-50 text-green-700 border border-green-200 flex items-center gap-2 text-sm font-semibold">
        <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto mt-2">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-coffee-50 text-left">
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider w-14">Foto</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Menu</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Harga</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coffee-100">
                @forelse($menus as $menu)
                <tr class="hover:bg-coffee-50/60 transition-colors">

                    {{-- Thumbnail --}}
                    <td class="px-5 py-3">
                        @if($menu->img)
                            <img src="{{ $menu->img }}" alt="{{ $menu->name }}"
                                 class="w-12 h-12 rounded-lg object-cover bg-coffee-100 border border-coffee-100"
                                 onerror="this.outerHTML='<div class=\'w-12 h-12 rounded-lg bg-coffee-100 flex items-center justify-center text-xl\'>☕</div>'">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-coffee-100 flex items-center justify-center text-xl">☕</div>
                        @endif
                    </td>

                    {{-- Nama + desc --}}
                    <td class="px-5 py-3">
                        <p class="font-bold text-coffee-900 leading-tight">{{ $menu->name }}</p>
                        @if($menu->desc)
                        <p class="text-xs text-slate-400 mt-0.5 max-w-xs truncate">{{ $menu->desc }}</p>
                        @endif
                    </td>

                    {{-- Kategori badge --}}
                    <td class="px-5 py-3">
                        @php
                            $cats = [
                                'kopi'    => ['☕ Kopi',    'bg-amber-100 text-amber-700'],
                                'teh'     => ['🍵 Teh',     'bg-green-100 text-green-700'],
                                'pastri'  => ['🥐 Pastri',  'bg-yellow-100 text-yellow-700'],
                                'sarapan' => ['🍳 Sarapan', 'bg-orange-100 text-orange-700'],
                            ];
                            [$label, $cls] = $cats[$menu->cat] ?? [$menu->cat, 'bg-slate-100 text-slate-600'];
                        @endphp
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $cls }}">{{ $label }}</span>
                    </td>

                    {{-- Harga --}}
                    <td class="px-5 py-3 font-black text-primary whitespace-nowrap">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </td>

                    {{-- Toggle Status --}}
                    <td class="px-5 py-3 text-center">
                        <form method="POST" action="{{ route('admin.menu.toggle', $menu) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                title="{{ $menu->is_active ? 'Klik untuk nonaktifkan' : 'Klik untuk aktifkan' }}"
                                class="px-3 py-1 rounded-full text-xs font-bold transition-all
                                {{ $menu->is_active
                                    ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                    : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                {{ $menu->is_active ? '✅ Aktif' : '⛔ Nonaktif' }}
                            </button>
                        </form>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-5 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.menu.edit', $menu) }}"
                               class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition text-xs font-bold">
                                <i data-lucide="pencil" class="w-3 h-3"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}"
                                  onsubmit="return confirm('Hapus menu \"{{ addslashes($menu->name) }}\"? Tindakan ini tidak bisa dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition text-xs font-bold">
                                    <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center text-slate-400">
                        <i data-lucide="coffee" class="w-12 h-12 mx-auto mb-3 text-slate-300"></i>
                        <p class="font-semibold text-slate-500">
                            {{ $search ? 'Tidak ada menu yang cocok dengan pencarian "' . $search . '"' : 'Belum ada menu sama sekali.' }}
                        </p>
                        @if(!$search)
                        <p class="text-xs mt-1">Klik tombol "Tambah Menu" untuk mulai menambahkan.</p>
                        @else
                        <a href="{{ route('admin.menu') }}" class="text-primary text-sm font-bold mt-2 inline-block hover:underline">Reset Pencarian</a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($menus->hasPages())
    <div class="px-5 py-4 border-t border-coffee-100">
        {{ $menus->links() }}
    </div>
    @endif

</div>
@endsection
