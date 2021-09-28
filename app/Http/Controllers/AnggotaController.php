<?php

namespace App\Http\Controllers;
use App\User;
use App\Buku;
use App\Repositories\Backend\BukuRepository;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{


    protected $anggota;
    public function __construct()
    {
        $this->anggota = new BukuRepository;
    }



    public function indexAnggota()
    {
        $data = User::where('role', 'User')->orderBy('id', 'DESC')->get();

        return view('backend.daftar-anggota', compact('data'));
    }

    public function anggotaDelete(User $id)
    {
        $data = $this->anggota->delete($id);
        $message = $data['message'];
        return redirect()->route('anggota.user_admin')->with('delete', $message);
    }

}
