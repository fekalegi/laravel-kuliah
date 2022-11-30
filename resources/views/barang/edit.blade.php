@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/barang') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('barang/'.$detail->id)}}">
                            @csrf
                            @method('PUT')
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="name" class="required">Kode Barang</label>
                                @error('name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="hidden" class="form-control" id="code" name="code"  value={{$detail->id}}>
                                <input type="text" class="form-control" id="code" name="code"  placeholder="Masukkan kode barang" value={{$detail->code}} required>

                                <label for="name" class="required">Nama Barang</label>
                                @error('name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="name" name="name"  placeholder="Masukkan nama barang" value={{$detail->name}} required>

                                <label for="deskripsi" class="required">Deskripsi</label>
                                @error('deskripsi')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi barang" value={{$detail->deskripsi}} required>

                                <label for="stok">Stok</label>
                                @error('stok')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan stok barang" name="stok" value={{$detail->stok}} id="stok">

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
