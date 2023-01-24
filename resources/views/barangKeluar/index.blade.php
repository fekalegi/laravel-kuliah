@extends('layout')
@section('custom-js-css')

    <link href="{{ asset('/plugins/datatables-
bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"

          type="text/css" />

    <link href="{{ asset('/plugins/datatables-
responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"

          type="text/css" />
    <!-- BUTTONS BOOTSTRAP -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap4.m
in.css"/>
    <!-- RENDER BUTTONS BOOTSTRAP -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"><
/script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.
js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js
"></script>
    <script type="text/javascript" src="{{
asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/plugins/datatables-
bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/plugins/datatables-
responsive/js/dataTables.responsive.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/plugins/datatables-
responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- RENDER BUTTONS BOOTSTRAP -->
    <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min
.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap4.min
.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js">
    </script><script>
        jQuery(function($) {
            var myTable = $('#dt-penjualan').DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                scrollX: true,
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf']
            });
        });
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('barangKeluar/create')}}">
                                <button type="button" class="btn btn-dark">Add New</button>
                            </a>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <table id='dt-penjualan' class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah Barang</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($listBarangKeluar as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->no_transaksi }}</td>
                                    <td>{{ $value->tanggal }}</td>
                                    <td>{{ $value->nama_customer }}</td>
                                    <td>{{ $value->nama_produk }}</td>
                                    <td>{{ $value->jumlah_barang }}</td>
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

    <script>
        jQuery(function($) {
            var myTable = $('#dt-penjualan').DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                scrollX: true,
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf']
            });
        });
    </script>
@endsection


