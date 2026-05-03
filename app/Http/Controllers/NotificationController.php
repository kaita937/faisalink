<?php

namespace App\Http\Controllers;

use App\Models\PeminjamNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markRead($id)
    {
        $userId = auth('peminjam')->id();

        $notification = PeminjamNotification::where('id', $id)
            ->where('id_peminjam', $userId)
            ->firstOrFail();

        if (empty($notification->read_at)) {
            $notification->read_at = now();
            $notification->save();
        }

        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        $userId = auth('peminjam')->id();

        PeminjamNotification::where('id_peminjam', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}
