<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <!-- Total -->
                <div class="bg-white p-4 rounded-xl shadow">
                    <p class="text-sm text-gray-500">Total Lamaran</p>
                    <p class="text-2xl font-bold">{{ $total }}</p>
                </div>

                <!-- Daftar -->
                <div class="bg-blue-50 p-4 rounded-xl">
                    <p class="text-sm text-blue-600">Daftar</p>
                    <p class="text-2xl font-bold text-blue-700">{{ $daftar }}</p>
                </div>

                <!-- Interview -->
                <div class="bg-yellow-50 p-4 rounded-xl">
                    <p class="text-sm text-yellow-600">Interview</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $interview }}</p>
                </div>

                <!-- Diterima -->
                <div class="bg-green-50 p-4 rounded-xl">
                    <p class="text-sm text-green-600">Diterima</p>
                    <p class="text-2xl font-bold text-green-700">{{ $diterima }}</p>
                </div>

                <!-- Ditolak -->
                <div class="bg-red-50 p-4 rounded-xl">
                    <p class="text-sm text-red-600">Ditolak</p>
                    <p class="text-2xl font-bold text-red-700">{{ $ditolak }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
