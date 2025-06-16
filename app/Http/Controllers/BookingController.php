<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/BookingController.php

    public function index()
    {
        $dtBooking = Booking::all();
        return view('admin.dashboard', compact('dtBooking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-booking');
    }

    public function statusBooking()
    {
        $userEmail = Auth::user()->email;

        $bookings = Booking::where('email', $userEmail)->get();

        return view('status-booking', compact('bookings'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validasi
        $data = $request->validate([
            'lapangan' => 'required|in:1,2,3',
            'tanggal' => 'required|date',
            'jam' => [
                'required',
                'date_format:H:i',
                'after_or_equal:07:00',
                'before_or_equal:21:00',
            ],
            'krs' => 'required|file|mimes:pdf|max:2048',

        ]);



        // ❌ JANGAN DITAMBAH INI LAGI:
        // $data = $request->only(['tanggal', 'jam']);

        // ✅ Cek apakah slot jam sudah dibooking
        $existingBooking = Booking::where('tanggal', $data['tanggal'])
            ->where('jam', $data['jam'])
            ->where('lapangan', $data['lapangan'])
            ->first();

        if ($existingBooking) {
            throw ValidationException::withMessages([
                'jam' => 'Jam tersebut sudah dibooking. Silakan pilih jam lain.',
            ]);
        }

        // ✅ Upload file
        if ($request->hasFile('krs')) {
            $file = $request->file('krs');
            $path = $file->store('krs_files', 'public');
            $data['krs'] = $path;
        }

        // ✅ Tambahkan data user
        $data['email'] = Auth::user()->email;
        $data['name'] = Auth::user()->name;
        $data['status'] = 'menunggu';

        // ✅ Simpan ke database
        Booking::create($data);
        return redirect()->back()->with('success', 'Booking berhasil!');
    }

    public function getAvailableJam(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $lapangan = $request->input('lapangan'); // ✅ Ambil juga data lapangan

        $allJam = [
            '07:00',
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
        ];

        // ✅ Cek jam yang dibooking untuk tanggal & lapangan spesifik
        $bookedJam = Booking::where('tanggal', $tanggal)
            ->where('lapangan', $lapangan)
            ->pluck('jam')
            ->toArray();

        $availableJam = array_diff($allJam, $bookedJam);

        return response()->json(array_values($availableJam));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
