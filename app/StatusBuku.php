<?php

namespace App;
use App\Buku;
use App\User;

use Illuminate\Database\Eloquent\Model;

class StatusBuku extends Model
{
    protected $table = 'status_buku';

    protected $guarded = [];

    public function statusBuku(){
        return $this->belongsToMany(Buku::class, 'status_buku','buku_id', 'user_id');
    }

    public function statusUser(){
        return $this->belongsToMany(User::class, 'status_buku','buku_id', 'user_id');
    }
}
