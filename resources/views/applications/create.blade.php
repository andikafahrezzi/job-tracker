@extends('layouts.app')

@section('title', 'Tambah Lamaran')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Tambah Lamaran</h1>

    <form method="POST" action="{{ route('applications.store') }}">
        @csrf

        <x-form-input name="company_name" label="Nama Perusahaan" />
        <x-form-input name="position" label="Posisi Dilamar" />
        <x-form-input name="salary_estimation" label="Estimasi Gaji" type="number" />

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full rounded border px-3 py-2 focus:ring focus:ring-blue-200">
                @foreach(['daftar','interview','diterima','ditolak'] as $status)
                    <option value="{{ $status }}" @selected(old('status') === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            @error('status')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('applications.index') }}" class="text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
