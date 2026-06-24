@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')
<div class="max-w-7xl mx-auto">
    @if (session('status'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-800">{{ session('status') }}</p>
        </div>
    @endif

    <div class="mb-6 p-4 sm:p-8 bg-white dark:bg-slate-800 shadow sm:rounded-lg">
        <form method="GET" action="{{ route('users.index') }}" class="flex gap-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama atau email..." 
                value="{{ request('search') }}"
                class="flex-1 px-4 py-2 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
            >
                Cari
            </button>
            @if (request('search'))
                <a 
                    href="{{ route('users.index') }}"
                    class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition"
                >
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 shadow sm:rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 dark:bg-slate-700 border-b border-gray-300 dark:border-slate-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Peran</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800 dark:text-gray-200">Bergabung Sejak</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-800 dark:text-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if ($user->role === 'admin')
                                        bg-red-100 text-red-800
                                    @elseif ($user->role === 'kepala_desa')
                                        bg-blue-100 text-blue-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm space-x-2 whitespace-nowrap">
                                <a 
                                    href="{{ route('users.show', $user) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                                >
                                    Lihat
                                </a>
                                
                                <a 
                                    href="{{ route('users.editRole', $user) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-slate-700 transition"
                                >
                                    Ubah Peran
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada pengguna ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection