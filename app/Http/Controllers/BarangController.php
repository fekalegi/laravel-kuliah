<?php

namespace App\Http\Controllers;

use App\Barang;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listBarang = Barang::where('stok', '>=', 15)->get();
        return view('barang.index', compact('listBarang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('barang.create');
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
            'name.required' => 'Mohon isi nama produk terlebih dahulu',
            'name.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $barang = new Barang();
        $barang->code = $request->input('code');
        $barang->name = $request->input('name');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->stok = $request->input('stok');
        $barang->harga = $request->input('harga');
        $barang->save();

        return \redirect('barang')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = Barang::find($id);

        return view('barang.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = Barang::find($id);

        return view('barang.edit', compact('detail'));
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
        $barang = Barang::find($id);
        $barang->code = $request->input('code');
        $barang->name = $request->input('name');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->stok = $request->input('stok');
        $barang->harga = $request->input('harga');
        $barang->save();

        return \redirect('barang')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return \redirect('barang')->with('success', 'Delete data berhasil');
    }
}
