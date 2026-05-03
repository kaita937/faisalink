@extends('dashboard.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manajemen Perlengkapan Fasilitas Kampus</h1>

    <a href="{{ route('admin.equipment.create') }}" class="btn btn-primary mb-4">
        Tambah Perlengkapan
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Perlengkapan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($equipment as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->fasilitas->nama_fasilitas ?? 'Fasilitas Tidak Ditemukan' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_perlengkapan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->kondisi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.equipment.edit', $item->id_perlengkapan_fasilitas) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem;">Edit</a>
                            <form action="{{ route('admin.equipment.destroy', $item->id_perlengkapan_fasilitas) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-reject" style="padding: 6px 12px; font-size: 0.8rem;" data-confirm="Apakah Anda yakin ingin menghapus perlengkapan ini?">Hapus</button>
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