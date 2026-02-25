<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Aspirasi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Input Aspirasi -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Kirim Aspirasi Baru</h2>
                    <p class="mt-1 text-sm text-gray-600">Laporkan masalah sarana dan prasarana di lingkungan sekolah.
                    </p>
                </header>

                <form method="post" action="{{ route('aspirasi.store') }}" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <x-input-label for="category_id" value="Kategori Sarana" />
                        <select id="category_id" name="category_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="location" value="Lokasi Spesifik" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                            placeholder="Contoh: Lab Komputer 1, Kantin Atas" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Detail Pengaduan" />
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Jelaskan detail kerusakan atau keluhan Anda..." required></textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Kirim Laporan</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Tabel Riwayat Aspirasi -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Riwayat Aspirasi Saya</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Lokasi</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Tanggapan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $row)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $row->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $row->category->category_name }}
                                    </td>
                                    <td class="px-6 py-4">{{ $row->location }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 rounded text-xs font-bold
                                        {{ $row->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $row->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $row->status == 'done' ? 'bg-green-100 text-green-800' : '' }}">
                                            {{ strtoupper($row->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 italic">
                                        {{ $row->feedback->content ?? 'Belum ada tanggapan' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada laporan yang Anda kirim.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
