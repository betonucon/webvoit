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

Route::get('login', function () {
    return redirect('http://sso.krakatausteel.com/');
});
Route::get('login_skks/', function () {
    return view('auth.login');
});

// Route::post('login', 'Auth\LoginController@login')->name('login');
// Route::post('register', 'Auth\LoginController@login')->name('register');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('a/{personnel_no}/', 'Auth\LoginController@programaticallyEmployeeLogin')->name('login.a');
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/view_data_homenya','PemilihanController@view_data_vote');
    Route::get('/view_data_homenya_admin','PemilihanController@view_data_vote_admin');
});
Route::group(['middleware'    => 'auth'],function(){
    
    Route::get('/pengguna','PenggunaController@index');
    Route::get('/pengguna/enkripsi','PenggunaController@enkripsi');
    Route::get('/pengguna_unit','PenggunaController@index_unit');
    Route::get('/pengguna/hapus','PenggunaController@hapus');
    Route::get('/pengguna/ubah','PenggunaController@ubah');
    Route::post('/pengguna/simpan','PenggunaController@simpan');
    Route::post('/pengguna/simpan_ubah','PenggunaController@simpan_ubah');
    Route::get('/pengguna/view_data','PenggunaController@view_data');
    Route::get('/pengguna/view_data_unit','PenggunaController@view_data_unit');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/unit','UnitController@index');
    Route::get('/unit/cari_nik','UnitController@cari_nik');
    Route::get('/unit/cari_nik_group','UnitController@cari_nik_group');
    Route::get('/unit/cari_nik_pengguna','UnitController@cari_nik_pengguna');
    Route::get('/unit/hapus','UnitController@hapus');
    Route::get('/unit/ubah','UnitController@ubah');
    Route::post('/unit/simpan','UnitController@simpan');
    Route::post('/unit/simpan_ubah','UnitController@simpan_ubah');
    Route::get('/unit/view_data','UnitController@view_data');

});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/group','GroupController@index');
    Route::get('/group/hapus','GroupController@hapus'); 
    Route::get('/group/tampilkan_group','GroupController@tampilkan_group'); 
    Route::get('/group/hapus_pengguna','GroupController@hapus_pengguna');
    Route::get('/group/pengguna','GroupController@pengguna');
    Route::get('/group/ubah','GroupController@ubah');
    Route::post('/group/simpan','GroupController@simpan');
    Route::post('/group/simpan_ubah','GroupController@simpan_ubah');
    Route::post('/group/simpan_pengguna','GroupController@simpan_pengguna');
    Route::get('/group/view_data','GroupController@view_data');
    Route::get('/group/view_data_unit','GroupController@view_data_unit');
    Route::get('/group/view_data_pengguna','GroupController@view_data_pengguna');
    Route::get('/group/tambah_unit','GroupController@tambah_unit');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pemilihan','PemilihanController@index');
    Route::get('/pemilihan_unit','PemilihanController@index_unit');
    
    Route::get('/pemilihan/hapus','PemilihanController@hapus');
    Route::get('/pemilihan/sisa_waktu','PemilihanController@sisa_waktu');
    Route::get('/pemilihan/ubah','PemilihanController@ubah');
    Route::get('/pemilihan/hapus_paslon','PemilihanController@hapus_paslon');
    Route::post('/pemilihan/simpan','PemilihanController@simpan');
    Route::post('/pemilihan/simpan_ubah','PemilihanController@simpan_ubah');
    Route::post('/pemilihan/simpan_paslon','PemilihanController@simpan_paslon');
    Route::post('/pemilihan/simpan_voters','PemilihanController@simpan_voters');
    Route::get('/pemilihan/view_data','PemilihanController@view_data');
    Route::get('/pemilihan/view_data_perunit','PemilihanController@view_data_perunit');
    Route::get('/pemilihan/view_data_paslon','PemilihanController@view_data_paslon');
    Route::get('/pemilihan/view_data_voters','PemilihanController@view_data_voters');
    Route::get('/pemilihan/tambah_paslon','PemilihanController@tambah_paslon');
    Route::get('/pemilihan/aktif','PemilihanController@aktif');
    Route::get('/pemilihan/non_aktif','PemilihanController@non_aktif');
    Route::get('/pemilihan/hidupkan','PemilihanController@hidupkan');
    Route::get('/pemilihan/matikan','PemilihanController@matikan');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/quickcount', 'QuickcountController@index');
    Route::get('/quickcount/view_data', 'QuickcountController@view_data');
    Route::get('/quickcount/hapus', 'QuickcountController@hapus');
    Route::get('/quickcount/view_data_hasil', 'QuickcountController@view_data_hasil');
    Route::post('/quickcount/simpan', 'QuickcountController@simpan');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::get('/evote', 'HomeController@pilih');
    Route::get('/evote-load', 'HomeController@pilih_load');
});


Auth::routes();


