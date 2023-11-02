<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Koleksi;
use App\DataTables\TransactionDatatable;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Carbon\Carbon;



class TransactionController extends Controller
{
    public function index(TransactionDatatable $dataTable)
    {
        return $dataTable->render('transaction.daftarTransaction');
    }

    public function show($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $koleksi = Koleksi::where('id', $transaksi->id)->get();
        $transaksiDetails = DetailTransaction::where('idTransaksi', $id)->get();
        return view('transaction.infoTransaction', compact('transaksi','transaksiDetails'));
    }

    public function create()
    {
        $users = User::all();
        $koleksi = Koleksi::where('jumlahSisa', '>=', 3)->get();
        return view('transaction.register', compact('users','koleksi'));
    }

    public function edit($id)
    {
        $transaksiDetail = DetailTransaction::findOrFail($id);
        $transaksi = Transaction::findOrFail($transaksiDetail->idTransaksi);
        $koleksi = Koleksi::where('id', $transaksiDetail->idKoleksi);
        return view('transaction.editTransaction', compact('transaksiDetail', 'transaksi','koleksi'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|integer|in:1,2,3',
    ]);

    $transaksiDetail = DetailTransaction::findOrFail($id);
    $transaksiDetail->status = $request->status;
    $transaksiDetail->save();
    if ($request->status != 1) {
        $transaksiDetail->tanggalKembali = Carbon::now();
        $transaksiDetail->save();
    }
    $transaksi = Transaction::findOrFail($transaksiDetail->idTransaksi);

    if ($request->status != 1) {
        $koleksi = Koleksi::findOrFail($transaksiDetail->idKoleksi);
        if ($koleksi) {
            $koleksi->jumlahSisa += ($request->status == 1) ? -1 : 1;
            $koleksi->jumlahKeluar += ($request->status == 1) ? 1 : -1;
            $koleksi->save();
        }
    }

    if (DetailTransaction::where('idTransaksi', $transaksi->id)->where('status', 1)->count() == 0) {
        $transaksi->tanggalSelesai = Carbon::now();
        $transaksi->save();
    }

    return redirect()->route('transaksi.infoTransaksi', $transaksi->id)->with('success', 'Transaksi berhasil diperbarui!');
}
// Nama    : Togi Samuel Simarmata
// NIM     : 6706223067
// Kelas   : D3RPLA-4603
    public function store(Request $request)
{
    $request->validate([
        'idPeminjam' => 'required|integer',
        'transaksi1' => 'required|integer',
        'transaksi2' => 'required|integer',
        'transaksi3' => 'required|integer',
    ]);

    $transaksi = Transaction::create([
        'idPetugas' => auth()->user()->id,
        'idPeminjam' => $request->idPeminjam,
        'tanggalPinjam' => Carbon::now(),
    ]);

    $idKoleksis = [$request->transaksi1, $request->transaksi2, $request->transaksi3];

    foreach ($idKoleksis as $idKoleksi) {
        DetailTransaction::create([
            'idTransaksi' => $transaksi->id,
            'idKoleksi' => $idKoleksi,
            'status' => 1,
        ]);

        $koleksi = Koleksi::find($idKoleksi);
        $koleksi->jumlahKeluar += 1;
        $koleksi->jumlahSisa -= 1;
        $koleksi->save();
    }

    Session::flash('success', 'Transaksi berhasil ditambahkan!');
    return redirect()->route('transaksi.registrasi');
}
}
