<?php

namespace App\Repositories;
use App\User;
use App\Buku;
use Auth;

class UserRepository{

    public function getDataLogin(){
         return  $roleRepo = Auth::user()->role;
    }


}

?>