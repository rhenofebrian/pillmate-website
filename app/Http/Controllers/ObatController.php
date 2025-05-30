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
        $request->validate([
            'nama_obat' => 'required|string',
            'jenis_obat' => 'required|in:Tablet/Kapsul,Sirup',
            'jumlah_obat' => 'required|numeric',
            'dikonsumsi'=> 'required|in:sesudah makan,sebelum makan',
            'dosis' => 'required|string',
            'durasi' => 'required|string',
        ]);

        $obat = Obat::where('user_id', auth()->id())->findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'jumlah_obat'=> $request->jumlah_obat,
            'dikonsumsi' => $request->dikonsumsi,
            'dosis' => $request->dosis,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('riwayat')->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::where('user_id', auth()->id())->findOrFail($id);
        $obatName = $obat->nama_obat;
        
        $obat->delete();

        return redirect()->route('riwayat')->with('success', "Obat {$obatName} berhasil dihapus!");
    }
}