@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Buku</div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($id))
                    <form action="{{route('buku.store_admin', $id->id)}}" method="POST" enctype="multipart/form-data">
                    @endif

                    <form action="{{route('buku.store_admin')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="kode_buku" class="form-label">Kode Buku</label>
                            <input type="text" class="form-control" name="kode_buku" id="kode_buku" placeholder="Masukan Kode Buku" value="{{isset($id) ? $id->kode_buku : old('kode_buku')}}">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Masukan Kategori" value="{{isset($id) ? $id->kategori : old('kategori')}}">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="judul_buku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" id="judul_buku" placeholder="Masukan Judul Buku" value="{{isset($id) ? $id->judul_buku : old('judul_buku')}}">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="desc" id="desc" rows="3" placeholder="Masukan Deskripsi..">{{isset($id) ? $id->desc : old('desc')}}</textarea>
                        </div> 
                        <br>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" name="stok" id="stok" placeholder="Masukan Stok Buku" value="{{isset($id) ? $id->stok : old('stok')}}">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Masukan Nama Pengarang" value="{{isset($id) ? $id->pengarang : old('pengarang')}}">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="image" class="form-label">Tambah Gambar</label>
                            <input type="file" class="form-control" name="image" id="image" value="{{asset('storage/image-buku/'.$id->image)}}">
                        </div>
                        <br>
                        @if ($id->image)
                        <div class="div">
                            <img src="{{asset('storage/image-buku/'.$id->image)}}" alt="" width="150rem">
                        </div>
                        @endif
                        <br><br>
                        <div class="mb-3">
                            <button class="btn btn-primary">Simpan Buku <i class="far fa-save"></i> </button>
                        </div>    
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js') 
    <script src="https://kit.fontawesome.com/ba130e3515.js" crossorigin="anonymous"></script>
@endsection