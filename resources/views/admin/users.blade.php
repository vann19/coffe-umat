@extends('admin.layout', ['pageTitle' => 'Manajemen User', 'pageSubtitle' => 'Kelola akun yang terdaftar dan role akses'])

@section('content')
<div class="bg-white rounded-xl border border-coffee-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-coffee-50 text-left">
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Tgl Daftar</th>
                    <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-coffee-100">
                @foreach($users as $u)
                <tr class="hover:bg-coffee-50 transition-colors">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-primary/10 text-primary flex items-center justify-center font-black text-xs">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-coffee-900">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 text-slate-500">{{ $u->email }}</td>
                    <td class="px-5 py-3">
                        @if($u->role === 'admin')
                        <span class="bg-primary/10 text-primary text-xs font-bold px-2 py-0.5 rounded-full">Admin</span>
                        @else
                        <span class="bg-slate-100 text-slate-500 text-xs font-medium px-2 py-0.5 rounded-full">User</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-slate-400 text-xs">{{ $u->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-right">
                        @if($u->id !== Auth::id())
                        <button class="text-xs text-primary font-bold hover:underline">Edit Role</button>
                        @else
                        <span class="text-xs text-slate-300 italic">Kamu</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-coffee-100">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
