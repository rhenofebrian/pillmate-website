<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {    
            $medications = Obat::where('user_id', $user->id)->get();
            return view("tambah-obat", compact("medications"));
        }

        return redirect("login");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'jenis_obat' => 'required|in:Tablet/Kapsul,Sirup',
            'jumlah_obat' => 'required|numeric',
            'dikonsumsi'=> 'required|in:sesudah makan,sebelum makan',
            'dosis' => 'required|string',
            'durasi' => 'required|string',
        ]);

        $obat = Obat::create([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'jumlah_obat'=> $request->jumlah_obat,
            'dikonsumsi' => $request->dikonsumsi,
            'dosis' => $request->dosis,
            'durasi' => $request->durasi,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('riwayat')->with('success', 'Menambahkan obat berhasil!');
    }

    public function addedItem(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $query = Obat::where('user_id', $user->id);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_obat', 'like', '%' . $request->search . '%');
        }

        // Order by latest first and paginate with 10 items per page
        $medications = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('riwayat', compact('medications'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_obat' => 'required|string|max:255',
                'jenis_obat' => 'required|in:Tablet/Kapsul,Sirup',
                'jumlah_obat' => 'required|numeric|min:0.01',
                'dikonsumsi'=> 'required|in:sesudah makan,sebelum makan',
                'dosis' => 'required|string|max:100',
                'durasi' => 'required|string|max:100',
            ], [
                'nama_obat.required' => 'Nama obat wajib diisi.',
                'nama_obat.max' => 'Nama obat maksimal 255 karakter.',
                'jenis_obat.required' => 'Jenis obat wajib dipilih.',
                'jenis_obat.in' => 'Jenis obat tidak valid.',
                'jumlah_obat.required' => 'Jumlah obat wajib diisi.',
                'jumlah_obat.numeric' => 'Jumlah obat harus berupa angka.',
                'jumlah_obat.min' => 'Jumlah obat minimal 0.01.',
                'dikonsumsi.required' => 'Waktu konsumsi wajib dipilih.',
                'dikonsumsi.in' => 'Waktu konsumsi tidak valid.',
                'dosis.required' => 'Dosis wajib diisi.',
                'dosis.max' => 'Dosis maksimal 100 karakter.',
                'durasi.required' => 'Durasi wajib diisi.',
                'durasi.max' => 'Durasi maksimal 100 karakter.',
            ]);

            // Cari obat berdasarkan ID dan user
            $obat = Obat::where('user_id', auth()->id())->findOrFail($id);

            // Update data
            $obat->update($validated);

            // Response untuk AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data obat berhasil diperbarui!',
                    'data' => $obat
                ]);
            }

            // Redirect untuk non-AJAX
            return redirect()->route('riwayat')->with('success', 'Data obat berhasil diperbarui!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()
                            ->withErrors($e->errors())
                            ->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data obat tidak ditemukan.'
                ], 404);
            }

            return redirect()->route('riwayat')
                            ->with('error', 'Data obat tidak ditemukan.');

        } catch (\Exception $e) {
            \Log::error('Error updating medication: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
                ], 500);
            }

            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.')
                            ->withInput();
        }
    }

    public function destroy($id)
    {
        $obat = Obat::where('user_id', auth()->id())->findOrFail($id);
        $obatName = $obat->nama_obat;
        
        $obat->delete();

        return redirect()->route('riwayat')->with('success', "Obat {$obatName} berhasil dihapus!");
    }
}