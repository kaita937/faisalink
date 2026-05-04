@extends('dashboard.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manajemen Fasilitas Kampus</h1>

    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary mb-4">
        Tambah Fasilitas
    </a>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($facilities as $facility)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facility->nama_fasilitas }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facility->lokasi_fasilitas }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facility->kapasitas }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $facility->status_fasilitas }}</td>
                    <td class="px-6 py-4">{{ Str::limit($facility->deskripsi, 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.facilities.equipment', $facility->id_fasilitas) }}" class="btn" style="background-color: #2e66ff; color: white; padding: 6px 12px; font-size: 0.8rem;">Perlengkapan</a>
                            <a href="{{ route('admin.facilities.edit', $facility->id_fasilitas) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem; background-color: #ffaa00; border-color: #ffaa00;">Edit</a>
                            <form action="{{ route('admin.facilities.destroy', $facility->id_fasilitas) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-reject" style="padding: 6px 12px; font-size: 0.8rem;" data-confirm="Apakah Anda yakin ingin menghapus fasilitas ini?">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection