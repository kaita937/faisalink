<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Peminjam;
use App\Models\PeminjamNotification;
use App\Models\Fasilitas_Kampus;
use App\Models\Review_Fasilitas;
use App\Models\Perlengkapan_Fasilitas_Kampus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar peminjaman (opsional filter status)
     */
    public function bookingsIndex(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $status = $request->query('status', 'all');
        $allowedStatuses = ['Pending', 'Menghubungi Sarpras', 'Disetujui', 'Ditolak'];

        if (!in_array($status, $allowedStatuses, true)) {
            $status = 'all';
        }

        $bookingsQuery = Peminjaman::with(['peminjam', 'fasilitas'])
            ->orderBy('tanggal_pengajuan', 'desc');

        if ($status === 'Pending') {
            $bookingsQuery->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras']);
        } elseif ($status !== 'all') {
            $bookingsQuery->where('status_peminjaman', $status);
        }

        $bookings = $bookingsQuery->get();

        return view('dashboard.booking_list', compact('admin', 'bookings', 'status'));
    }
    /**
     * Menampilkan detail peminjaman
     */
    public function bookingDetail($id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::with(['peminjam', 'fasilitas'])->findOrFail($id);
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.booking_detail', compact('admin', 'booking', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    /**
     * Setujui peminjaman
     */
    public function approveBooking(Request $request, $id)
    {
        $request->validate([
            'bukti_peminjaman' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::with('fasilitas')->findOrFail($id);

        if ($booking->bukti_peminjaman_path) {
            Storage::disk('public')->delete($booking->bukti_peminjaman_path);
        }

        $path = $request->file('bukti_peminjaman')->store('bukti-peminjaman', 'public');

        $booking->update([
            'status_peminjaman' => 'Disetujui',
            'id_admin' => $admin->id_admin,
            'bukti_peminjaman_path' => $path,
        ]);

        PeminjamNotification::create([
            'id_peminjam' => $booking->id_peminjam,
            'id_peminjaman' => $booking->id_peminjaman,
            'type' => 'success',
            'title' => 'Pengajuan disetujui',
            'message' => 'Booking ' . ($booking->fasilitas->nama_fasilitas ?? 'fasilitas') . ' telah disetujui.',
            'url' => route('booking.detail', $booking->id_peminjaman),
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui dan surat bukti diunggah.');
    }

    /**
     * Tolak peminjaman
     */
    public function rejectBooking(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500',
        ]);

        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::with('fasilitas')->findOrFail($id);

        $booking->update([
            'status_peminjaman' => 'Ditolak',
            'id_admin' => $admin->id_admin,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        PeminjamNotification::create([
            'id_peminjam' => $booking->id_peminjam,
            'id_peminjaman' => $booking->id_peminjaman,
            'type' => 'warning',
            'title' => 'Pengajuan ditolak',
            'message' => 'Booking ' . ($booking->fasilitas->nama_fasilitas ?? 'fasilitas') . ' ditolak. Alasan: ' . $request->alasan_penolakan,
            'url' => route('booking.detail', $booking->id_peminjaman),
        ]);

        return redirect()->back()->with('success', 'Peminjaman telah ditolak dengan alasan.');
    }

    /**
     * Tandai booking sedang menghubungi Sarpras
     */
    public function contactSarpras(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::findOrFail($id);

        if ($booking->status_peminjaman === 'Pending') {
            $booking->update([
                'status_peminjaman' => 'Menghubungi Sarpras',
                'id_admin' => $admin->id_admin,
            ]);
        }

        return response()->json([
            'status' => $booking->status_peminjaman,
        ]);
    }

    public function uploadBuktiPeminjaman(Request $request, $id)
    {
        $request->validate([
            'bukti_peminjaman' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $admin = Auth::guard('admin')->user();
        $booking = Peminjaman::findOrFail($id);

        if ($booking->bukti_peminjaman_path) {
            Storage::disk('public')->delete($booking->bukti_peminjaman_path);
        }

        $path = $request->file('bukti_peminjaman')->store('bukti-peminjaman', 'public');

        $booking->update([
            'bukti_peminjaman_path' => $path,
            'id_admin' => $admin->id_admin,
        ]);

        return redirect()->back()->with('success', 'Surat bukti peminjaman berhasil diunggah.');
    }

    // Fasilitas CRUD
    public function facilitiesIndex()
    {
        $admin = Auth::guard('admin')->user();
        $facilities = Fasilitas_Kampus::all();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities', compact('admin', 'facilities', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesCreate()
    {
        $admin = Auth::guard('admin')->user();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities_create', compact('admin', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesStore(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Fasilitas_Kampus::create($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function facilitiesEdit($id)
    {
        $admin = Auth::guard('admin')->user();
        $facility = Fasilitas_Kampus::findOrFail($id);
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.facilities_edit', compact('admin', 'facility', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function facilitiesUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'lokasi_fasilitas' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'status_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $facility = Fasilitas_Kampus::findOrFail($id);
        $facility->update($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function facilitiesDestroy($id)
    {
        $facility = Fasilitas_Kampus::findOrFail($id);
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function facilityEquipment($id)
    {
        $admin = Auth::guard('admin')->user();
        $facility = Fasilitas_Kampus::with('perlengkapan')->findOrFail($id);
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
            
        return view('dashboard.facility_equipment', compact('admin', 'facility', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    // Perlengkapan CRUD
    public function equipmentIndex()
    {
        $admin = Auth::guard('admin')->user();
        $equipment = Perlengkapan_Fasilitas_Kampus::with('fasilitas')->get();
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment', compact('admin', 'equipment', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentCreate(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $facilities = Fasilitas_Kampus::all();
        $selectedFacilityId = $request->query('facility_id');
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment_create', compact('admin', 'facilities', 'selectedFacilityId', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentStore(Request $request)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:Fasilitas_Kampus,id_fasilitas',
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
        ]);

        Perlengkapan_Fasilitas_Kampus::create($request->all());

        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to)->with('success', 'Perlengkapan berhasil ditambahkan.');
        }

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil ditambahkan.');
    }

    public function equipmentEdit(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $facilities = Fasilitas_Kampus::all();
        $redirectTo = $request->query('redirect_to');
        
        // Statistik untuk layout
        $totalPeminjaman = Peminjaman::count();
        $peminjamanbaru = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])->count();
        $peminjamanditerima = Peminjaman::where('status_peminjaman', 'Disetujui')->count();
        $pendingBookings = Peminjaman::with('peminjam', 'fasilitas')
            ->whereIn('status_peminjaman', ['Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_pengajuan', 'asc')
            ->limit(5)
            ->get();
        
        return view('dashboard.equipment_edit', compact('admin', 'equipment', 'facilities', 'redirectTo', 'totalPeminjaman', 'peminjamanbaru', 'peminjamanditerima', 'pendingBookings'));
    }

    public function equipmentUpdate(Request $request, $id)
    {
        $request->validate([
            'id_fasilitas' => 'required|exists:Fasilitas_Kampus,id_fasilitas',
            'nama_perlengkapan' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'kondisi' => 'required|string|max:255',
        ]);

        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $equipment->update($request->all());

        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to)->with('success', 'Perlengkapan berhasil diperbarui.');
        }

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil diperbarui.');
    }

    public function equipmentDestroy(Request $request, $id)
    {
        $equipment = Perlengkapan_Fasilitas_Kampus::findOrFail($id);
        $equipment->delete();

        if ($request->has('redirect_to')) {
            return redirect($request->redirect_to)->with('success', 'Perlengkapan berhasil dihapus.');
        }

        return redirect()->route('admin.equipment.index')->with('success', 'Perlengkapan berhasil dihapus.');
    }

    public function usersIndex()
    {
        $admin = Auth::guard('admin')->user();
        $users = Peminjam::orderBy('nama_peminjam')->get();

        return view('dashboard.user', compact('admin', 'users'));
    }

    public function usersDestroy($id)
    {
        $user = Peminjam::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
    
    public function facility($category = null)
    {
        $admin = Auth::guard('admin')->user();
        $user = Auth::guard('peminjam')->user();
        $fasilitas = Fasilitas_Kampus::query()
            ->withAvg('reviews as average_rating', 'rating')
            ->withCount('reviews')
            ->get();
        $initialCategory = $category;

        return view('dashboard.facility_admin', compact('admin', 'user', 'fasilitas', 'initialCategory'));
    }

    public function facilityDetail($id)
    {
        $admin = Auth::guard('admin')->user();
        $user = Auth::guard('peminjam')->user();
        $fasilitas = Fasilitas_Kampus::with('perlengkapan')->findOrFail($id);

        $approvedAndPendingBookings = Peminjaman::with('peminjam')
            ->where('id_fasilitas', $id)
            ->whereIn('status_peminjaman', ['Disetujui', 'Pending', 'Menghubungi Sarpras'])
            ->orderBy('tanggal_peminjaman', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        $reviews = Review_Fasilitas::with('peminjam')
            ->where('id_fasilitas', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $averageRating = $reviews->avg('rating');
        $reviewsCount = $reviews->count();

        return view('dashboard.facility_detail_admin', compact('admin', 'user', 'fasilitas', 'approvedAndPendingBookings', 'reviews', 'averageRating', 'reviewsCount'));
        $notifications = \App\Models\PeminjamNotification::where('id_peminjam', $user->id_peminjam)->orderBy('created_at', 'desc')->get();
        $unreadCount = $notifications->whereNull('read_at')->count();

        return view('dasboard.facility_detail_admin', compact('admin', 'user', 'fasilitas', 'approvedAndPendingBookings', 'reviews', 'averageRating', 'reviewsCount', 'notifications', 'unreadCount'));
    }

}
