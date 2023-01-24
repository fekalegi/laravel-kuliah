@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-add-new">
                            <a href="{{url('customer/create')}}">
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
                                <th scope="col">Kode Customer</th>
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
                            @foreach($listCustomer as $key => $value)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $value->kode_customer }}</td>
                                    <td>{{ $value->nama_customer }}</td>
                                    <td>{{ $value->alamat }}</td>
                                    <td>{{ $value->kota }}</td>
                                    <td>
                                        <a href="{{url('customer/'.$value->id) }}">
                                            <button type="button" class="btn btn-dark">View
                                            </button>
                                        </a>
                                        <a href="{{url('customer/'.$value->id) .'/edit'}}">
                                            <button type="button" class="btn btn-dark">Edit
                                            </button>
                                        </a>
                                        <form method="POST" action={{url('customer/'.$value->id)}}>
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

