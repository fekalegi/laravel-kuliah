@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/produk') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('produk')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="name" class="required">Kode Produk</label>
                                @error('kode_produk')
                                @if($errors->has('kode_produk'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('kode_produk') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                                       placeholder="Masukkan kode produk" required>
                                <label for="name" class="required">Nama Produk</label>
                                @error('nama_produk')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                       placeholder="Masukkan nama produk" required>
                                <label for="stok" class="required">Stok</label>
                                @error('stok')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan stok produk" name="stok"
                                       id="stok">
                                <label for="harga">Harga</label>
                                @error('harga')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan harga" name="harga"
                                       id="harga">
                            </div>
                            <button type="submit" class="form-control btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js-css')
    <script>
        function validasi(data) {
            if (data < 0) {
                alert('Data input tidak boleh kurang dari 0');
            }
        }

        jQuery(function ($) {
        });
    </script>
@endsection
