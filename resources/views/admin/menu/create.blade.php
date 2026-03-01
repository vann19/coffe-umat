@extends('admin.layout', ['pageTitle' => 'Tambah Menu Baru', 'pageSubtitle' => 'Tambahkan item baru ke daftar menu kafe'])

@section('content')
<div class="max-w-2xl">

    @if($errors->any())
    <div class="mb-5 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200">
        <div class="flex items-center gap-2 mb-2">
            <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
            <p class="font-bold text-sm">Mohon periksa kembali:</p>
        </div>
        <ul class="list-disc list-inside text-sm space-y-0.5 ml-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl border border-coffee-200 p-6 space-y-5">
        @csrf

        {{-- Nama --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">
                Nama Menu <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" autofocus
                class="w-full rounded-lg border-slate-200 focus:border-primary focus:ring-primary text-sm
                       {{ $errors->has('name') ? 'border-red-400 bg-red-50' : '' }}"
                placeholder="Cth: Caramel Macchiato">
        </div>

        {{-- Kategori + Harga --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="cat"
                    class="w-full rounded-lg border-slate-200 focus:border-primary focus:ring-primary text-sm
                           {{ $errors->has('cat') ? 'border-red-400 bg-red-50' : '' }}">
                    <option value="">— Pilih Kategori —</option>
                    @foreach(['kopi' => '☕ Kopi', 'teh' => '🍵 Teh & Minuman', 'pastri' => '🥐 Pastri Segar', 'sarapan' => '🍳 Sarapan'] as $val => $label)
                        <option value="{{ $val }}" {{ old('cat') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-1">
                    Harga (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="price" value="{{ old('price') }}" min="0"
                    class="w-full rounded-lg border-slate-200 focus:border-primary focus:ring-primary text-sm
                           {{ $errors->has('price') ? 'border-red-400 bg-red-50' : '' }}"
                    placeholder="Cth: 35000">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Deskripsi</label>
            <textarea name="desc" rows="3"
                class="w-full rounded-lg border-slate-200 focus:border-primary focus:ring-primary text-sm"
                placeholder="Deskripsikan menu ini...">{{ old('desc') }}</textarea>
        </div>

        {{-- Upload Gambar --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Upload Gambar</label>
            <input type="file" name="img" accept="image/*"
                id="img-input-create"
                class="w-full rounded-lg border-slate-200 focus:border-primary focus:ring-primary text-sm p-2 bg-slate-50
                       {{ $errors->has('img') ? 'border-red-400 bg-red-50' : '' }}">
            <p class="text-xs text-slate-400 mt-1">Opsional. Format: JPG, PNG, maksimal 2MB.</p>
            {{-- Preview --}}
            <div id="img-preview-create" class="mt-3 hidden">
                <img id="img-preview-create-src" src="" alt="Preview"
                     class="h-32 rounded-lg object-cover border border-coffee-200">
            </div>
        </div>

        {{-- Status Aktif --}}
        <div class="flex items-center gap-3 p-3 rounded-lg bg-coffee-50 border border-coffee-100">
            <input type="checkbox" name="is_active" id="is_active" value="1" checked
                class="w-4 h-4 rounded border-slate-300 text-primary focus:ring-primary cursor-pointer">
            <div>
                <label for="is_active" class="text-sm font-bold text-slate-700 cursor-pointer">
                    Tampilkan di menu aktif
                </label>
                <p class="text-xs text-slate-400">Menu akan langsung muncul di halaman dashboard user</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="pt-4 border-t border-coffee-100 flex justify-end gap-3">
            <a href="{{ route('admin.menu') }}"
               class="px-5 py-2.5 rounded-lg font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition text-sm">
               Batal
            </a>
            <button type="submit"
                class="px-5 py-2.5 rounded-lg font-bold text-white bg-primary hover:bg-primary/90 transition text-sm flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Simpan Menu
            </button>
        </div>
    </form>
</div>

<script>
// Live preview upload gambar
document.getElementById('img-input-create').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('img-preview-create');
    const img = document.getElementById('img-preview-create-src');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        img.src = "";
    }
});
</script>
@endsection
