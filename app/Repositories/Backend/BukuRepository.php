<?php

namespace App\Repositories\Backend;
use Illuminate\Support\Facades\Storage;
use App\Buku;
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
            return $bukuRepo = Buku::orderBy('id', 'DESC')->paginate(4);
        }else{
            return $bukuRepo = Buku::all();
        }
    }


    // Menambahkan Data Buku Ke Database
    public function storeDataBuku($request, $id = null){
        $result = ["status" =>false, "message"=>""];
        $data   = $request->all();
        try {
            if($id){

                $bukuRepo = Buku::findOrFail($id);

                if($request->image){
                        $filename = $bukuRepo->image;
                        if(\File::exists('storage/image-buku/'. $bukuRepo->image )){
                            \File::delete('storage/image-buku/'. $bukuRepo->image);
                        }
                        $request->file('image')->storeAs( 'public/image-buku/',  $filename);
                        $bukuRepo->update([
                            "kode_buku"  => $request->kode_buku,
                            "kategori"   => $request->kategori,
                            "judul_buku" => $request->desc,
                            "stok"       => $request->stok,
                            "pengarang"  => $request->pengarang,
                            "image"      => $filename,
                        ]);
                        $result["status"]  = true;
                        $result["message"] = "Berhasil di Ubah";
                        return $result;
                }else{
                    $bukuRepo->update($data);
                    $result["status"]  = true;
                    $result["message"] = "Berhasil di Ubah";
                    return $result;
                }

            }else{
                if(!$request->hasFile('image')){
                    $result['status'] = false;
                    $result ['message'] = "Gambar Tidak Boleh Kosong";
                    return $result;
                }
                if($request->hasFile('image')){
                    // Store image to storage
                    $image     = $request->file('image');
                    $bukuName  = $data['judul_buku'];
                    $fristname = strtok($bukuName, ' ');
                    $filename  = $fristname . time() . '.' . $image->getClientOriginalExtension();
                    $request->file('image')->storeAs( 'public/image-buku/',  $filename);
                }

                Buku::create([
                    "kode_buku"  => $request->kode_buku,
                    "kategori"   => $request->kategori,
                    "judul_buku" => $request->judul_buku,
                    'desc'       => $request->desc,
                    "stok"       => $request->stok,
                    "pengarang"  => $request->pengarang,
                    "image"      => $filename,
                ]);
                $result["status"]  = true;
                $result["message"] = "Buku Sudah di Tambahkan";
                return $result;
            }
                            
        } catch (\Throwable $th) {
            $result["message"] = $th->getMessage();
            return $result;
        }
    }


        // Menghapus Data
    public function delete($id){
        $result = ["status"=>false, "message"=> ""];
             
        try {
            $id->delete();
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