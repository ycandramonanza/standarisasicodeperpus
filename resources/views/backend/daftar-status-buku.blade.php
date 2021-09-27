@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    List Riwayat Buku
                </div>
                <div class="panel-body">
                    @if ($data == false)
                    <div class="respone-image text-center">
                            <img src="{{asset('image/empty/empty.png')}}" alt="" width="100rem" >
                    </div>
                    @endif
                    @if ($data == true)
                    <div class="table-responsive">
                        <table id="myTable" class="display"   >
                            <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Kode Pinjaman</th>
                                        <th>Judul Buku</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Status Buku</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        @if ($data[0]->status == 'Dalam Pengajuan')
                                        <th>Approve</th>
                                        <th>Cancel</th>
                                        @endif
                                        @if ($data[0]->status == 'Di Setujui')
                                        <th>Pengembalian</th>
                                        <th>Return</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($data as $item)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->kode_pinjaman}}</td>
                                            <td>{{$item->statusBuku->judul_buku}}</td>
                                            <td>{{$item->jumlah_pinjaman}}  Buku</td>
                                            <td>{{$item->status}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->created_at->format('H:i')}}wib</td>

                                            @if ($item->status == 'Dalam Pengajuan')
                                            <td>
                                                <a href="{{route('approve_admin', $item->id)}}" class="btn btn-success"><i class="fas fa-check-circle"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{route('cancel_admin', $item->id)}}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                                            </td>
                                            @endif
                                            @if ($item->status == 'Di Setujui')
                                            <td>
                                                {{$item->expired_date->format('d-M-Y')}}
                                            </td>
                                            <td>
                                                <a href="{{route('status.return_user', $item->id)}}" class="btn btn-info"><i class="fas fa-undo-alt"></i></a>
                                            </td>
                                            @endif
                                    </tr> 
                                 @endforeach   
                            </tbody>
                        </table>
                    </div>
                    @endif
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Data Table --}}
    <script>
        $(document).ready( function () {
                $('#myTable').DataTable();
        } );
    </script> 


    {{-- Sweet Alert Approve --}}
    @if (Session::has('approve'))
        <input type="hidden" value="{{ Session::get('approve') }}" id="session">
        <script>
        let sessionData = document.getElementById('session').value;

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: sessionData,
            showConfirmButton: false,
            timer: 3000
        })
    </script> 
    @endif

    {{-- Sweet Alert Cancel --}}
    @if (Session::has('cancel'))
    <input type="hidden" value="{{ Session::get('cancel') }}" id="session">
    <script>
    let sessionData = document.getElementById('session').value;

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: sessionData,
        showConfirmButton: false,
        timer: 3000
    })
    </script> 
    @endif


    {{-- Sweet Alert Return --}}
    @if (Session::has('return'))
    <input type="hidden" value="{{ Session::get('return') }}" id="session">
    <script>
    let sessionData = document.getElementById('session').value;

    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: sessionData,
        showConfirmButton: false,
        timer: 3000
    })
    </script> 
    @endif

   
@endsection
