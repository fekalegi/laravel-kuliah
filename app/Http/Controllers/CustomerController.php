<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $listCustomer = Customer::get();
        return view('customer.index', compact('listCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $latestId = Customer::max('id');
        if(strlen($latestId+1)==3) { $prefix = '0'; }
        elseif(strlen($latestId+1)==2) { $prefix = '00'; }
        else $prefix = '000';
        $kode_customer = 'CST-'.$prefix.($latestId+1);
        return view('customer.create', compact('kode_customer'));
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
            'nama_customer.required' => 'Mohon isi nama customer terlebih dahulu',
            'nama_customer.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_customer.unique' => 'Kode customer duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_customer'=> 'required|unique:customer',
            'nama_customer' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $customer = new Customer();
        $customer->kode_customer = $request->input('kode_customer');
        $customer->nama_customer = $request->input('nama_customer');
        $customer->address = $request->input('address');
        $customer->kota = $request->input('kota');
        $customer->created_by = Auth::user()->nim;
        $customer->save();

        return \redirect('customer')->with('success', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $detail = Customer::find($id);

        return view('customer.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $detail = Customer::find($id);

        return view('customer.edit', compact('detail'));
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
            'nama_customer.required' => 'Mohon isi nama customer terlebih dahulu',
            'nama_customer.alpha_num' => 'Pastikan value yang diinput adalah alfabet dan numeric',
            'kode_customer.unique' => 'Kode customer duplikat, mohon isi kembali dengan kode yang berbeda'
        ];
        $validator = Validator::make($request->all(), [
            'kode_customer'=> 'required|unique:customer',
            'nama_customer' => 'required|alpha_num'
        ], $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($messages)->withInput($request->all());
        }
        $customer = Customer::find($id);
        $customer->kode_customer = $request->input('kode_customer');
        $customer->nama_customer = $request->input('nama_customer');
        $customer->address = $request->input('address');
        $customer->kota = $request->input('kota');
        $customer->save();

        return \redirect('customer')->with('success', 'Ubah data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return \redirect('customer')->with('success', 'Delete data berhasil');
    }
}
