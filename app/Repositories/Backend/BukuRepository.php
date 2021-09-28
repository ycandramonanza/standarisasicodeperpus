<?php

namespace App\Repositories\Backend;
use Illuminate\Support\Facades\Storage;
use App\Buku;
use App\User;
use App\StatusBuku;
use Auth;



class BukuRepository{

    // Mengambil spesifik data
    public function findId($id){
        return Buku::find($id, ['id', 'judul_buku', 'desc', 'pengarang', 'stok', 'image'])->first();
    }

    public function track($id){
        return StatusBuku::where('buku_id', $id->id)->where('status',  'Di Setujui')->with('statusUser')->get();
    }

        // Search Data
    public function getDataSearchBuku($request){
        $data = $request->search;
        return Buku::where('judul_buku', 'LIKE', "%$data%")->orWhere('kode_buku', 'LIKE', "%$data%")->orWhere('kategori', 'LIKE', "%$data%")->paginate(3);
    }

    // Mengambil Data Buku Di Database
    public function getDataBuku(){
        $authId = Auth::user()->role;

        if($authId == 'Admin' ){
            return Buku::orderBy('id', 'DESC')->paginate(4);
        }else{
            return Buku::all();
        }
    }

    public function addImage($request, $id = null){
        $result = ["status"=>false, "message"=> ""];
        try {
            if(is_null($id)){
                if($request->image){
                    $image     = $request->file('image');
                    $bukuName  = $request->judul_buku;
                    $fristname = strtok($bukuName, ' ');
                    $filename  = $fristname . time() . '.' . $image->getClientOriginalExtension();
                    $request->file('image')->storeAs( 'public/image-buku/',  $filename);
                }

            }else{
                $bukuRepo = Buku::findOrFail($id);
                if($request->hasFile('image')){
                    if(\File::exists('storage/image-buku/'. $bukuRepo->image )){
                        \File::delete('storage/image-buku/'. $bukuRepo->image);
                    }
                    $filename = $bukuRepo->image;
                    $request->file('image')->storeAs( 'public/image-buku/',  $filename);
                }else{
                    $filename = $bukuRepo->image;
                }
            }

            $result['status']   = true;
            $result['message'] = $filename;
            return $result;

        }catch (\Exception $e) {
            $result['message'] = 'maaf ada error, err msg: ' . $e->getMessage();
            return $result;
        }
    }

    // Menambahkan Data Buku Ke Database
    public function storeDataBuku($request, $id = null){
        $result = ["status" =>false, "message"=> ""];
        try {
            $bukuRepo = $this->findById($id);
            if(!$bukuRepo){
                $bukuRepo = new Buku;
                $image     = $request->file('image');
                $bukuName  = $request->judul_buku;
                $firstname = strtok($bukuName, ' ');
                $filename  = $firstname . time() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storeAs( 'public/image-buku/',  $filename);
            }else{
                $filename = $bukuRepo->image;
                if($request->hasFile('image')) {
                    \File::exists('storage/image-buku/' . $bukuRepo->image) ? \File::delete('storage/image-buku/' . $bukuRepo->image) : '';
                    $filename = $bukuRepo->image;
                    $request->file('image')->storeAs('public/image-buku/', $filename);
                }
            }

            $bukuRepo->kode_buku  = $request->kode_buku;
            $bukuRepo->kategori   = $request->kategori;
            $bukuRepo->judul_buku = $request->judul_buku;
            $bukuRepo->desc       = $request->desc;
            $bukuRepo->stok       = $request->stok;
            $bukuRepo->pengarang  = $request->pengarang;
            $bukuRepo->image      = $filename;
            $bukuRepo->save();

            $result["status"]  = true;
            $result["message"] = "Success";
            return $result;
        } catch (\Exception $th) {
            $result["message"] = $th->getMessage();
            return $result;
        }
    }

    public function findById($id){
        return Buku::with([])
            ->find($id);
    }

    // Menghapus Data
    public function delete($id){
        $result = ["status"=>false, "message"=> ""];
        try {
            $id->delete();
            \File::exists('storage/image-buku/' . $id->image) ? \File::delete('storage/image-buku/' . $id->image) : '';
            $result['status']  = true;
            $result['message'] = "Data Berhasil di Hapus";
            return $result;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            return $result;
        }
    }
}

?>