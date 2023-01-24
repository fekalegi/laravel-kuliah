@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('barangMasuk/create')}}">
                                <button type="button" class="btn btn-dark">Add New</button>
                            </a>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Harga Barang</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($listBarangMasuk as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->no_transaksi }}</td>
                                    <td>{{ $value->tanggal }}</td>
                                    <td>{{ $value->nama_vendor }}</td>
                                    <td>{{ $value->nama_produk }}</td>
                                    <td>{{ $value->jumlah_barang }}</td>
                                    <td>Rp. @convert($value->harga_barang)</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection

