<?php

namespace App\Repositories\Backend;
use App\Buku;
use App\StatusBuku;
use Auth;

class StatusBukuRepository{

       public function statusBuku($request, $id = null){
      
                $result = ["status"=> false, "message"=> ""];
                
        
                try {
                        // Id Buku
                        $buku_id = $id;

                         // Available Caracther
                        $characthers = 'ABCDEFGHIJKLMNOPQRSTUVWZYZ';

                        // Genrate Kode Pinjaman
                        $kodeRandom = $characthers[rand(0, strlen($characthers))] . mt_rand(10000000, 99999999);


                        $statusBukuRepo = StatusBuku::create([
                                'user_id'         => Auth::user()->id,
                                'buku_id'         => $buku_id,
                                'kode_pinjaman' => $kodeRandom,
                                'status'          => 'Mengajukan Pinjaman',
                                'jumlah_pinjaman' => $request->jumlah_pinjaman
                        ]);

                        $result['status']  = true;
                        $result['message'] = 'Berhasil Mengajukan Pinjaman Buku';
                        return $result;
                } catch (\Throwable $th) {
                        $result['message'] = $th->getMessage();
                        return $result;
                }
       }


       public function statusRiwayatBuku(){
               
                $result = ["status"=>false, "message"=>""];
                $authId = Auth::user()->id;
                try {
                        $statusBukuRepo     = StatusBuku::where('user_id', $authId)->with('statusBuku')->get();  
                        $result["status"]   = true;
                        $result['message'] = $statusBukuRepo;
                        return $result;
                } catch (\Throwable $th) {
                        $result['message'] = $th->getMessage();
                        return $result;
                }
       }
}

?>