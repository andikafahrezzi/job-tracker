@extends('layouts.app')

@section('title', 'Daftar Lamaran')
@section('page-title', 'Daftar Lamaran')

@section('content')
<div x-data="{ 
    view: '{{ request()->cookie('view_mode', 'grid') }}',
    init() {
        this.$watch('view', value => {
            document.cookie = `view_mode=${value}; path=/; max-age=31536000`;
        });
    }
}">
    <!-- Header Section with Stats -->
    <div class="mb-8">
        <!-- Title & Action -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-indigo-800 bg-clip-text text-transparent">
                    Kelola Lamaran Kerja
                </h1>
                <p class="text-sm text-gray-600 mt-1.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Total {{ $applications->total() }} lamaran terdaftar
                </p>
            </div>
            @if($reminders->count())
<div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5 mb-6">
    <h3 class="font-bold text-yellow-800 mb-3 flex items-center gap-2">
        ⏰ Interview Reminder
    </h3>

    <ul class="space-y-3">
        @foreach($reminders as $app)
            <li class="flex justify-between items-start bg-white p-4 rounded-lg shadow">
                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $app->company_name }} — {{ $app->position }}
                    </p>
                    <p class="text-sm text-gray-600">
                        📅 {{ $app->interview_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <a href="{{ route('applications.edit', $app) }}"
                   class="text-sm text-indigo-600 hover:underline">
                    Edit
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endif

            <a href="{{ route('applications.create') }}" 
               class="group inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-bold rounded-xl hover:from-blue-700 hover:to-indigo-700 shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-500/60 transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Lamaran</span>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            @php
                $totalCount = $applications->total();
                $allApplications = auth()->user()->applications;
                $daftarCount = $allApplications->where('status', 'daftar')->count();
                $interviewCount = $allApplications->where('status', 'interview')->count();
                $diterimaCount = $allApplications->where('status', 'diterima')->count();
                $ditolakCount = $allApplications->where('status', 'ditolak')->count();
            @endphp

            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Total</p>
                        <p class="text-xl font-bold text-gray-900">{{ $totalCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-yellow-100 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Interview</p>
                        <p class="text-xl font-bold text-gray-900">{{ $interviewCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-green-100 rounded-lg">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Diterima</p>
                        <p class="text-xl font-bold text-gray-900">{{ $diterimaCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Ditolak</p>
                        <p class="text-xl font-bold text-gray-900">{{ $ditolakCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & View Toggle -->
        <form method="GET" action="{{ route('applications.index') }}" class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-stretch sm:items-center justify-between bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <!-- Search -->
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input name="search" 
                       type="text" 
                       value="{{ request('search') }}"
                       placeholder="Cari perusahaan atau posisi..." 
                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            </div>

            <!-- Status Filter -->
            <select name="status" 
                    onchange="this.form.submit()"
                    class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm font-medium">
                <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="daftar" {{ request('status') == 'daftar' ? 'selected' : '' }}>Daftar</option>
                <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <!-- Search Button (Mobile) -->
            <button type="submit" class="sm:hidden px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                Cari
            </button>

            <!-- View Toggle -->
            <div class="hidden sm:flex bg-gray-100 rounded-lg p-1">
                <button type="button" @click="view = 'grid'" 
                        :class="view === 'grid' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                        class="px-3 py-2 rounded-md transition-all text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </button>
                <button type="button" @click="view = 'list'" 
                        :class="view === 'list' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                        class="px-3 py-2 rounded-md transition-all text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Clear Filter -->
            @if(request('search') || request('status') != 'all')
            <a href="{{ route('applications.index') }}" 
               class="hidden sm:inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Reset
            </a>
            @endif
        </form>
    </div>

<!-- Replace bagian Grid View dengan ini -->

<!-- Grid View -->
<div x-show="view === 'grid'" 
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
    @forelse($applications as $app)
    <div x-data="{ showNotes: false }" class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all duration-300 overflow-hidden transform hover:-translate-y-1">
        <!-- Card Normal View -->
        <div x-show="!showNotes" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 px-5 py-4 border-b border-gray-100">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-white rounded-xl shadow-sm">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-gray-900 truncate">{{ $app->company_name }}</h3>
                        </div>
                    </div>
                </div>
                <p class="text-sm font-semibold text-blue-600 truncate">{{ $app->position }}</p>
            </div>

            <!-- Card Body -->
            <div class="p-5 space-y-4">
                <!-- Salary -->
                <div class="flex items-center gap-2 text-sm">
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold text-gray-900">{{ $app->salary_estimation ?? 'Belum ditentukan' }}</span>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-2">
                    <label class="text-xs font-medium text-gray-600">Status:</label>
                    <select id="status-card-{{ $app->id }}" 
                            class="flex-1 text-xs font-semibold rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-1.5 px-2
                                   @if($app->status == 'daftar') text-blue-700 bg-blue-50
                                   @elseif($app->status == 'interview') text-yellow-700 bg-yellow-50
                                   @elseif($app->status == 'diterima') text-green-700 bg-green-50
                                   @elseif($app->status == 'ditolak') text-red-700 bg-red-50
                                   @endif"
                            onchange="updateStatus({{ $app->id }}, this.value, 'card')">
                        @foreach(['daftar','interview','diterima','ditolak'] as $s)
                            <option value="{{ $s }}" {{ $app->status == $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                    <span id="loading-card-{{ $app->id }}" class="hidden">
                        <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </div>

                <!-- Interview Date (if status = interview) -->
                @if($app->status === 'interview')
                <div class="flex items-start gap-2 text-sm pt-2 border-t border-gray-100">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    @if($app->interview_at)
                        <span class="font-semibold text-yellow-800">
                            {{ \Carbon\Carbon::parse($app->interview_at)->format('d M Y · H:i') }}
                        </span>
                    @else
                        <span class="text-red-600 font-semibold text-xs">
                            ⚠️ Jadwal interview belum diatur
                        </span>
                    @endif
                </div>
                @endif
            </div>

            <!-- Card Footer -->
            <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <button @click="showNotes = true"
                            type="button"
                            class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors group/btn"
                            title="Lihat Notes">
                        <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </button>
                    <a href="{{ route('applications.edit', $app) }}" 
                       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors group/btn" 
                       title="Edit">
                        <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form action="{{ route('applications.destroy', $app) }}" 
                          method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus lamaran ini?')"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors group/btn" 
                                title="Hapus">
                            <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <span class="text-xs text-gray-500">ID: #{{ $app->id }}</span>
            </div>
        </div>

        <!-- Card Notes View -->
        <div x-show="showNotes"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 rotate-3"
             x-transition:enter-end="opacity-100 scale-100 rotate-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 rotate-0"
             x-transition:leave-end="opacity-0 scale-95 -rotate-3"
             style="display: none;"
             class="h-full flex flex-col">
            <!-- Notes Header -->
            <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 px-5 py-4 border-b border-purple-400">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white/20 backdrop-blur-sm rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white">Catatan Lamaran</h3>
                            <p class="text-xs text-purple-100">{{ $app->company_name }}</p>
                        </div>
                    </div>
                    <button @click="showNotes = false"
                            class="p-2 hover:bg-white/20 rounded-lg transition-colors group/close">
                        <svg class="w-5 h-5 text-white group-hover/close:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Notes Content -->
            <div class="flex-1 p-5 bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 overflow-y-auto">
                <div class="bg-white rounded-xl p-4 shadow-sm border border-purple-200 min-h-[150px]">
                    @if ($app->notes->isNotEmpty())
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-700 whitespace-pre-line leading-relaxed">
                                {{ $app->notes->first()->content }}
                            </p>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-medium mb-2">Belum ada catatan</p>
                            <p class="text-sm text-gray-400">Tambahkan catatan di halaman edit</p>
                        </div>
                    @endif

                </div>
            </div>

            <!-- Notes Footer -->
            <div class="px-5 py-3 bg-white border-t border-gray-200 flex items-center justify-between">
                <button @click="showNotes = false"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Kembali</span>
                </button>
                <a href="{{ route('applications.edit', $app) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-bold rounded-lg hover:from-purple-700 hover:to-indigo-700 shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Edit Catatan</span>
                </a>
            </div>
        </div>
    </div>
    @empty
    <!-- Empty state sama seperti sebelumnya -->
    @endforelse
</div>

<!-- List View dengan Notes Modal -->
<div x-show="view === 'list'" 
     x-data="{
                notesModal: false,
                selectedNotes: '',
                selectedCompany: '',
                selectedAppId: null,
                hasNotes: false,

                showNotes(notes, company, appId) {
                    this.hasNotes = !!notes;
                    this.selectedNotes = notes || '';
                    this.selectedCompany = company;
                    this.selectedAppId = appId;
                    this.notesModal = true;
                }
            }"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden"
     style="display: none;">
    
    <!-- Notes Modal for List View -->
    <div x-show="notesModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="notesModal = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4"
         style="display: none;">
        <div x-show="notesModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             @click.stop
             class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 px-6 py-5 border-b border-purple-400">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-white/20 backdrop-blur-sm rounded-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Catatan Lamaran</h3>
                            <p class="text-sm text-purple-100" x-text="selectedCompany"></p>
                        </div>
                    </div>
                    <button @click="notesModal = false"
                            class="p-2 hover:bg-white/20 rounded-lg transition-colors group">
                        <svg class="w-6 h-6 text-white group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 max-h-[60vh] overflow-y-auto">
                <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-200 min-h-[200px]">
                    <template x-if="hasNotes">
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-700 whitespace-pre-line leading-relaxed"
                            x-text="selectedNotes">
                            </p>
                        </div>
                    </template>
                    <template x-if="!hasNotes">
                        <div class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 font-semibold text-lg mb-2">Belum ada catatan</p>
                            <p class="text-sm text-gray-400">
                                Tambahkan catatan di halaman edit untuk mencatat informasi penting
                            </p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-white border-t border-gray-200 flex items-center justify-between">
                <button @click="notesModal = false"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span>Tutup</span>
                </button>
                <a :href="`{{ url('applications') }}/${selectedAppId}/edit`"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm font-bold rounded-lg hover:from-purple-700 hover:to-indigo-700 shadow-lg shadow-purple-500/50 transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Edit Catatan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-blue-50 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Perusahaan
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Posisi
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">
                        Estimasi Gaji
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">
                        Interview
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($applications as $app)
                <tr class="hover:bg-blue-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 p-2 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-900">{{ $app->company_name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-semibold text-blue-600">{{ $app->position }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                        <span class="text-sm font-medium text-gray-900">{{ $app->salary_estimation ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <select id="status-{{ $app->id }}" 
                                    class="text-xs font-semibold rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-1.5 px-2
                                           @if($app->status == 'daftar') text-blue-700 bg-blue-50
                                           @elseif($app->status == 'interview') text-yellow-700 bg-yellow-50
                                           @elseif($app->status == 'diterima') text-green-700 bg-green-50
                                           @elseif($app->status == 'ditolak') text-red-700 bg-red-50
                                           @endif"
                                    onchange="updateStatus({{ $app->id }}, this.value)">
                                @foreach(['daftar','interview','diterima','ditolak'] as $s)
                                    <option value="{{ $s }}" {{ $app->status == $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="loading-{{ $app->id }}" class="hidden">
                                <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden xl:table-cell">
                        @if($app->status === 'interview')
                            @if($app->interview_at)
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($app->interview_at)->format('d M Y · H:i') }}
                                </span>
                            @else
                                <span class="text-xs font-semibold text-red-600">
                                    ⚠️ Belum dijadwalkan
                                </span>
                            @endif
                        @else
                            <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center gap-2">
                            <button @click="showNotes(
                                        @js(optional($app->notes->first())->content),
                                        @js($app->company_name),
                                        {{ $app->id }}
                                    )"
                                    type="button"
                                    class="p-2 text-purple-600 hover:bg-purple-100 rounded-lg transition-colors group/btn"
                                    title="Lihat Notes">
                                <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                            <a href="{{ route('applications.edit', $app) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors group/btn" 
                               title="Edit">
                                <svg class="h-5 w-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('applications.destroy', $app) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus lamaran ini?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors group/btn" 
                                        title="Hapus">
                                    <svg class="h-5 w-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                @if(request('search') || request('status') != 'all')
                                    Tidak ada hasil yang ditemukan
                                @else
                                    Belum ada lamaran
                                @endif
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                @if(request('search') || request('status') != 'all')
                                    Coba ubah filter atau kata kunci pencarian Anda
                                @else
                                    Mulai perjalanan karirmu dengan menambahkan lamaran kerja pertama
                                @endif
                            </p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="mt-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-700">
                Menampilkan <span class="font-semibold">{{ $applications->firstItem() }}</span> 
                sampai <span class="font-semibold">{{ $applications->lastItem() }}</span> 
                dari <span class="font-semibold">{{ $applications->total() }}</span> lamaran
            </div>
            <div>
                {{ $applications->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- JavaScript for Status Update -->
<script>
async function updateStatus(appId, newStatus, viewType = 'table') {
    const selectId = viewType === 'card' ? `status-card-${appId}` : `status-${appId}`;
    const loadingId = viewType === 'card' ? `loading-card-${appId}` : `loading-${appId}`;
    
    const select = document.getElementById(selectId);
    const loading = document.getElementById(loadingId);
    const oldStatus = select.dataset.oldStatus || select.value;
    
    select.dataset.oldStatus = oldStatus;
    loading.classList.remove('hidden');
    select.disabled = true;
    
    try {
        const response = await fetch(`/applications/${appId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        });
        
        const data = await response.json();
        
        if (!response.ok || !data.success) {
            select.value = oldStatus;
            showNotification('Gagal mengupdate status', 'error');
        } else {
            select.dataset.oldStatus = newStatus;
            updateSelectColor(select, newStatus);
            showNotification('Status berhasil diupdate!', 'success');
            
            // Reload after 1 second to update stats
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
        
    } catch (error) {
        console.error('Error:', error);
        select.value = oldStatus;
        showNotification('Terjadi kesalahan saat mengupdate status', 'error');
    } finally {
        loading.classList.add('hidden');
        select.disabled = false;
    }
}

function updateSelectColor(select, status) {
    select.className = select.className.replace(/text-\w+-\d+|bg-\w+-\d+/g, '');
    
    const colors = {
        'daftar': 'text-blue-700 bg-blue-50',
        'interview': 'text-yellow-700 bg-yellow-50',
        'diterima': 'text-green-700 bg-green-50',
        'ditolak': 'text-red-700 bg-red-50'
    };
    
    const baseClasses = 'text-xs font-semibold rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-1.5 px-2';
    select.className = `${baseClasses} ${colors[status] || 'text-gray-700 bg-gray-50'}`;
}

function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-300 flex items-center gap-3 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white font-semibold`;
    
    const icon = type === 'success' 
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
    
    notification.innerHTML = icon + '<span>' + message + '</span>';
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
</script>
@endsection