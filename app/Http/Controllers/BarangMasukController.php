<?php

namespace App\Http\Controllers;

use App\BarangMasuk;
use App\Produk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listBarangMasuk = DB::table('barangmasuk')
            ->select('barangmasuk.id as id','barangmasuk.no_transaksi as no_transaksi','barangmasuk.tanggal as tanggal', 'barangmasuk.id_vendor as id_vendor', 'barangmasuk.id_barang as id_barang', 'barangmasuk.jumlah_barang as jumlah_barang', 'barangmasuk.harga_barang as harga_barang', 'vendor.nama_vendor as nama_vendor', 'produk.nama_produk as nama_produk')
            ->leftJoin('vendor', 'barangmasuk.id_vendor', '=', 'vendor.id')
            ->leftJoin('produk', 'barangmasuk.id_barang', '=', 'produk.id')
            ->get();

        return view('barangMasuk.index', compact('listBarangMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $vendor = DB::table('vendor')->pluck('nama_vendor','id');
        $produk = DB::table('produk')->pluck('nama_produk','id');
        return view('barangMasuk.create', compact('vendor', 'produk'));
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
            'kode_vendor.required' => 'Mohon pilih vendor terlebih dahulu',
            'kode_produk.required' => 'Mohon pilih barang terlebih dahulu',
            'jumlah_barang.required' => 'Mohon isi jumlah barang terlebih dahulu',
            'harga_barang.required' => 'Mohon isi harga barang terlebih dahulu'
        ];
        $validator = Validator::make($request->all(), [
            'no_transaksi'=> 'required|unique:barangmasuk',
            'tanggal' => 'required',
            'kode_vendor' => 'required',
            'kode_produk' => 'required',
            'jumlah_barang' => 'required',
            'harga_barang' => 'required'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $barangMasuk = new BarangMasuk();
        $barangMasuk->no_transaksi = $request->input('no_transaksi');
        $barangMasuk->tanggal = $request->input('tanggal');
        $barangMasuk->id_vendor = $request->input('kode_vendor');
        $barangMasuk->id_barang = $request->input('kode_produk');
        $barangMasuk->jumlah_barang = $request->input('jumlah_barang');
        $barangMasuk->harga_barang = $request->input('harga_barang');
        $barangMasuk->created_by = Auth::user()->nim;
        $barangMasuk->save();

        // increase stock here
        $produk = Produk::find($barangMasuk->id_barang);
        $produk->stok = $barangMasuk->jumlah_barang + $produk->stok;
        $produk->save();


        return \redirect('barangMasuk')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = BarangMasuk::find($id);

        return view('barangMasuk.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = BarangMasuk::find($id);

        return view('barangMasuk.edit', compact('detail'));
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
            'nama_barangMasuk.required' => 'Mohon isi nama barangMasuk terlebih dahulu',
            'nama_barangMasuk.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_barangMasuk.unique' => 'Kode barangMasuk duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_barangMasuk'=> 'required|unique:barangMasuk',
            'nama_barangMasuk' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->kode_barangMasuk = $request->input('kode_barangMasuk');
        $barangMasuk->nama_barangMasuk = $request->input('nama_barangMasuk');
        $barangMasuk->alamat = $request->input('alamat');
        $barangMasuk->kota = $request->input('kota');
        $barangMasuk->save();

        return \redirect('barangMasuk')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::find($id);
        $barangMasuk->delete();

        return \redirect('barangMasuk')->with('success', 'Delete data berhasil');
    }
}
