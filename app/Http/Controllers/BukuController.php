<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Repositories\Backend\BukuRepository;
use App\Http\Requests\BukuRequest;
use Session;

class BukuController extends Controller
{

    protected $bukuRepo;
    public function __construct(){
        $this->bukuRepo = new BukuRepository;
    }


    public function bukuCreate(Buku $id)
    {
        $result = $id;
        return view('backend.createBuku', compact('result'));

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
        $data = $this->bukuRepo->deleteDataBuku($id);

        return redirect('/home')->with('true', $data['message']);
    }



    public function bukuShow(Buku $id){
        
            $datas = $this->bukuRepo->findId($id);
            $data  = $datas['message'];

            return view('frontend.showBuku', compact('data'));
    }
}
