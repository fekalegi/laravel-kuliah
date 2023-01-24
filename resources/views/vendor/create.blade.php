@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/vendor') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('vendor')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="kode_vendor" class="required">Kode Vendor</label>
                                @error('kode_vendor')
                                @if($errors->has('kode_vendor'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('kode_vendor') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="kode_vendor" name="kode_vendor"
                                       placeholder="Masukkan kode vendor" readonly required value={{$kode_vendor}}>
                                <label for="name" class="required">Nama Vendor</label>
                                @error('nama_vendor')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor"
                                       placeholder="Masukkan nama vendor" required>
                                <label for="alamat" class="required">Alamat</label>
                                @error('alamat')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan alamat vendor" name="alamat"
                                       id="alamat">
                                <label for="kota">Kota</label>
                                @error('kota')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan kota" name="kota"
                                       id="kota">
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
