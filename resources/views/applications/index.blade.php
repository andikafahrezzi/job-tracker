@extends('layouts.app')

@section('title', 'Daftar Lamaran')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Lamaran</h1>

<a href="{{ route('applications.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah</a>

<table class="w-full mt-4 border rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Perusahaan</th>
            <th class="px-4 py-2 text-left">Posisi</th>
            <th class="px-4 py-2 text-left">Gaji</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
        <tr class="border-t hover:bg-gray-50">
            <td class="px-4 py-2">{{ $app->company_name }}</td>
            <td class="px-4 py-2">{{ $app->position }}</td>
            <td class="px-4 py-2">{{ $app->salary_estimation ?? '-' }}</td>
            
            {{-- Inline Status Dropdown --}}
            <td class="px-4 py-2">
                <form action="{{ route('applications.update', $app) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="rounded border px-2 py-1 text-sm" onchange="this.form.submit()">
                        @foreach(['daftar','interview','diterima','ditolak'] as $status)
                            <option value="{{ $status }}" @selected($app->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </form>
            </td>

            {{-- Action Icons --}}
            <td class="px-4 py-2 text-center flex justify-center gap-2">
                <a href="{{ route('applications.edit', $app) }}" title="Edit" class="text-blue-600 hover:text-blue-800">
                    <!-- Heroicons pencil icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v5m4 4l9-9m0 0l-3-3m3 3l-9 9"/>
                    </svg>
                </a>
                <form action="{{ route('applications.destroy', $app) }}" method="POST" onsubmit="return confirm('Hapus lamaran ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="Hapus" class="text-red-600 hover:text-red-800">
                        <!-- Heroicons trash icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                        </svg>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $applications->links() }}
</div>
@endsection
