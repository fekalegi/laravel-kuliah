<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BarangController extends Controller
{
    private $listItem = [
        ['code' => 'Brg_1', 'name' => 'Barang 1', 'deskripsi' => 'Barang Dagangan 1', 'stok' => '10', 'harga' => '127000'],
        ['code' => 'Brg_2', 'name' => 'Barang 2', 'deskripsi' => 'Barang Dagangan 2', 'stok' => '20', 'harga' => '178000'],
        ['code' => 'Brg_3', 'name' => 'Barang 3', 'deskripsi' => 'Barang Dagangan 3', 'stok' => '33', 'harga' => '188000'],
        ['code' => 'Brg_4', 'name' => 'Barang 4', 'deskripsi' => 'Barang Dagangan 4', 'stok' => '56', 'harga' => '199990'],
        ['code' => 'Brg_5', 'name' => 'Barang 5', 'deskripsi' => 'Barang Dagangan 5', 'stok' => '25', 'harga' => '188000'],
        ['code' => 'Brg_6', 'name' => 'Barang 6', 'deskripsi' => 'Barang Dagangan 6', 'stok' => '14', 'harga' => '188000'],
        ['code' => 'Brg_7', 'name' => 'Barang 7', 'deskripsi' => 'Barang Dagangan 7', 'stok' => '66', 'harga' => '188000'],
        ['code' => 'Brg_8', 'name' => 'Barang 8', 'deskripsi' => 'Barang Dagangan 8', 'stok' => '22', 'harga' => '188000'],
        ['code' => 'Brg_9', 'name' => 'Barang 9', 'deskripsi' => 'Barang Dagangan 9', 'stok' => '33', 'harga' => '188000'],
        ['code' => 'Brg_10', 'name' => 'Barang 10', 'deskripsi' => 'Barang Dagangan 10', 'stok' => '33', 'harga' => '188000']];

    public function index()
    {
        $listFromSession = session()->get('barang');
        if (!$listFromSession) {
            $list = collect($this->listItem);
        } else {
            $list = collect($listFromSession);
        }

        $listItem = $list->where('stok', '>', '15');

        return view('barang.index', compact('listItem'));
    }

    public function detail($code)
    {
        $listFromSession = session()->get('barang');
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
            'deskripsi' => $data['deskripsi'],
            'stok'=>$data['stok'],
            'harga'=>$data['harga']
        ];
        return view('barang.detail', compact('detail'));
    }

    public function add(Request $request)
    {
        // Start validation
        $request->validate([
            'name' => 'required',
            'deskripsi' => 'required',
            'stok' => 'integer',
            'harga' => 'integer'
        ]);

        $listFromSession = session()->get('barang');
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
            'code' => 'Brg_' . strval($newCode),
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ];

        $listItem->push($item);
        $request->session()->put('barang', $listItem);

        return Redirect::to('/barang');
    }
}
