<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    private $listItem = [
        ['code' => 'Spl_1', 'name' => 'Supplier 1', 'alamat' => 'Jakarta Raya', 'nama_kota' => 'Jakarta'],
        ['code' => 'Spl_2', 'name' => 'Supplier 2', 'alamat' => 'Jakarta Raya', 'nama_kota' => 'Bandung'],
        ['code' => 'Spl_3', 'name' => 'Supplier 3', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Spl_5', 'name' => 'Supplier 5', 'alamat' => 'Surabaya Selatan', 'nama_kota' => 'Surabaya'],
        ['code' => 'Spl_6', 'name' => 'Supplier 6', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Spl_7', 'name' => 'Supplier 7', 'alamat' => 'Bekasi Barat', 'nama_kota' => 'Bekasi'],
        ['code' => 'Spl_8', 'name' => 'Supplier 8', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung'],
        ['code' => 'Spl_9', 'name' => 'Supplier 9', 'alamat' => 'Tangerang Selatan', 'nama_kota' => 'Tangerang'],
        ['code' => 'Spl_10', 'name' => 'Supplier 10', 'alamat' => 'Bandung Selatan', 'nama_kota' => 'Bandung']
    ];

    public function index()
    {
        $listFromSession = session()->get('supplier');
        if (!$listFromSession) {
            $listItem = $this->listItem;
        } else {
            $listItem = $listFromSession;
        }
        return view('supplier.index', compact('listItem'));
    }

    public function detail($code)
    {
        $listFromSession = session()->get('supplier');
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
        return view('supplier.detail', compact('detail'));
    }

    public function add(Request $request)
    {
        // Start validation
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'nama_kota' => 'required',
        ]);

        $listFromSession = session()->get('supplier');
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
            'code' => 'Spl_' . strval($newCode),
            'name' => $request->name,
            'alamat' => $request->alamat,
            'nama_kota' => $request->nama_kota,
        ];

        $listItem->push($item);
        $request->session()->put('supplier', $listItem);

        return Redirect::to('/supplier');
    }
}
