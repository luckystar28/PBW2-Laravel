<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Koleksi;

class KoleksiController extends Controller
{
    public function index() {
        $koleksi = Koleksi::all();
        return view('koleksi.daftarKoleksi', compact('koleksi'));
    }

    public function show($id)
    {
        $koleksi = Koleksi::findOrFail($id);
        return view('koleksi.infoKoleksi', compact('koleksi'));
    }

    public function create()
    {
    return view('koleksi.registrasi');
    }

    public function store(Request $request)
    {
    $request->validate([
        'namaKoleksi' => 'required|string|max:255',
        'jenisKoleksi' => 'required|string|max:255',
        'jumlahKoleksi' => 'required|integer',
    ]);
    Koleksi::create([
        'namaKoleksi' => $request->namaKoleksi,
        'jenisKoleksi' => $request->jenisKoleksi,
        'jumlahKoleksi' => $request->jumlahKoleksi,
    ]);
    // return redirect()->route('koleksi.store')->with('success', 'Koleksi berhasil ditambahkan!');
    Session::flash('success', 'Koleksi berhasil ditambahkan!');
    return redirect()->route('koleksi.registrasi');
}

}
