<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PelangganController extends Controller
{
    private $listItem = [
        ['code' => 'Plg_1', 'name' => 'Pelanggan 1', 'alamat' => 'Jakarta Raya', 'nama_kota' => 'Jakarta'],
        ['code' => 'Plg_2', 'name' => 'Pelanggan 2', 'alamat' => 'Jakarta Raya', 'nama_kota' => 'Bandung'],
        ['code' => 'Plg_3', 'name' => 'Pelanggan 3', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Plg_4', 'name' => 'Pelanggan 4', 'alamat' => 'Bekasi Barat', 'nama_kota' => 'Bekasi'],
        ['code' => 'Plg_5', 'name' => 'Pelanggan 5', 'alamat' => 'Jakarta Raya', 'nama_kota' => 'Jakarta'],
        ['code' => 'Plg_6', 'name' => 'Pelanggan 6', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Plg_7', 'name' => 'Pelanggan 7', 'alamat' => 'Bekasi Barat', 'nama_kota' => 'Bekasi'],
        ['code' => 'Plg_8', 'name' => 'Pelanggan 8', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Plg_9', 'name' => 'Pelanggan 9', 'alamat' => 'Tangerang Selatan', 'nama_kota' => 'Tangerang'],
        ['code' => 'Plg_10', 'name' => 'Pelanggan 10', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung']
    ];

    public function index()
    {
        $listFromSession = session()->get('pelanggan');
        if (!$listFromSession) {
            $listItem = $this->listItem;
        } else {
            $listItem = $listFromSession;
        }
        return view('pelanggan.index', compact('listItem'));
    }

    public function detail($code)
    {
        $listFromSession = session()->get('pelanggan');
        if (!$listFromSession) {
            $listItem = $this->listItem;
        } else {
            $listItem = $listFromSession;
        }

        $collection = collect($listItem);

        $data = $collection->firstWhere('code', $code);

        $detail = [
            'code' => $code,
            'name' => $data['name'],
            'alamat' => $data['alamat'],
            'nama_kota'=>$data['nama_kota'],
        ];
        return view('pelanggan.detail', compact('detail'));
    }

    public function add(Request $request)
    {
        // Start validation
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nama_kota' => 'required',
        ]);

        $listFromSession = session()->get('pelanggan');
        if (!$listFromSession) {
            $listItem = collect($this->listItem);
        } else {
            $listItem = collect($listFromSession);
        }

        $lastItem = $listItem->last();
        // Remove all string to get the code number
        $lastCode = preg_replace('/[^0-9]/', '', $lastItem['code']);

        // Increment last code to get new code for new item
        $newCode = (int)$lastCode + 1;

        $item = [
            'code' => 'Plg_' . strval($newCode),
            'name' => $request->name,
            'alamat' => $request->alamat,
            'nama_kota' => $request->nama_kota,
        ];

        $listItem->push($item);
        $request->session()->put('pelanggan', $listItem);

        return Redirect::to('/pelanggan');
    }
}
