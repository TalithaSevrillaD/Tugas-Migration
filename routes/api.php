<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
    return Auth::user()->level;
})->middleware('jwt.verify');

Route::post('buku', 'Bukucontroller@store')->middleware('jwt.verify');
Route::put('buku/{id}', 'Bukucontroller@update')->middleware('jwt.verify');
Route::delete('buku/{id}', 'Bukucontroller@destroy')->middleware('jwt.verify');
Route::get('buku', 'Bukucontroller@show')->middleware('jwt.verify');

Route::post('peminjaman', 'peminjamcontroller@store')->middleware('jwt.verify');
Route::put('peminjaman/{id}', 'peminjamcontroller@update')->middleware('jwt.verify');
Route::delete('peminjaman/{id}', 'peminjamcontroller@destroy')->middleware('jwt.verify');
Route::get('peminjaman', 'peminjamcontroller@show')->middleware('jwt.verify');
 
Route::post('anggota', 'Anggotacontroller@store')->middleware('jwt.verify');
Route::put('anggota/{id}', 'Anggotacontroller@update')->middleware('jwt.verify');
Route::delete('anggota/{id}', 'Anggotacontroller@destroy')->middleware('jwt.verify');
Route::get('anggota', 'Anggotacontroller@show')->middleware('jwt.verify');