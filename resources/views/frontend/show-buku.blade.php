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
                    Dashboard User
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Note : Limit Kuota Peminjaman Kamu Tersisa <u><b style="font-size:20px" class="text-danger">{{Auth::user()->limit_pinjam}}</b></u>  Buku</p>

                    <div class="text-center">
                        <h3 class="text-center"><i class="fas fa-book"></i> {{$data['judul_buku']}}</h3>
                        <img src="{{asset('storage/image-buku/'. $data['image'])}}" alt="buku" width="150rem" class="">
                    </div>
                   
                    <br><br><br>
                    <form action="{{route('status.buku_user', $data['id'])}}" method="POST">
                        {{ csrf_field() }}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                        <label for="">Masukan Jumlah Buku : </label>
                                        <input style="width: 10rem" type="number" name="jumlah_pinjaman" class="form-control" placeholder="Max:5">
                                </tr>
                            </thead>
                            <br><br><br>
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
                                <tr>
                                    <th>Tanggal Peminjaman</th>
                                    <td>{{$timeNow}}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengembalian</th>
                                    <td>{{$timeExp}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="simpan">
                            <button type="submit" onclick="return confirm('Apakah kamu yakin ingin meminjam buku ini ?')" class="btn btn-block btn-info rounded"><i class="fas fa-book-open"></i> Pinjam Buku</button>
                        </div>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
   
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/ba130e3515.js" crossorigin="anonymous"></script>

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
