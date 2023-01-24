<?php

namespace App\Http\Controllers;

use App\Produk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listProduk = Produk::get();
        return view('produk.index', compact('listProduk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('produk.create');
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
            'nama_produk.required' => 'Mohon isi nama produk terlebih dahulu',
            'nama_produk.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_produk.unique' => 'Kode produk duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_produk'=> 'required|unique:produk',
            'nama_produk' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $produk = new Produk();
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->stok = $request->input('stok');
        $produk->harga = $request->input('harga');
        $produk->created_by = Auth::user()->nim;
        $produk->save();

        return \redirect('produk')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = Produk::find($id);

        return view('produk.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = Produk::find($id);

        return view('produk.edit', compact('detail'));
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
            'nama_produk.required' => 'Mohon isi nama produk terlebih dahulu',
            'nama_produk.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_produk.unique' => 'Kode produk duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_produk'=> 'required|unique:produk',
            'nama_produk' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $produk = Produk::find($id);
        $produk->kode_produk = $request->input('kode_produk');
        $produk->nama_produk = $request->input('nama_produk');
        $produk->stok = $request->input('stok');
        $produk->harga = $request->input('harga');
        $produk->save();

        return \redirect('produk')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return \redirect('produk')->with('success', 'Delete data berhasil');
    }
}
