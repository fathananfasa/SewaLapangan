<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">

                        {{-- Filter Form --}}
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4 flex items-center gap-4">
                            <div>
                                <label for="bulan" class="block text-sm font-medium">Bulan:</label>
                                <select name="bulan" id="bulan" class="border rounded px-2 py-1 w-32">
                                    <option value="">Semua</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                            <div>
                                <label for="tahun" class="block text-sm font-medium">Tahun:</label>
                                <select name="tahun" id="tahun" class="border rounded px-2 py-1 w-32">
                                    <option value="">Semua</option>
                                    @for ($year = now()->year; $year >= 2020; $year--)
                                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="pt-5">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">Filter</button>
                            </div>
                        </form>

                        {{-- Success Message --}}
                        @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                        @endif

                        {{-- Booking Table --}}
                        <table class="min-w-full bg-white border border-gray-200 text-sm text-left text-gray-700">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-6 py-3 font-medium text-gray-900">Nama</th>
                                    <th class="px-6 py-3 font-medium text-gray-900">KRS</th>
                                    <th class="px-6 py-3 font-medium text-gray-900">Tanggal</th>
                                    <th class="px-6 py-3 font-medium text-gray-900">Jam</th>
                                    <th class="px-6 py-3 font-medium text-gray-900">Status</th>
                                    <th class="px-6 py-3 font-medium text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($dtBooking as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $item->name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $item->krs) }}" target="_blank" class="text-blue-600 hover:underline">Lihat KRS</a>
                                    </td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4">{{ $item->jam }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $item->status }}</td>
                                    <td class="px-6 py-4">
                                        @if(strtolower($item->status) === 'menunggu')
                                        <form method="POST" action="{{ route('admin.konfirmasi', $item->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button name="status" value="diterima" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Terima</button>
                                            <button name="status" value="ditolak" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Tolak</button>
                                        </form>
                                        @else
                                        <span class="text-gray-500 italic">Sudah dikonfirmasi</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada booking</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>