@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/customer') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('customer')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="kode_customer" class="required">Kode Customer</label>
                                @error('kode_customer')
                                @if($errors->has('kode_customer'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('kode_customer') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="kode_customer" name="kode_customer"
                                       placeholder="Masukkan kode customer" readonly required value={{$kode_customer}}>
                                <label for="name" class="required">Nama Customer</label>
                                @error('nama_customer')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                                       placeholder="Masukkan nama customer" required>
                                <label for="address" class="required">Address</label>
                                @error('address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan address customer" name="address"
                                       id="address">
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
