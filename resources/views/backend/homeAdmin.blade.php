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
                    Dashboard Admin
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('buku.create_admin')}}" class="btn btn-primary" id="Add">Add Buku [+]</a>
                    <h3 class="text-center"><i class="fas fa-book"></i> Data Buku </h3>
                    <br><br><br>
                    <div class="table-responsive">
                        <table id="myTable" class="display"   >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Buku</th>
                                    <th>Kategori</th>
                                    <th>Judul Buku</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    <th>Pengarang</th>
                                    <th>Aksi</th>
                                    <th>Aksi</th>
                              
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($dataBuku as $data)
                                 <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->kode_buku}}</td>
                                    <td>{{$data->kategori}}</td>
                                    <td>{{$data->judul_buku}}</td>
                                    <td>{{substr($data->desc,0,100)}}..</td>
                                    <td>{{$data->stok}}</td>
                                    <td>{{$data->pengarang}}</td>
                                    <td>
                                        <a href="{{route('buku.create_admin', $data->id)}}" class="btn btn-success rounded"><i class="far fa-edit"></i></a>
                                        
                                    </td>
                                    
                                    <td>
                                        <form action="{{route('buku.delete_admin', $data->id)}}" method="POST">
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
