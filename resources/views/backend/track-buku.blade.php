@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row">
        @if (session('true'))
            <div class="alert alert-success">
                {{ session('true') }}
            </div>
        @endif
        @if (session('false'))
            <div class="alert alert-danger">
                {{ session('false') }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Track Buku</h3>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        @foreach($dataBuku as $data)
                    <h3 class="text-center"><i class="fas fa-book"></i> Buku <b>{{$data->statusBuku->judul_buku}}</b> </h3>
                            @break;
                        @endforeach
                    <br><br><br>
                    <div class="table-responsive">
                        <table id="myTable" class="display"   >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Nama Peminjam</th>
                                    <th>Status</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Expired</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($dataBuku as $data)
                                 <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->kode_pinjaman}}</td>
                                    <td>{{$data->statusUser->name}}</td>
                                    <td>{{$data->status}}</td>
                                     <td>{{$data->created_at->format('d-M-Y')}}</td>
                                    <td>{{$data->expired_date->format('d-M-Y')}}</td>
                                </tr> 
                                 @endforeach   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>  
    <script src="https://kit.fontawesome.com/ba130e3515.js" crossorigin="anonymous"></script>
    <script>
            $(document).ready( function () {
                    $('#myTable').DataTable();
            } );
    </script> 
@endsection
