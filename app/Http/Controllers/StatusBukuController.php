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


    public function statusRiwayatAll()
    {
        
        $datas      = $this->statusBukuRepo->statusRiwayatBuku();
        $data       = $datas['message']->all();
        

        return view('frontend.riwayatStatusBuku', compact('data'));
    }


    public function statusRiwayatPengajuan()
    {
        $request    = 'Dalam Pengajuan';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('frontend.riwayatStatusBukuDetail', compact('data'));


    }


    public function statusRiwayatPeminjaman()
    {
        $request    = 'Di Setujui';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('frontend.riwayatStatusBukuDetail', compact('data'));
    }


    public function statusRiwayatPembatalan()
    {
        $request    = 'Di Batalkan';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('frontend.riwayatStatusBukuDetail', compact('data'));
    }


    public function statusBukuCreate(Request $request, $id = null)
    {
       
        $data        = $this->statusBukuRepo->statusBuku($request, $id);
        $message     = $data['message'];

       // Kondisi ketika jumlah Pinjaman Buku 0
       if($message == 'Null Request'){

            $message    = 'Jumlah Buku Tidak Boleh Kosong !';
            return redirect()->back()->with('pesan', $message);

       }else if($message == 'Limit Kuota')
       {
            $message    = 'Melebihi Batas Kuota !';
            return redirect()->back()->with('pesan', $message);

       }else if($message == 'Limit Request')
       {
            $message    = 'Tidak Boleh Melebihi Batas Kuota !';
            return redirect()->back()->with('pesan', $message);
       }


        return redirect()->route('status.riwayat_user');
    }



    public function daftarPengajuan(){

        $request    = 'All Data';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('backend.daftarStatusBuku', compact('data'));
    }


    public function approve(StatusBuku $id = null){

        $datas   = $this->statusBukuRepo->statusApprove($id);
        $message = $datas['message'];
        return redirect()->back()->with('approve', $message);

    }


    public function cancel(StatusBuku $id = null){
        $datas   = $this->statusBukuRepo->statusCancel($id);
        $message = $datas['message'];
        return redirect()->back()->with('cancel', $message);
    }


    public function statusReturn(StatusBuku $id = null){

        $datas   = $this->statusBukuRepo->statusReturn($id);
        $message = $datas['message'];
        return redirect()->back()->with('return', $message);
    }

    

    public function daftarPeminjaman(){
        
        $request    = 'Di Setujui';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('backend.daftarStatusBuku', compact('data'));

    }

    public function daftarPembatalan(){

        $request    = 'Di Batalkan';
        $datas      = $this->statusBukuRepo->statusRiwayatBuku($request);
        $data       = $datas['message']->all();
        return view('backend.daftarStatusBuku', compact('data'));

    }

  

}
