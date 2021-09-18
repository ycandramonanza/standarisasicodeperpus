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
                    Status Riwayat
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table id="myTable" class="display"   >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Status Buku</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($data as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->kode_pinjaman}}</td>
                                        <td>{{$item->jumlah_pinjaman}}  Buku</td>
                                        <td>{{$item->status}}</td>
                                        <td>{{$item->created_at->format('d-M-Y')}}</td>
                                        <td>{{$item->created_at->format('H:i')}} wib</td>
                                    </tr> 
                                 @endforeach   
                            </tbody>
                        </table>
                    </div>
                   
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Cari Kode Pinjaman
                </div>
                <div class="panel-heading">
                    <h5>
                         <input type="text" class="form-control" style="width: 20rem; float: left;"> 
                         <button class="btn btn-info">Cari</button>
                    </h5>
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Buku</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr>
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
