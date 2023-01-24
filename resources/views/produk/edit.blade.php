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
                        <form method="POST" action="{{url('produk/'.$detail->id)}}">
                            @csrf
                            @method('PUT')
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="kode_produk" class="required">Kode Produk</label>
                                @error('kode_produk')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="hidden" class="form-control" id="kode_produk" name="kode_produk"  value={{$detail->kode_produk}}>
                                <input type="text" class="form-control" id="kode_produk" name="kode_produk"  placeholder="Masukkan kode produk" value={{$detail->kode_produk}} required>

                                <label for="nama_produk" class="required">Nama Produk</label>
                                @error('nama_produk')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"  placeholder="Masukkan nama produk" value={{$detail->nama_produk}} required>

                                <label for="stok">Stok</label>
                                @error('stok')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan stok produk" name="stok" value={{$detail->stok}} id="stok">

                                <label for="harga">Harga</label>
                                @error('harga')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan harga" name="harga" id="harga" value={{$detail->harga}}>

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
