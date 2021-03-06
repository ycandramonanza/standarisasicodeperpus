<?php

namespace App\Repositories\Backend;
use App\Buku;
use App\User;
use App\StatusBuku;
use Auth;

class StatusBukuRepository{

    public function statusBuku($request, $id = null)
    {
        $result = ["status" => false, "message" => ""];
        $jumlahPinjaman = $request->jumlah_pinjaman;

        try {
            // Id Buku
            $buku_id = $id;

            // get Frist Name
            $name       = Auth::user()->name;
            $firstname = strtok($name, ' ');

            // Genrate Kode Pinjaman
            $kodeRandom = $firstname. mt_rand(10000000, 99999999);

            // Kondisi ketika jumlah Pinjaman Buku 0
            if($jumlahPinjaman == null)
            {
                $result['status']  = false;
                $result['message'] = 'Null Request';
                return $result;
            }

            // Kondisi ketika user melebihi kuota peminjaman max : 5 buku;

            $getData        = statusBuku::where('user_id', Auth::user()->id)->where('status', 'Di Setujui')->get();
            $kuotaData      = $getData->sum('jumlah_pinjaman');

            $kuotaFix       = $kuotaData + $jumlahPinjaman;

            if($jumlahPinjaman > 5)
            {
                $result['status']  = false;
                $result['message'] = 'Limit Kuota';
                return $result;
            }
                       
            if($kuotaFix > 5 )
            {
                $result['status']  = false;
                $result['message'] = 'Limit Request';
                return $result;
            }

            // limit_pinjam  di table user akan berkurang;
            $userLimit  = User::where('id', Auth::user()->id)->first();
            $limitMinus = $userLimit['limit_pinjam'] - $jumlahPinjaman;
            $userLimit->update([
                'limit_pinjam' => $limitMinus,
            ]);


            $statusBukuRepo = StatusBuku::create([
                'user_id'         => Auth::user()->id,
                'buku_id'         => $buku_id,
                'kode_pinjaman'   => $kodeRandom,
                'status'          => 'Dalam Pengajuan',
                'jumlah_pinjaman' => $jumlahPinjaman
            ]);

            $result['status']  = true;
            $result['message'] = 'Berhasil Mengajukan Pinjaman Buku';
            return $result;

        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            return $result;
        }
    }


    public function statusRiwayatBuku($request = null)
    {
        $result = ["status" => false, "message" => ""];
        $authId = Auth::user()->id;
        $authRole = Auth::user()->role;

        try {
            if ( $request == 'Dalam Pengajuan' )
            {
                $statusBukuRepo     = StatusBuku::where('user_id', $authId)->where('status', $request)->with('statusBuku')->get();
            } else if( $request == 'Di Setujui' )
            {
                    if( $authRole == 'Admin')
                    {
                        $statusBukuRepo     = StatusBuku::where('status', $request)->with('statusBuku')->orderBy('id', 'DESC')->get();
                    }else{
                        $statusBukuRepo     = StatusBuku::where('user_id', $authId)->where('status', $request)->with('statusBuku')->orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
                    }

                    $result["status"]   = true;
                    $result['message']  = $statusBukuRepo;
                    return $result;

            } else if( $request == 'Di Batalkan' )
            {
                    if(Auth::user()->role == 'Admin')
                    {
                        $statusBukuRepo     = StatusBuku::where('status', $request)->with('statusBuku')->orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
                    }else{
                        $statusBukuRepo     = StatusBuku::where('user_id', $authId)->where('status', $request)->with('statusBuku')->orderBy('id', 'DESC')->get();
                    }

                    $result["status"]   = true;
                    $result['message']  = $statusBukuRepo;
                    return $result;
            } else if( $request == 'All Data')
            {
                    $statusBukuRepo     = StatusBuku::where('status', 'Dalam Pengajuan')->with('statusBuku')->get();
            }else
            {
                    $statusBukuRepo     = StatusBuku::where('user_id', $authId)->with('statusBuku')->orderBy('id', 'DESC')->get();
            }

            $result["status"]   = true;
            $result['message']  = $statusBukuRepo;
            return $result;
        } catch (\Throwable $th) {
            $result['message']  = $th->getMessage();
            return $result;
        }
    }



    public function statusApprove($id = null)
    {

        $result = ["status" => false, "message" => ""];
        $status       = "Di Setujui";

        try {

            //  stok buku di table buku akan berkurang;
            $stokBuku    = Buku::where('id', $id->buku_id)->first();
            $stokMinus   = $stokBuku['stok'] - $id->jumlah_pinjaman;
            $stokBuku->update([
                'stok' => $stokMinus,
            ]);

            $id->update([
                'status' => $status,
            ]);

            $result['status']  = true;
            $result['message'] = 'Buku Berhasil di Pinjam';
            return $result;
        }catch (\Exception $th){
            $result["message"] = $th->getMessage();
              return $result;
        }
    }

    public function statusCancelReturn($id = null)
    {
        $result = ["status" => false, "message" => ""];
        $status = "Di Batalkan";


        try {
            $userReq    = $id->jumlah_pinjaman;
            $userId = $id->user_id;
            $bukuId = $id->buku_id;

            //limit_pinjam  di table user akan bertambah;
            // getUser
            $userLimit  = User::where('id', $userId)->first();
            $limit      = $userLimit['limit_pinjam'];
                        
            // Menambahkan Limit
            $limitPlus = $limit + $userReq;

          $cek =  $userLimit->update([
                'limit_pinjam' => $limitPlus,
            ]);

            //stok buku di table buku akan bertambah;
            $stokBuku  = Buku::where('id', $bukuId)->first();
            $stok      = $stokBuku['stok'];
            $stokPlus  = $stok + $userReq;

            $stokBuku->update([
                'stok' => $stokPlus,
            ]);

            $id->update([
                'status' => $status,
            ]);

            $result['status']  = true;
            $result['message'] = 'Berhasil di Proses';
            return $result;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
            return $result;
        }
    }
}

?>