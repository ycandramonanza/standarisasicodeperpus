<?php

namespace App;
use App\StatusBuku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = ['kode_buku', 'kategori', 'judul_buku', 'desc', 'stok', 'pengarang', 'image', 'slug'];

    
    public function buku(){
        return $this->hasMany(StatusBuku::class, 'buku_id', 'id');
    }


}
