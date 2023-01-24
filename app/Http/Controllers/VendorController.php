<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listVendor = Vendor::get();
        return view('vendor.index', compact('listVendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $latestId = Vendor::max('id');
        if(strlen($latestId+1)==3) { $prefix = '0'; }
        elseif(strlen($latestId+1)==2) { $prefix = '00'; }
        else $prefix = '000';
        $kode_vendor = 'VNR-'.$prefix.($latestId+1);
        return view('vendor.create', compact('kode_vendor'));
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
            'nama_vendor.required' => 'Mohon isi nama vendor terlebih dahulu',
            'nama_vendor.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_vendor.unique' => 'Kode vendor duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_vendor'=> 'required|unique:vendor',
            'nama_vendor' => 'required'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $vendor = new Vendor();
        $vendor->kode_vendor = $request->input('kode_vendor');
        $vendor->nama_vendor = $request->input('nama_vendor');
        $vendor->alamat = $request->input('alamat');
        $vendor->kota = $request->input('kota');
        $vendor->created_by = Auth::user()->nim;
        $vendor->save();

        return \redirect('vendor')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = Vendor::find($id);

        return view('vendor.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = Vendor::find($id);

        return view('vendor.edit', compact('detail'));
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
            'nama_vendor.required' => 'Mohon isi nama vendor terlebih dahulu',
            'nama_vendor.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_vendor.unique' => 'Kode vendor duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_vendor'=> 'required|unique:vendor',
            'nama_vendor' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $vendor = Vendor::find($id);
        $vendor->kode_vendor = $request->input('kode_vendor');
        $vendor->nama_vendor = $request->input('nama_vendor');
        $vendor->alamat = $request->input('alamat');
        $vendor->kota = $request->input('kota');
        $vendor->save();

        return \redirect('vendor')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        return \redirect('vendor')->with('success', 'Delete data berhasil');
    }
}
