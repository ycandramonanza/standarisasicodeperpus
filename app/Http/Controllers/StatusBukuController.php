<?php

namespace App\Http\Controllers;
use App\Buku;
use App\StatusBuku;
use App\Repositories\Backend\StatusBukuRepository;


use Illuminate\Http\Request;

class StatusBukuController extends Controller
{

    protected $statusBukuRepo;
    public function __construct(){
        $this->statusBukuRepo = new StatusBukuRepository;
    }


    public function statusRiwayat(){
        $datas      = $this->statusBukuRepo->statusRiwayatBuku();
        $data       = $datas['message'];
  
        return view('frontend.riwayatStatusBuku', compact('data'));
    }


    public function statusBukuCreate(Request $request, $id = null){
       
        $data = $this->statusBukuRepo->statusBuku($request, $id);
        
        return redirect()->route('status.riwayat_user');
    }
}
