<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Kontrol Admin - Semua Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Form Filter & Pencarian -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
                    <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Cari
                                Pelapor/Lokasi</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Ketik nama..." class="w-full text-sm rounded border-gray-300">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kategori</label>
                            <select name="category_id" class="w-full text-sm rounded border-gray-300">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Status</label>
                            <select name="status" class="w-full text-sm rounded border-gray-300">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit"
                                class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-black transition w-full">
                                Filter Data
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Aspirasi -->
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-50 uppercase text-xs font-bold">
                        <tr>
                            <th class="p-4 border-b">Pelapor</th>
                            <th class="p-4 border-b">Kategori & Lokasi</th>
                            <th class="p-4 border-b">Aspirasi</th>
                            <th class="p-4 border-b">Tindakan Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aspirasis as $row)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    <div class="font-bold text-gray-900">{{ $row->user->name }}</div>
                                    <div class="text-xs text-gray-500">NIS: {{ $row->user->username }}</div>
                                    <div class="text-xs text-gray-400">{{ $row->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="block font-medium text-blue-600">{{ $row->category->category_name }}</span>
                                    <span class="text-gray-600 italic text-xs">{{ $row->location }}</span>
                                </td>
                                <td class="p-4 text-gray-700">
                                    {{ $row->description }}
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('aspirasi.update', $row->id) }}" method="POST"
                                        class="space-y-2">
                                        @csrf
                                        <select name="status" class="w-full text-xs rounded border-gray-300">
                                            <option value="pending" {{ $row->status == 'pending' ? 'selected' : '' }}>
                                                PENDING</option>
                                            <option value="processing"
                                                {{ $row->status == 'processing' ? 'selected' : '' }}>PROCESSING
                                            </option>
                                            <option value="done" {{ $row->status == 'done' ? 'selected' : '' }}>DONE
                                            </option>
                                        </select>

                                        <textarea name="feedback" rows="2" class="w-full text-xs rounded border-gray-300" placeholder="Tulis tanggapan..."
                                            required>{{ $row->feedback->content ?? '' }}</textarea>

                                        <button type="submit"
                                            class="w-full bg-indigo-600 text-white text-xs py-2 rounded hover:bg-indigo-700 transition">
                                            Simpan Perubahan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
