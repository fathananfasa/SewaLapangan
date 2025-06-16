<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md space-y-6">
                <!-- Form untuk booking -->
                <form id="bookingForm" action="{{ route('store-booking') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" readonly
                            class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>


                    <div class="form-group mb-5">
                        <label for="lapangan" class="block text-sm font-medium text-gray-700 mb-1">Pilih Lapangan</label>
                        <select name="lapangan" id="lapangan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="1" {{ request('lapangan') == '1' ? 'selected' : '' }}>Lapangan 1</option>
                            <option value="2" {{ request('lapangan') == '2' ? 'selected' : '' }}>Lapangan 2</option>
                            <option value="3" {{ request('lapangan') == '3' ? 'selected' : '' }}>Lapangan 3</option>
                        </select>
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" required min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>

                    <div class="form-group mb-5">
                        <label for="jam" class="block text-sm font-medium text-gray-700 mb-1">Jam</label>
                        <select name="jam" id="jam" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                            @for ($hour = 7; $hour <= 21; $hour++)
                                <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                                </option>
                                @endfor
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label for="krs" class="block text-sm font-medium text-gray-700 mb-2">Unggah KRS</label>
                        <input type="file" id="krs" name="krs" required
                            class="w-full text-gray-700 bg-white border border-gray-300 rounded-md px-4 py-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700">
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow-sm transition duration-200">
                            Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>