@extends('layout')
@section('content')
    @push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/barangMasuk') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('barangMasuk')}}">
                            @csrf
                            <h1>Form Insert</h1>
                            <div class="form-group">
                                <label for="no_transaksi" class="required">No Transaksi</label>
                                @error('no_transaksi')
                                @if($errors->has('no_transaksi'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('no_transaksi') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="no_transaksi" name="no_transaksi"
                                       placeholder="Masukkan No Transaksi" required>

                                <label for="tanggal" class="required">Tanggal Transaksi</label>
                                @error('tanggal')
                                @if($errors->has('tanggal'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('tanggal') }}</strong>
                                </span>
                                @endif
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="datetime-local" class="form-control" placeholder="Pilih Tanggal" name="tanggal">

                                <label for="name" class="required">Vendor</label>
                                @error('kode_vendor')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                {{ Form::select('kode_vendor',$vendor, null,['class' => 'form-control','placeholder'=> '-- Pilih --']) }}

                                <label for="name" class="required">Barang</label>
                                @error('kode_produk')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                {{ Form::select('kode_produk',$produk, null,['class' => 'form-control','placeholder'=> '-- Pilih --']) }}

                                <label for="alamat" class="required">Jumlah Barang</label>
                                @error('jumlah_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan Jumlah Barang" name="jumlah_barang"
                                       id="jumlah_barang">

                                <label for="alamat" class="required">Harga Barang</label>
                                @error('harga_barang')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="number" class="form-control" placeholder="Masukkan Harga Barang" name="harga_barang"
                                       id="harga_barang">
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endpush
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
