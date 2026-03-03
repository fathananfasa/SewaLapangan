<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto animate-fade-in-up">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl text-center shadow-lg p-6 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('images/basket.jpg') }}" alt="Gambar Lapangan 1">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Lapangan 1</h2>
                <p class="text-gray-600">Lapangan serbaguna yang dirancang dengan standar yang sesuai untuk mendukung kegiatan olahraga futsal maupun basket.</p>
                <a href="{{ route('create-booking') }}">
                    <button class="bg-red-600 transition-all duration-500 ease-in-out hover:bg-red-700 hover:scale-105 hover:opacity-90 text-white font-bold py-2 px-4 rounded mt-5 block mx-auto">
                        Booking
                    </button>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl text-center shadow-lg p-6 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('images/basket.jpg') }}" alt="Gambar Lapangan 2">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Lapangan 2</h2>
                <p class="text-gray-600">lapangan serbaguna yang dirancang dengan standar yang sesuai untuk mendukung kegiatan olahraga futsal maupun basket.</p>
                <a href="{{ route('create-booking') }}">
                    <button class="bg-red-600 transition-all duration-500 ease-in-out hover:bg-red-700 hover:scale-105 hover:opacity-90 text-white font-bold py-2 px-4 rounded mt-5 block mx-auto">
                        Booking
                    </button>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl text-center shadow-lg p-6 transform hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('images/basket.jpg') }}" alt="Gambar Lapangan 3">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Lapangan 3</h2>
                <p class="text-gray-600">lapangan serbaguna yang dirancang dengan standar yang sesuai untuk mendukung kegiatan olahraga futsal maupun basket.</p>
                <a href="{{ route('create-booking') }}">
                    <button class="bg-red-600 transition-all duration-500 ease-in-out hover:bg-red-700 hover:scale-105 hover:opacity-90 text-white font-bold py-2 px-4 rounded mt-5 block mx-auto">
                        Booking
                    </button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>