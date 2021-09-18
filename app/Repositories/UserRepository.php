<?php

namespace App\Repositories;
use App\User;
use App\Buku;
use Auth;

class UserRepository{


    // Fungsi Login Ketika Ada Bug saat login, Catch menotifikasi bahwa sistem sedang maintenance;
    public function getDataLogin(){

         $result =["status" => false, "message" => ""];
 
         try {
             $roleRepo = Auth::user()->role;
             $result['status'] = true;
             $result['message'] = $roleRepo;
             return $result;
         } catch (\Throwable $th) {
                $result["message"] = "Sistem Sedang Maintenance";
                return $result;
         }
   
    }


}

?>