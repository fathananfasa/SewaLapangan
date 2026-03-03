    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Status Booking') }}
            </h2>
        </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <table class="w-full table-auto border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Lapangan</th>
                                <th class="px-4 py-2 border">Jam</th>
                                <th class="px-4 py-2 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 border text-center">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 border text-center">{{ $booking->lapangan }}</td>
                                <td class="px-4 py-2 border text-center">{{ \Carbon\Carbon::parse($booking->jam)->format('H:i')}}</td>
                                <td class="px-4 py-2 border text-center">{{ $booking->status }}</td>
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
    </x-app-layout>
