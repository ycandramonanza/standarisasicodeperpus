<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search/buku', 'HomeController@search')->name('search');

        // Route Backend
        Route::prefix('buku')->group(function() {
            Route::get('/creates/{id?}', 'BukuController@bukuCreate')->name('buku.create_admin');
            Route::post('/stores/{id?}', 'BukuController@bukuStore')->name('buku.store_admin');
            Route::get('/showes/{id}', 'BukuController@bukuShowAdmin')->name('buku.show_admin');
            Route::get('/trackes/{id}', 'BukuController@bukuTrack')->name('buku.track');
            Route::delete('/deletes/{id}', 'BukuController@bukuDelete')->name('buku.delete_admin');
        });

        Route::prefix('anggota')->group(function() {
            Route::get('/perpustakaan-digital', 'AnggotaController@indexAnggota')->name('anggota.user_admin');
        });

        Route::prefix('status')->group(function() {
            Route::get('/pengajuan', 'StatusBukuController@daftarPengajuan')->name('daftar.pengajuan_peminjaman_buku_admin');
            Route::get('/approves/{id}', 'StatusBukuController@approve')->name('approve_admin');
            Route::get('/canceles/{id}', 'StatusBukuController@cancel')->name('cancel_admin');
            Route::get('/peminjaman', 'StatusBukuController@daftarPeminjaman')->name('daftar.peminjaman_admin');
            Route::get('/pembatalan', 'StatusBukuController@daftarPembatalan')->name('daftar.pembatalan_admin');
            Route::get('/return/{id}', 'StatusBukuController@statusReturn')->name('status.return_user');
        });


        






        // Route Frontend
        Route::prefix('perpustakaan-digital')->group(function() {

            Route::get('/buku/showes/{id}', 'BukuController@bukuShow')->name('buku.show_user');
            Route::post('/pinjam/bukus/{id}', 'StatusBukuController@statusBukuStore')->name('status.buku_user');
            Route::get('/status/riwayat/all', 'StatusBukuController@statusRiwayatAll')->name('status.riwayat_user');
            Route::get('/status/riwayat/pengajuan', 'StatusBukuController@statusRiwayatPengajuan')->name('status.riwayat_pengajuan_user');
            Route::get('/status/riwayat/peminjaman', 'StatusBukuController@statusRiwayatPeminjaman')->name('status.riwayat_peminjaman_user');
            Route::get('/status/riwayat/pembatalan', 'StatusBukuController@statusRiwayatPembatalan')->name('status.riwayat_pembatalan_user');
        });





