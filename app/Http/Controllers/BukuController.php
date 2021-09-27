<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Buku;
use App\Repositories\Backend\BukuRepository;
use App\Http\Requests\BukuRequest;
use Session;
use Carbon\Carbon;

class BukuController extends Controller
{

    protected $bukuRepo;
    public function __construct()
    {
        $this->bukuRepo = new BukuRepository;
    }


    public function bukuCreate(Buku $id)
    {
        return view('backend.create-buku', compact('id'));
    }


    public function bukuStore(BukuRequest $request, $id = null)
    {

        $data = $this->bukuRepo->storeDataBuku($request, $id);
        if($data['status'] == false){
            $request->session()->flash('false', $data['message']);
            return redirect()->route('home');
        }else{
            $request->session()->flash('true', $data['message']);
            return redirect()->route('home');
        }
    }


    public function bukuDelete(Buku $id)
    {
        $data    = $this->bukuRepo->delete($id);
        $message = $data['message'];
        return redirect('/home')->with('delete', $message);
    }


    public function bukuShow(Buku $id){
//            $id->expired_date
        $data    = $this->bukuRepo->findId($id);
        $timeNow = Carbon::now()->format('d-M-Y');
        $timeExp = Carbon::now()->addDay(7)->format('d-M-Y');

        return view('frontend.show-buku', compact('data', 'timeNow', 'timeExp'));
    }


    public function bukuShowAdmin(Buku $id)
    {
        $data    = $this->bukuRepo->findId($id);
        return view('Backend.show-buku', compact('data'));
    }

    public function bukuTrack(Buku $id)
    {
       $dataBuku = $this->bukuRepo->track($id);

       return view('backend.track-buku', compact('dataBuku'));
    }


}
