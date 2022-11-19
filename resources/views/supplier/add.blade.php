@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/supplier') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/supplier/post')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="name" class="required">Nama Supplier</label>
                                @error('name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="name" name="name"  placeholder="Masukkan nama supplier" required>
                                <label for="alamat" class="required">Alamat</label>
                                @error('alamat')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat supplier" required>
                                <label for="nama_kota">Nama Kota</label>
                                @error('nama_kota')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan nama_kota supplier" name="nama_kota" id="nama_kota">
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
