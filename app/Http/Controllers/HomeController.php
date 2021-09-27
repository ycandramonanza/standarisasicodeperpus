<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\Backend\BukuRepository;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRepo;
    protected $bukuRepo;
    public function __construct()
    {
        $this->middleware('auth');
        $this->userRepo = new UserRepository;
        $this->bukuRepo = new BukuRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // getDataRoleRepo
        $dataLogin = $this->userRepo->getDataLogin();
      
        // getDataBukuRepoAdmin
        $dataBuku = $this->bukuRepo->getDataBuku();

        // $dataBuku


        // branching login according to role
        if($dataLogin == 'Admin'){
            return view('backend/home-admin', compact('dataBuku'));
        }else if($dataLogin == 'User'){
            return view('frontend/home-user', compact('dataBuku'));
        }else{
            Auth::logout();
            Session::flash('status', $dataLogin);
            return redirect('/login');
        }
    }

    
    public function search(Request $request){
            $dataBuku = $this->bukuRepo->getDataSearchBuku($request);
            return view('backend.home-admin', compact('dataBuku'));
    }
}
