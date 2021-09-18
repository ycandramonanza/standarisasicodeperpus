<?php

namespace App;
use App\StatusBuku;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $guarded = [];

    
    public function buku(){
        return $this->hasMany(StatusBuku::class, 'buku_id', 'id');
    }
}
