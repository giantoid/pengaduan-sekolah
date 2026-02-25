<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if (auth()->user()->role === 'admin') {
            // Mulai query
            $query = Complaint::with(['category', 'user', 'feedback']);

            // Filter berdasarkan pencarian (Nama Siswa atau Lokasi)
            if ($request->has('search')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                })->orWhere('location', 'like', '%'.$request->search.'%');
            }

            // Filter berdasarkan Kategori
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // Filter berdasarkan Status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $aspirasis = $query->latest()->get();

            return view('admin.dashboard', compact('aspirasis', 'categories'));
        }

        // Logic Siswa tetap sama
        $aspirasis = Complaint::with(['category', 'feedback'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('categories', 'aspirasis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Simpan ke database
        Complaint::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Aspirasi Anda berhasil terkirim!');
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'status' => 'required|in:pending,processing,done',
            'feedback' => 'required|string',
        ]);

        // 1. Update Status di tabel Complaints
        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            'status' => $request->status,
        ]);

        // 2. Simpan atau Update Tanggapan di tabel Feedbacks
        Feedback::updateOrCreate(
            ['complaint_id' => $id], // Cari berdasarkan ID laporan
            [
                'admin_id' => auth()->id(), // Admin yang login
                'content' => $request->feedback,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Status dan tanggapan berhasil diperbarui!');
    }
}
