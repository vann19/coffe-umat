<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard | Coffe Umat</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#cf6317",
                        "background-light": "#f8f7f6",
                        "background-dark": "#211811",
                        "coffee-900": "#1b130e",
                        "coffee-700": "#4a3728",
                        "coffee-200": "#e7d9d0",
                        "coffee-50": "#f3ece7",
                    },
                    fontFamily: { "display": ["Be Vietnam Pro", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body { font-family: "Be Vietnam Pro", sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(16px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes pop { 0%,100% { transform: scale(1); } 50% { transform: scale(1.2); } }
        .cart-item-enter { animation: slideIn 0.25s ease; }
        .pop { animation: pop 0.2s ease; }
        @keyframes shake { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-4px)} 75%{transform:translateX(4px)} }
        .shake { animation: shake 0.3s ease; }
    </style>
</head>
<body class="bg-background-light text-slate-900">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">

    <!-- Header -->
    <header class="flex items-center justify-between border-b border-primary/10 px-4 py-3 lg:px-20 bg-background-light sticky top-0 z-50">
        <div class="flex items-center gap-6">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-primary">
                <i data-lucide="coffee" class="w-6 h-6"></i>
                <h2 class="text-slate-900 text-lg font-black leading-tight tracking-tight">Coffe Umat</h2>
            </a>
            <div class="hidden md:flex items-center gap-5">
                <a class="text-slate-600 text-sm font-medium hover:text-primary transition-colors" href="{{ url('/menu') }}">Menu</a>
                <a class="text-slate-600 text-sm font-medium hover:text-primary transition-colors" href="{{ url('/lokasi') }}">Lokasi</a>
                <a class="text-slate-600 text-sm font-medium hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang</a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center bg-primary/5 rounded-lg px-3 py-1.5 border border-primary/10">
                <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                <input class="bg-transparent border-none focus:ring-0 text-sm w-28 lg:w-40 placeholder:text-slate-400 ml-2" placeholder="Cari menu..." type="text"/>
            </div>
            <!-- User Dropdown -->
            <div class="relative group">
                <button class="flex items-center gap-2 rounded-lg px-3 py-2 bg-primary/10 text-primary hover:bg-primary/20 transition-colors">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span class="text-sm font-semibold hidden sm:inline">{{ Auth::user()->name }}</span>
                    <i data-lucide="chevron-down" class="w-3 h-3"></i>
                </button>
                <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-primary/10 py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-primary/5 hover:text-primary transition-colors">
                        <i data-lucide="settings" class="w-4 h-4"></i> Profil Saya
                    </a>
                    <div class="border-t border-primary/10 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
            <!-- Cart Badge Button -->
            <button onclick="toggleCartSidebar()" class="flex items-center justify-center rounded-lg p-2 bg-primary text-white hover:opacity-90 transition-opacity relative">
                <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                <span id="cart-badge" class="absolute -top-1 -right-1 bg-coffee-900 text-white text-[10px] font-bold px-1.5 rounded-full border-2 border-background-light hidden">0</span>
            </button>
        </div>
    </header>

    <main class="flex flex-1 flex-col lg:flex-row">

        <!-- Main Content -->
        <div class="flex-1 px-4 py-6 lg:px-20 lg:py-8">

            <!-- Welcome Banner -->
            <div class="mb-6 p-5 rounded-xl bg-gradient-to-r from-coffee-900 to-coffee-700 text-white flex items-center justify-between">
                <div>
                    <p class="text-primary font-bold text-sm mb-1">☕ Selamat datang kembali,</p>
                    <h2 class="text-xl font-black">{{ Auth::user()->name }}!</h2>
                    <p class="text-slate-300 text-sm mt-1">Mau kopi apa hari ini?</p>
                </div>
                <div class="text-right">
                    <p class="text-slate-400 text-xs">Poin Rewards</p>
                    <p class="text-2xl font-black text-primary">{{ number_format($loyaltyPoints) }} <span class="text-sm font-medium text-slate-300">pts</span></p>
                    <p class="text-[10px] text-slate-400 mt-0.5">= Rp {{ number_format($loyaltyPoints * 1000, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-1.5 text-xs text-slate-400 mb-5">
                <a class="hover:text-primary" href="{{ url('/') }}">Beranda</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-900 font-medium">Pesan Online</span>
            </nav>

            <div class="mb-7">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-2">Pilih untukmu 🎯</h1>
                <p class="text-slate-500 max-w-xl text-sm">Dari biji kopi pilihan hingga pastri segar, pilih favoritmu dan siap dalam hitungan menit.</p>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-primary/10 mb-7 overflow-x-auto no-scrollbar" id="tab-list">
                <button onclick="filterByCategory('kopi')" data-cat="kopi" class="tab-btn px-5 py-3 text-sm font-bold border-b-2 border-primary text-primary whitespace-nowrap">☕ Kopi</button>
                <button onclick="filterByCategory('teh')" data-cat="teh" class="tab-btn px-5 py-3 text-sm font-bold text-slate-500 hover:text-primary whitespace-nowrap border-b-2 border-transparent">🍵 Teh & Minuman</button>
                <button onclick="filterByCategory('pastri')" data-cat="pastri" class="tab-btn px-5 py-3 text-sm font-bold text-slate-500 hover:text-primary whitespace-nowrap border-b-2 border-transparent">🥐 Pastri Segar</button>
                <button onclick="filterByCategory('sarapan')" data-cat="sarapan" class="tab-btn px-5 py-3 text-sm font-bold text-slate-500 hover:text-primary whitespace-nowrap border-b-2 border-transparent">🍳 Sarapan</button>
            </div>

            <!-- Grid Menu -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" id="menu-grid">
                <!-- Diisi oleh JavaScript -->
            </div>

            {{-- ═══════════════════════════════════════════════════════ --}}
            {{-- Section: Riwayat Pesanan & Poin                        --}}
            {{-- ═══════════════════════════════════════════════════════ --}}
            <div class="mt-10" id="riwayat-section">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">Riwayat Pesanan Saya 📋</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Total poin terkumpul: <span class="font-bold text-primary">{{ number_format($loyaltyPoints) }} pts</span></p>
                    </div>
                    {{-- Poin card mini --}}
                    <div class="hidden sm:flex items-center gap-3 bg-gradient-to-br from-primary to-amber-600 text-white px-4 py-2.5 rounded-xl shadow-lg shadow-primary/30">
                        <div class="text-2xl">⭐</div>
                        <div>
                            <p class="font-black text-lg leading-none">{{ number_format($loyaltyPoints) }}</p>
                            <p class="text-[10px] text-white/80 uppercase tracking-wider">Poin Rewards</p>
                        </div>
                    </div>
                </div>

                @if($orders->isEmpty())
                {{-- Empty state --}}
                <div class="flex flex-col items-center justify-center py-14 bg-white rounded-2xl border border-coffee-200 text-center">
                    <div class="text-5xl mb-3">🛒</div>
                    <p class="font-black text-slate-700 text-base">Belum ada pesanan</p>
                    <p class="text-slate-400 text-sm mt-1">Pesan sekarang dan kumpulkan poin rewards!</p>
                </div>

                @else
                <div class="space-y-3">
                    @foreach($orders as $order)
                    @php
                        $earnedPts = max(1, (int) floor($order->total_price / 1000));
                        $statusMap = [
                            'paid'     => ['✅ Lunas',               'bg-green-100 text-green-700'],
                            'pending'  => ['⏳ Menunggu Pembayaran', 'bg-amber-100 text-amber-700'],
                            'canceled' => ['❌ Dibatalkan',          'bg-red-100 text-red-600'],
                            'failed'   => ['⚠️ Gagal',               'bg-slate-100 text-slate-600'],
                        ];
                        [$statusLabel, $statusCls] = $statusMap[$order->status] ?? [ucfirst($order->status), 'bg-slate-100 text-slate-600'];
                        $typeLabel = $order->order_type === 'dine-in' ? '🪑 Dine-in' : '📦 Takeaway';
                        $payLabel  = match($order->payment_method) {
                            'qris'     => '☑️ QRIS',
                            'transfer' => '🏦 Transfer',
                            'cash'     => '💵 Cash',
                            default    => '💳 Midtrans',
                        };
                    @endphp
                    <div class="bg-white rounded-2xl border border-coffee-200 p-4 hover:shadow-md transition-shadow">
                        {{-- Header row --}}
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="font-black text-sm text-coffee-900 uppercase tracking-wider">
                                        #{{ strtoupper(substr($order->id, 0, 8)) }}
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $statusCls }}">{{ $statusLabel }}</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ $order->created_at?->format('d M Y, H:i') ?? '-' }} WIB
                                    · {{ $typeLabel }}
                                    · {{ $payLabel }}
                                </p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-black text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                @if($order->status === 'paid')
                                <p class="text-[11px] text-green-600 font-bold">+{{ $earnedPts }} pts ⭐</p>
                                @else
                                <p class="text-[11px] text-slate-400">+{{ $earnedPts }} pts (pending)</p>
                                @endif
                            </div>
                        </div>
                        {{-- Items list --}}
                        @if($order->items->isNotEmpty())
                        <div class="flex flex-wrap gap-1.5 pt-3 border-t border-coffee-100">
                            @foreach($order->items->take(4) as $item)
                            <span class="px-2.5 py-1 rounded-full bg-coffee-50 text-coffee-900 text-xs font-semibold border border-coffee-100">
                                {{ $item->quantity }}× {{ $item->item_name ?? 'Menu' }}
                            </span>
                            @endforeach
                            @if($order->items->count() > 4)
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 text-xs">+{{ $order->items->count() - 4 }} lainnya</span>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            {{-- ═══════════════════════════════════════════════════════ --}}

        </div>{{-- end flex-1 main content --}}

        <!-- Sidebar: Cart (Desktop always visible, mobile toggle) -->
        <aside id="cart-sidebar" class="hidden lg:flex w-full lg:w-[380px] border-t lg:border-t-0 lg:border-l border-primary/10 bg-white p-5 lg:p-6 flex-col lg:min-h-screen">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-lg font-black text-slate-900">Keranjang Saya</h2>
                    <p class="text-xs text-slate-400">Periksa pesananmu</p>
                </div>
                <span id="cart-count-label" class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">0 Item</span>
            </div>

            <!-- Cart Items -->
            <div id="cart-items" class="flex-1 overflow-y-auto space-y-3 mb-6 min-h-[120px]">
                <!-- Empty State -->
                <div id="cart-empty" class="flex flex-col items-center justify-center h-32 text-slate-300">
                    <i data-lucide="shopping-cart" class="w-10 h-10 mb-2"></i>
                    <p class="text-sm font-medium">Keranjang masih kosong</p>
                    <p class="text-xs mt-1">Tambahkan menu favoritmu!</p>
                </div>
            </div>

            <!-- Summary -->
            <div id="cart-summary" class="space-y-3 pt-5 border-t border-primary/10">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Subtotal</span>
                    <span class="font-medium" id="subtotal-val">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Pajak (8%)</span>
                    <span class="font-medium" id="tax-val">Rp 0</span>
                </div>
                <div class="flex justify-between text-base font-black pt-2 border-t border-primary/10">
                    <span>Total</span>
                    <span class="text-primary" id="total-val">Rp 0</span>
                </div>
                <div class="flex gap-2 pt-1">
                    <input class="flex-1 bg-primary/5 border border-primary/10 rounded-lg text-sm px-3 py-2 focus:ring-primary focus:border-primary outline-none placeholder:text-slate-400" placeholder="Kode promo" type="text"/>
                    <button class="px-4 py-2 text-sm font-bold bg-coffee-900 text-white rounded-lg hover:bg-coffee-700 transition-colors">Pakai</button>
                </div>
                <button id="checkout-btn"
                    onclick="goToCheckout()"
                    class="w-full py-3.5 bg-primary text-white text-sm font-bold rounded-xl hover:opacity-90 shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2.5 mt-2 disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                    Lanjut ke Pembayaran
                </button>
                <p class="text-center text-[10px] text-slate-400 uppercase tracking-widest">🔒 Pembayaran Aman & Terjamin</p>
            </div>
        </aside>
    </main>
</div>

<!-- Mobile Cart Drawer (overlay) -->
<div id="mobile-cart-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleCartSidebar()"></div>
<div id="mobile-cart-drawer" class="fixed bottom-0 left-0 right-0 bg-white z-50 rounded-t-2xl shadow-2xl p-5 max-h-[80vh] overflow-y-auto translate-y-full transition-transform duration-300 lg:hidden">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-black">Keranjang Saya</h2>
        <button onclick="toggleCartSidebar()" class="p-1 rounded-lg hover:bg-slate-100"><i data-lucide="x" class="w-5 h-5"></i></button>
    </div>
    <div id="mobile-cart-items" class="space-y-3 mb-5"></div>
    <div class="space-y-2 pt-4 border-t border-primary/10">
        <div class="flex justify-between text-sm"><span class="text-slate-500">Subtotal</span><span id="m-subtotal" class="font-medium">Rp 0</span></div>
        <div class="flex justify-between text-sm"><span class="text-slate-500">Pajak (8%)</span><span id="m-tax" class="font-medium">Rp 0</span></div>
        <div class="flex justify-between font-black pt-2 border-t border-primary/10"><span>Total</span><span id="m-total" class="text-primary">Rp 0</span></div>
        <button onclick="goToCheckout()" class="w-full py-3 bg-primary text-white font-bold rounded-xl mt-2 flex items-center justify-center gap-2">
            <i data-lucide="credit-card" class="w-4 h-4"></i> Lanjut ke Pembayaran
        </button>
    </div>
</div>

<script>
// ============================================================
// DATA MENU
// ============================================================
const menuItems = @json($menuItems);

// ============================================================
// CART STATE
// ============================================================
let cart = []; // { id, name, price, img, qty }

function formatRp(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

// ============================================================
// RENDER MENU CARDS
// ============================================================
let activeCategory = 'kopi';

function filterByCategory(cat) {
    activeCategory = cat;
    // Update tab styles
    document.querySelectorAll('.tab-btn').forEach(btn => {
        const isActive = btn.dataset.cat === cat;
        btn.classList.toggle('border-primary', isActive);
        btn.classList.toggle('text-primary', isActive);
        btn.classList.toggle('border-transparent', !isActive);
        btn.classList.toggle('text-slate-500', !isActive);
    });
    renderMenu();
}

function renderMenu() {
    const grid = document.getElementById('menu-grid');
    const filtered = menuItems.filter(item => item.cat === activeCategory);
    grid.innerHTML = filtered.map(item => `
        <div class="group flex flex-col bg-white rounded-xl overflow-hidden border border-primary/5 hover:shadow-xl transition-all">
            <div class="h-44 bg-cover bg-center" style="background-image: url('${item.img}')"></div>
            <div class="p-4 flex flex-col flex-1">
                <div class="flex justify-between items-start mb-1.5 gap-2">
                    <h3 class="font-bold text-base leading-tight">${item.name}</h3>
                    <span class="text-primary font-black text-sm whitespace-nowrap">${formatRp(item.price)}</span>
                </div>
                <p class="text-xs text-slate-500 mb-4 line-clamp-2 leading-relaxed">${item.desc}</p>
                <div id="btn-container-${item.id}" class="mt-auto">
                    ${renderAddButton(item.id)}
                </div>
            </div>
        </div>
    `).join('');
    lucide.createIcons();
}

function renderAddButton(itemId) {
    const inCart = cart.find(c => c.id === itemId);
    if (inCart) {
        return `
            <div class="flex items-center justify-between bg-primary/10 rounded-lg px-3 py-2">
                <button onclick="changeQty(${itemId}, -1)" class="text-primary hover:text-primary/70 transition-colors p-1">
                    <i data-lucide="minus" class="w-4 h-4"></i>
                </button>
                <span class="font-black text-primary text-sm" id="menu-qty-${itemId}">${inCart.qty}x ditambahkan</span>
                <button onclick="changeQty(${itemId}, 1)" class="text-primary hover:text-primary/70 transition-colors p-1">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                </button>
            </div>`;
    } else {
        return `
            <button onclick="addToCart(${itemId})" class="w-full py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2 text-sm">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah ke Pesanan
            </button>`;
    }
}

// ============================================================
// CART LOGIC
// ============================================================
function addToCart(itemId) {
    const item = menuItems.find(m => m.id === itemId);
    const existing = cart.find(c => c.id === itemId);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ ...item, qty: 1 });
    }
    updateButtonState(itemId);
    renderCart();
    animateBadge();
}

function changeQty(itemId, delta) {
    const idx = cart.findIndex(c => c.id === itemId);
    if (idx === -1) return;
    cart[idx].qty += delta;
    if (cart[idx].qty <= 0) {
        cart.splice(idx, 1);
    }
    updateButtonState(itemId);
    renderCart();
    animateBadge();
}

function removeFromCart(itemId) {
    cart = cart.filter(c => c.id !== itemId);
    updateButtonState(itemId);
    renderCart();
    animateBadge();
}

function updateButtonState(itemId) {
    const container = document.getElementById(`btn-container-${itemId}`);
    if (container) {
        container.innerHTML = renderAddButton(itemId);
        lucide.createIcons();
    }
}

// ============================================================
// RENDER CART SIDEBAR
// ============================================================
function renderCart() {
    renderCartSidebar('cart-items', 'cart-empty');
    renderCartSidebar('mobile-cart-items', null, true);
    updateTotals();
    updateCountLabel();
    const btn = document.getElementById('checkout-btn');
    if (btn) btn.disabled = cart.length === 0;
}

function cartItemHTML(item, isMobile = false) {
    return `
        <div class="cart-item-enter flex gap-3 p-3 rounded-xl bg-primary/5 border border-primary/5" id="${isMobile ? 'm-' : ''}ci-${item.id}">
            <div class="w-14 h-14 rounded-lg bg-cover bg-center flex-shrink-0" style="background-image: url('${item.img}')"></div>
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-1">
                    <p class="font-bold text-sm truncate">${item.name}</p>
                    <button onclick="removeFromCart(${item.id})" class="text-slate-300 hover:text-red-500 transition-colors flex-shrink-0">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
                <p class="text-xs text-slate-400 mb-2 mt-0.5">${formatRp(item.price)} / item</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2 bg-white rounded-lg px-2 py-1 border border-primary/10">
                        <button onclick="changeQty(${item.id}, -1)" class="text-primary hover:text-primary/70"><i data-lucide="minus" class="w-3 h-3"></i></button>
                        <span class="text-xs font-black w-4 text-center">${item.qty}</span>
                        <button onclick="changeQty(${item.id}, 1)" class="text-primary hover:text-primary/70"><i data-lucide="plus" class="w-3 h-3"></i></button>
                    </div>
                    <span class="font-black text-primary text-sm">${formatRp(item.price * item.qty)}</span>
                </div>
            </div>
        </div>`;
}

function renderCartSidebar(containerId, emptyId, isMobile = false) {
    const container = document.getElementById(containerId);
    if (!container) return;
    if (cart.length === 0) {
        container.innerHTML = emptyId ? `
            <div id="${emptyId}" class="flex flex-col items-center justify-center h-32 text-slate-300">
                <i data-lucide="shopping-cart" class="w-10 h-10 mb-2"></i>
                <p class="text-sm font-medium">Keranjang masih kosong</p>
                <p class="text-xs mt-1">Tambahkan menu favoritmu!</p>
            </div>` : '<p class="text-sm text-slate-400 text-center py-4">Keranjang kosong</p>';
    } else {
        container.innerHTML = cart.map(item => cartItemHTML(item, isMobile)).join('');
    }
    lucide.createIcons();
}

function updateTotals() {
    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const tax = Math.round(subtotal * 0.08);
    const total = subtotal + tax;
    ['subtotal-val', 'm-subtotal'].forEach(id => { const el = document.getElementById(id); if(el) el.textContent = formatRp(subtotal); });
    ['tax-val', 'm-tax'].forEach(id => { const el = document.getElementById(id); if(el) el.textContent = formatRp(tax); });
    ['total-val', 'm-total'].forEach(id => { const el = document.getElementById(id); if(el) el.textContent = formatRp(total); });
}

function updateCountLabel() {
    const totalQty = cart.reduce((s, i) => s + i.qty, 0);
    const badge = document.getElementById('cart-badge');
    const label = document.getElementById('cart-count-label');
    if (badge) { badge.textContent = totalQty; badge.classList.toggle('hidden', totalQty === 0); }
    if (label) label.textContent = totalQty + ' Item';
}

function animateBadge() {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    badge.classList.remove('pop');
    void badge.offsetWidth; // reflow
    badge.classList.add('pop');
    setTimeout(() => badge.classList.remove('pop'), 200);
}

// ============================================================
// MOBILE CART TOGGLE
// ============================================================
function toggleCartSidebar() {
    const overlay = document.getElementById('mobile-cart-overlay');
    const drawer = document.getElementById('mobile-cart-drawer');
    const isOpen = !overlay.classList.contains('hidden');
    if (isOpen) {
        overlay.classList.add('hidden');
        drawer.style.transform = 'translateY(100%)';
    } else {
        renderCartSidebar('mobile-cart-items', null, true);
        overlay.classList.remove('hidden');
        drawer.style.transform = 'translateY(0)';
        lucide.createIcons();
    }
}

// Desktop sidebar always visible
document.getElementById('cart-sidebar').classList.remove('hidden');
document.getElementById('cart-sidebar').classList.add('flex');

// ============================================================
// INIT
// ============================================================
renderMenu();
renderCart();
lucide.createIcons();

// ============================================================
// CHECKOUT — POST cart ke server lalu redirect
// ============================================================
async function goToCheckout() {
    if (cart.length === 0) return;

    const btn = document.getElementById('checkout-btn');
    if (btn) { btn.disabled = true; btn.textContent = 'Memproses...'; }

    try {
        const cartPayload = cart.map(i => ({
            id:    i.id,
            name:  i.name,
            price: i.price,
            qty:   i.qty,
            img:   i.img || '',
        }));

        const res = await fetch('{{ route('checkout.prepare') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ cart: JSON.stringify(cartPayload) }),
        });

        const data = await res.json();
        if (data.redirect) {
            window.location.href = data.redirect;
        } else {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            if (btn) { btn.disabled = false; btn.innerHTML = '<i data-lucide="credit-card" class="w-4 h-4"></i> Lanjut ke Pembayaran'; lucide.createIcons(); }
        }
    } catch (err) {
        console.error(err);
        alert('Gagal terhubung ke server. Periksa koneksi internet Anda.');
        if (btn) { btn.disabled = false; btn.innerHTML = '<i data-lucide="credit-card" class="w-4 h-4"></i> Lanjut ke Pembayaran'; lucide.createIcons(); }
    }
}
</script>
</body>
</html>
http://127.0.0.1:8000/admin/menu/create