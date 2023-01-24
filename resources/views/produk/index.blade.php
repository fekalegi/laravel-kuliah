@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('produk/create')}}">
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
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($listProduk as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->kode_produk }}</td>
                                    <td>{{ $value->nama_produk }}</td>
                                    <td>{{ $value->stok }}</td>
                                    <td>Rp. @convert($value->harga)</td>
                                    <td>
                                        <a href="{{url('produk/'.$value->id) }}">
                                            <button type="button" class="btn btn-dark">View
                                            </button>
                                        </a>
                                        <a href="{{url('produk/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-dark">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('produk/'.$value->id)}}>
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-dark">Delete
                                            </button>
                                        </form>
                                    </td>
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

