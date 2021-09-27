@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                    Detail Buku
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-center">
                        <h3 class="text-center"><i class="fas fa-book"></i> {{$data['judul_buku']}}</h3>
                        <img src="{{asset('storage/image-buku/'. $data['image'])}}" alt="buku" width="150rem" class="">
                    </div>
                    <br><br><br>
                    <div class="table-responsive">
                        <table  class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{$data['desc']}}</td>
                                </tr>
                                </tr>
                                    <th>Pengarang</th>
                                    <td>{{$data['pengarang']}}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{$data['stok']}}</td>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/ba130e3515.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>

    @if (Session::has('pesan'))
         <input type="hidden" value="{{ Session::get('pesan') }}" id="session">
    <script>
        let sessionData = document.getElementById('session').value;

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text:  sessionData,
         })
    </script> 
    @endif
   
@endsection
