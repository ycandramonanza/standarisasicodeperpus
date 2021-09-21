<?php

namespace App\Repositories\Backend;
use App\Buku;

class BukuRepository{

        // Mengambil data Spesifik findId
        public function findId($id){

                
                $result = ["status"=>false, "message"=> ""];
             
                try {
                       
                        $bukuRepo = Buku::find($id)->first();
                        $result['status']  = true;
                        $result['message'] = $bukuRepo;
                        return $result;
                } catch (\Throwable $th) {
                        $result['message'] = $th->getMessage();
                        return $result;
                }

        }

         // Mengambil Data Buku Di Database
        public function getDataBuku(){

                $result =["status" => false, "message" => ""];

                try {
                    $bukuRepo = Buku::all();
                    $result['status'] = true;
                    $result['message'] = $bukuRepo;
                    return $result;
                } catch (\Throwable $th) {
                    $result["message"] = $th->getMessage();
                    return $result;
                }
        }


        // Menambahkan Data Buku Ke Database
        public function storeDataBuku($request, $id = null){

                $result = ["status" =>false, "message"=>""];
                $data   = $request->all();

                try {

                       
                        if($id){
                            Buku::findOrFail($id)->update($data);
                            $result["status"]  = true;
                            $result["message"] = "Berhasil di Ubah";
                            return $result;
                        }else{
                        
                                if($request->hasFile('image')){
                                       
                                        // Store image to storage
                                        $image     = $request->file('image');
                                        $bukuName  = $data['judul_buku'];
                                        $fristname = strtok($bukuName, ' ');
                                        $filename  = $fristname . time() . '.' . $image->getClientOriginalExtension();
                                        $path = $request->file('image')->storeAs( 'public/image-buku/',  $filename);

                                     
                                        
                                }

                                $bukuRepo = Buku::create([
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


        // Menghapus Data Buku Di Database
        public function deleteDataBuku($id){

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