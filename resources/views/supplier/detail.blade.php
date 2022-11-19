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
                        <p></p>
                        <p></p>



                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Code</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['code']) ? $detail['code'] : 'Item code tidak ada' }}</p>
                            </div><div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Nama</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['name']) ? $detail['name'] : 'Item name tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Alamat</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['alamat']) ? $detail['alamat'] : 'Item alamat tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Nama Kota</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['nama_kota']) ? $detail['nama_kota'] : 'Item nama_kota tidak ada' }}</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
