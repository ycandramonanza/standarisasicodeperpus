<?php

namespace App;
use App\Buku;
use App\User;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class StatusBuku extends Model
{
    protected $table = 'status_buku';

    protected $guarded = [];

    public function statusBuku(){
        return $this->belongsTo(Buku::class, 'buku_id','id');
    }

    public function statusUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getExpiredDateAttribute(){
        $tglPinjam = new Carbon($this->created_at);
        return $tglPinjam->addDays(7);
    }
}
