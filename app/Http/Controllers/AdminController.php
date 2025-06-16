<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $dtBooking = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.dashboard', compact('dtBooking'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $statusBaru = $request->input('status');
        if (in_array($statusBaru, ['diterima', 'ditolak'])) {
            $booking->status = $statusBaru;
            $booking->save();
        }

        return Redirect::route('admin.dashboard')->with('success', 'Status booking diperbarui.');
    }
}
