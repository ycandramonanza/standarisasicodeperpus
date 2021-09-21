<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{






    public function indexAnggota(){
        
        $data = User::where('role', 'User')->orderBy('id', 'DESC')->get();

        return view('backend.daftarAnggota', compact('data'));

    }
}
