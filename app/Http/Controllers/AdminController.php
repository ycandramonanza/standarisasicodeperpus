<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class AdminController extends Controller
{
    
    public function bukuIndex(){
        return view('backend.createBuku');
    }
}
