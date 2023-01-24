@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('vendor/create')}}">
                                <button type="button" class="btn btn-dark">Add New</button>
                            </a>
                        </div>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Vendor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1
                            ?>
                            @foreach($listVendor as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->kode_vendor }}</td>
                                    <td>{{ $value->nama_vendor }}</td>
                                    <td>{{ $value->alamat }}</td>
                                    <td>{{ $value->kota }}</td>
                                    <td>
                                        <a href="{{url('vendor/'.$value->id) }}">
                                            <button type="button" class="btn btn-dark">View
                                            </button>
                                        </a>
                                        <a href="{{url('vendor/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-dark">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('vendor/'.$value->id)}}>
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-dark">Delete
                                            </button>
                                        </form>
                                    </td>
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
@endsection

