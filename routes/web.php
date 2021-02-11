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



Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pengguna','PenggunaController@index');
    Route::get('/pengguna/hapus','PenggunaController@hapus');
    Route::get('/pengguna/ubah','PenggunaController@ubah');
    Route::post('/pengguna/simpan','PenggunaController@simpan');
    Route::post('/pengguna/simpan_ubah','PenggunaController@simpan_ubah');
    Route::get('/pengguna/view_data','PenggunaController@view_data');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/unit','UnitController@index');
    Route::get('/unit/cari_nik','UnitController@cari_nik');
    Route::get('/unit/hapus','UnitController@hapus');
    Route::get('/unit/ubah','UnitController@ubah');
    Route::post('/unit/simpan','UnitController@simpan');
    Route::post('/unit/simpan_ubah','UnitController@simpan_ubah');
    Route::get('/unit/view_data','UnitController@view_data');

});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/group','GroupController@index');
    Route::get('/group/hapus','GroupController@hapus');
    Route::get('/group/ubah','GroupController@ubah');
    Route::post('/group/simpan','GroupController@simpan');
    Route::post('/group/simpan_ubah','GroupController@simpan_ubah');
    Route::get('/group/view_data','GroupController@view_data');
    Route::get('/group/view_data_unit','GroupController@view_data_unit');
    Route::get('/group/tambah_unit','GroupController@tambah_unit');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pemilihan','PemilihanController@index');
    
    Route::get('/pemilihan/hapus','PemilihanController@hapus');
    Route::get('/pemilihan/ubah','PemilihanController@ubah');
    Route::get('/pemilihan/hapus_paslon','PemilihanController@hapus_paslon');
    Route::post('/pemilihan/simpan','PemilihanController@simpan');
    Route::post('/pemilihan/simpan_ubah','PemilihanController@simpan_ubah');
    Route::post('/pemilihan/simpan_paslon','PemilihanController@simpan_paslon');
    Route::get('/pemilihan/view_data','PemilihanController@view_data');
    Route::get('/pemilihan/view_data_paslon','PemilihanController@view_data_paslon');
    Route::get('/pemilihan/tambah_paslon','PemilihanController@tambah_paslon');
    Route::get('/pemilihan/aktif','PemilihanController@aktif');
    Route::get('/pemilihan/non_aktif','PemilihanController@non_aktif');
});

Route::group(['middleware'    => 'auth'],function(){

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
