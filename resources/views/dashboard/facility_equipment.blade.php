@extends('dashboard.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold">Kelola Perlengkapan</h1>
            <p class="text-gray-600">Fasilitas: <span class="font-semibold text-blue-600">{{ $facility->nama_fasilitas }}</span></p>
        </div>
        <a href="{{ route('admin.facilities.index') }}" class="btn" style="background-color: #666; color: white;">
            &larr; Kembali ke Daftar Fasilitas
        </a>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.equipment.create', ['facility_id' => $facility->id_fasilitas, 'redirect_to' => url()->current()]) }}" class="btn btn-primary">
            + Tambah Perlengkapan untuk Fasilitas Ini
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Perlengkapan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($facility->perlengkapan as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_perlengkapan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $item->jumlah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->kondisi == 'Bagus' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $item->kondisi }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.equipment.edit', [$item->id_perlengkapan_fasilitas, 'redirect_to' => url()->current()]) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem; background-color: #ffaa00; border-color: #ffaa00;">Edit</a>
                            <form action="{{ route('admin.equipment.destroy', [$item->id_perlengkapan_fasilitas, 'redirect_to' => url()->current()]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-reject" style="padding: 6px 12px; font-size: 0.8rem;" data-confirm="Apakah Anda yakin ingin menghapus perlengkapan ini?">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        Belum ada perlengkapan yang ditambahkan untuk fasilitas ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
