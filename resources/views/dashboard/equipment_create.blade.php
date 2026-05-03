@extends('dashboard.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tambah Perlengkapan Fasilitas Kampus</h1>

    <form action="{{ route('admin.equipment.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label for="id_fasilitas" class="block text-gray-700 text-sm font-bold mb-2">Fasilitas</label>
            <select name="id_fasilitas" id="id_fasilitas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($facilities as $facility)
                <option value="{{ $facility->id_fasilitas }}">{{ $facility->nama_fasilitas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="nama_perlengkapan" class="block text-gray-700 text-sm font-bold mb-2">Nama Perlengkapan</label>
            <input type="text" name="nama_perlengkapan" id="nama_perlengkapan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-gray-700 text-sm font-bold mb-2">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="kondisi" class="block text-gray-700 text-sm font-bold mb-2">Kondisi</label>
            <select name="kondisi" id="kondisi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="Baik">Baik</option>
                <option value="Rusak">Rusak</option>
                <option value="Perlu Perbaikan">Perlu Perbaikan</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
            <a href="{{ route('admin.equipment.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection