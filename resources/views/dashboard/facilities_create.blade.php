@extends('dashboard.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tambah Fasilitas Kampus</h1>

    <form action="{{ route('admin.facilities.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="nama_fasilitas" class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="lokasi_fasilitas" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Fasilitas</label>
            <input type="text" name="lokasi_fasilitas" id="lokasi_fasilitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="kapasitas" class="block text-gray-700 text-sm font-bold mb-2">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="status_fasilitas" class="block text-gray-700 text-sm font-bold mb-2">Status Fasilitas</label>
            <select name="status_fasilitas" id="status_fasilitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
                <option value="Dalam Perbaikan">Dalam Perbaikan</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
            <a href="{{ route('admin.facilities.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection