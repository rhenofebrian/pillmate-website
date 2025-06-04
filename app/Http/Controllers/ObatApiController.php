<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Obat::where('user_id', $user->id);

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_obat', 'like', '%' . $request->search . '%');
        }

        $medications = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($medications);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string',
            'jenis_obat' => 'required|in:Tablet/Kapsul,Sirup',
            'jumlah_obat' => 'required|numeric',
            'dikonsumsi' => 'required|in:sesudah makan,sebelum makan',
            'dosis' => 'required|string',
            'durasi' => 'required|string',
        ]);

        $obat = Obat::create(array_merge($validated, [
            'user_id' => $request->user()->id,
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil ditambahkan.',
            'data' => $obat
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis_obat' => 'required|in:Tablet/Kapsul,Sirup',
            'jumlah_obat' => 'required|numeric|min:0.01',
            'dikonsumsi' => 'required|in:sesudah makan,sebelum makan',
            'dosis' => 'required|string|max:100',
            'durasi' => 'required|string|max:100',
        ]);

        $obat = Obat::where('user_id', $request->user()->id)->findOrFail($id);
        $obat->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil diperbarui.',
            'data' => $obat
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $obat = Obat::where('user_id', $request->user()->id)->findOrFail($id);
        $obat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil dihapus.'
        ]);
    }

    public function show(Request $request, $id)
    {
        $obat = Obat::where('user_id', $request->user()->id)->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $obat
        ]);
    }
}
