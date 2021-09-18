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


        // Route Backend
        Route::prefix('buku')->group(function() {
            Route::get('/create/{id?}', 'BukuController@bukuCreate')->name('buku.create_admin');
            Route::post('/store/{id?}', 'BukuController@bukuStore')->name('buku.store_admin');
            Route::delete('/delete/{id}', 'BukuController@bukuDelete')->name('buku.delete_admin');
        });

        // Route Frontend
        Route::prefix('perpustakaan-digital')->group(function() {

            Route::get('/buku/show/{id}', 'BukuController@bukuShow')->name('buku.show_user');
            Route::post('/pinjam/buku/{id}', 'StatusBukuController@statusBukuCreate')->name('status.buku_user');
            Route::get('/status/riwayat', 'StatusBukuController@statusRiwayat')->name('status.riwayat_user');
        });





