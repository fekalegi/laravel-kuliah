<?php

namespace App\Http\Controllers;

use App\BarangKeluar;
use App\Produk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listBarangKeluar = DB::table('barangkeluar')
            ->select('barangkeluar.id as id','barangkeluar.no_transaksi as no_transaksi','barangkeluar.tanggal as tanggal', 'barangkeluar.id_customer as id_customer', 'barangkeluar.id_barang as id_barang', 'barangkeluar.jumlah_barang as jumlah_barang', 'customer.nama_customer as nama_customer', 'produk.nama_produk as nama_produk')
            ->leftJoin('produk', 'barangkeluar.id_barang', '=', 'produk.id')
            ->leftJoin('customer', 'barangkeluar.id_customer', '=', 'customer.id')
            ->get();

        return view('barangKeluar.index', compact('listBarangKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $customer = DB::table('customer')->pluck('nama_customer','id');
        $produk = DB::table('produk')->pluck('nama_produk','id');
        return view('barangKeluar.create', compact('customer', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $messages = [
            'no_transaksi.required' => 'Mohon isi nomor transaksi terlebih dahulu',
            'tanggal.required' => 'Mohon isi tanggal dahulu',
            'kode_customer.required' => 'Mohon pilih vendor terlebih dahulu',
            'kode_produk.required' => 'Mohon pilih barang terlebih dahulu',
            'jumlah_barang.required' => 'Mohon isi jumlah barang terlebih dahulu'
        ];
        $validator = Validator::make($request->all(), [
            'no_transaksi'=> 'required|unique:barangkeluar',
            'tanggal' => 'required',
            'kode_customer' => 'required',
            'kode_produk' => 'required',
            'jumlah_barang' => 'required'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $barangKeluar = new BarangKeluar();
        $barangKeluar->no_transaksi = $request->input('no_transaksi');
        $barangKeluar->tanggal = $request->input('tanggal');
        $barangKeluar->id_customer = $request->input('kode_customer');
        $barangKeluar->id_barang = $request->input('kode_produk');
        $barangKeluar->jumlah_barang = $request->input('jumlah_barang');
        $barangKeluar->created_by = Auth::user()->nim;
        $produk = Produk::find($barangKeluar->id_barang);
        //validation before save
        if ($produk->stok < $barangKeluar->jumlah_barang) {
            $message = [
                'jumlah_barang' => 'Mohon isi jumlah barang tidak melebihi stok, stok barang = '. $produk->stok
            ];
            return Redirect::back()->withErrors($message)->withInput($request->all());
        }

        $barangKeluar->save();

        // dencrease stock here
        $produk->stok = $produk->stok- $barangKeluar->jumlah_barang;
        $produk->save();


        return \redirect('barangKeluar')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = BarangKeluar::find($id);

        return view('barangKeluar.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = BarangKeluar::find($id);

        return view('barangKeluar.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nama_barangKeluar.required' => 'Mohon isi nama barangKeluar terlebih dahulu',
            'nama_barangKeluar.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_barangKeluar.unique' => 'Kode barangKeluar duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_barangKeluar'=> 'required|unique:barangKeluar',
            'nama_barangKeluar' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $barangKeluar = BarangKeluar::find($id);
        $barangKeluar->kode_barangKeluar = $request->input('kode_barangKeluar');
        $barangKeluar->nama_barangKeluar = $request->input('nama_barangKeluar');
        $barangKeluar->alamat = $request->input('alamat');
        $barangKeluar->kota = $request->input('kota');
        $barangKeluar->save();

        return \redirect('barangKeluar')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::find($id);
        $barangKeluar->delete();

        return \redirect('barangKeluar')->with('success', 'Delete data berhasil');
    }
}
