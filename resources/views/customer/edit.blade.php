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
                        <form method="POST" action="{{url('customer/'.$detail->id)}}">
                            @csrf
                            @method('PUT')
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="kode_customer" class="required">Kode Customer</label>
                                @error('kode_customer')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="hidden" class="form-control" id="kode_customer" name="kode_customer"  value={{$detail->kode_customer}}>
                                <input type="text" class="form-control" id="kode_customer" name="kode_customer"  placeholder="Masukkan kode customer" value={{$detail->kode_customer}} required>

                                <label for="nama_customer" class="required">Nama Customer</label>
                                @error('nama_customer')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="nama_customer" name="nama_customer"  placeholder="Masukkan nama customer" value={{$detail->nama_customer}} required>

                                <label for="address">Address</label>
                                @error('address')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan address customer" name="address" value={{$detail->address}} id="address">

                                <label for="kota">Kota</label>
                                @error('kota')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" placeholder="Masukkan kota" name="kota" id="kota" value={{$detail->kota}}>

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
