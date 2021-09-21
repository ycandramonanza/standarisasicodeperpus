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
                    Dashboard Anggota
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="text-center"><i class="fas fa-book"></i> Data Anggota </h3>
                    <br><br><br>
                    <div class="table-responsive">
                        <table id="myTable" class="display"   >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Limit Kuota Peminjaman</th>
                                    <th>Brgabung Sejak</th>
                                    <th>Nonaktifkan Akun</th>
                                    <th>Hapus Akun</th>
                              
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($data as $item)
                                 <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->kategori}}</td>
                                    <td>{{$item->judul_buku}}</td>
                                    <td>
                                        <a href="{{route('buku.create_admin', $item->id)}}" class="btn btn-danger rounded"><i class="fas fa-ban"></i></a>
                                        
                                    </td>
                                    
                                    <td>
                                        <form action="{{route('buku.delete_admin', $item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('delete')}}
                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                            </button>
                                         </form>
                                    </td>
                               
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
    <script>
            var addBuku   = document.getElementById('AddBuku');
            var buttonAdd = document.getElementById('Add');

            buttonAdd.addEventListener('click', function(){

                    addBuku.remove()
                   
            })
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>  
    <script src="https://kit.fontawesome.com/ba130e3515.js" crossorigin="anonymous"></script>
    <script>
            $(document).ready( function () {
                    $('#myTable').DataTable();
            } );
    </script> 
@endsection
