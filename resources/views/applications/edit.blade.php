@extends('layouts.app')

@section('title', 'Edit Lamaran')
@section('page-title', 'Edit Lamaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('applications.index') }}" 
           class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Kembali ke Daftar Lamaran</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-600 px-6 sm:px-8 py-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">Edit Lamaran</h1>
                    <p class="text-purple-100 text-sm mt-1">Update informasi lamaran kerja Anda</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form method="POST" action="{{ route('applications.update', $application) }}" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Company Name -->
            <div class="space-y-2">
                <label for="company_name" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Nama Perusahaan</span>
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="company_name"
                       name="company_name" 
                       value="{{ old('company_name', $application->company_name) }}"
                       placeholder="Contoh: PT. Teknologi Indonesia"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all outline-none text-gray-900 placeholder-gray-400 @error('company_name') border-red-500 @enderror"
                       required>
                @error('company_name')
                    <p class="flex items-center gap-1 text-sm text-red-600 font-medium mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Position -->
            <div class="space-y-2">
                <label for="position" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Posisi yang Dilamar</span>
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="position"
                       name="position" 
                       value="{{ old('position', $application->position) }}"
                       placeholder="Contoh: Backend Developer"
                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all outline-none text-gray-900 placeholder-gray-400 @error('position') border-red-500 @enderror"
                       required>
                @error('position')
                    <p class="flex items-center gap-1 text-sm text-red-600 font-medium mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Salary Estimation -->
            <div class="space-y-2">
                <label for="salary_estimation" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Estimasi Gaji</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                    <input type="text" 
                           id="salary_estimation"
                           name="salary_estimation" 
                           value="{{ old('salary_estimation', $application->salary_estimation) }}"
                           placeholder="5.000.000 - 8.000.000"
                           class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-300 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all outline-none text-gray-900 placeholder-gray-400 @error('salary_estimation') border-red-500 @enderror">
                </div>
                <p class="text-xs text-gray-500 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Opsional - Isi jika sudah mengetahui range gaji
                </p>
                @error('salary_estimation')
                    <p class="flex items-center gap-1 text-sm text-red-600 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label for="status" class="flex items-center gap-2 text-sm font-bold text-gray-700">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Status Lamaran</span>
                    <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach(['daftar' => ['color' => 'blue', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'], 
                              'interview' => ['color' => 'yellow', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'], 
                              'diterima' => ['color' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'], 
                              'ditolak' => ['color' => 'red', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z']] as $status => $config)
                        <label class="relative cursor-pointer group">
                            <input type="radio" 
                                   name="status" 
                                   value="{{ $status }}" 
                                   class="peer sr-only" 
                                   {{ old('status', $application->status) === $status ? 'checked' : '' }}>
                            <div class="flex flex-col items-center gap-2 p-4 rounded-xl border-2 border-gray-300 bg-white transition-all peer-checked:border-{{ $config['color'] }}-500 peer-checked:bg-{{ $config['color'] }}-50 peer-checked:shadow-lg peer-checked:shadow-{{ $config['color'] }}-500/30 hover:border-{{ $config['color'] }}-300 hover:bg-{{ $config['color'] }}-50/50">
                                <svg class="w-6 h-6 text-{{ $config['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                </svg>
                                <span class="text-xs font-bold text-gray-700">{{ ucfirst($status) }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('status')
                    <p class="flex items-center gap-1 text-sm text-red-600 font-medium mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 pt-6">
                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3">
                    <a href="{{ route('applications.index') }}" 
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Batal</span>
                    </a>
                    <button type="submit" 
                            class="group inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-purple-700 shadow-lg shadow-indigo-500/50 hover:shadow-xl hover:shadow-indigo-500/60 transition-all transform hover:scale-105">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span>Update Lamaran</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
        <div class="flex gap-4">
            <div class="flex-shrink-0">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-2">ℹ️ Informasi Update</h3>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li class="flex items-start gap-2">
                        <span class="text-purple-600 font-bold">•</span>
                        <span>Perubahan akan tersimpan setelah klik tombol "Update Lamaran"</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-purple-600 font-bold">•</span>
                        <span>Status dapat diubah kapan saja sesuai progress lamaran</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-purple-600 font-bold">•</span>
                        <span>Data terakhir diubah: {{ $application->updated_at->diffForHumans() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection