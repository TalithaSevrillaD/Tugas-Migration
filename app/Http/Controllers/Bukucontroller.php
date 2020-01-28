<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuModel;
use Validator;
use JWTAuth;
use Auth;

class Bukucontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin") {
        $validator = Validator::make($req->all(),
            [
                'judul'=>'required',
                'penerbit'=>'required',
                'pengarang'=>'required',
                'foto'=>'required',
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        } else {
            $simpan = BukuModel::create([
                'judul'=>$req->judul,
                'penerbit'=>$req->penerbit,
                'pengarang'=>$req->pengarang,
                'foto'=>$req->foto
            ]);

        if($simpan){
            $status="1";
            $message="Data berhasil ditambahkan!";
        } else {
            $status="0";
            $message="Data tidak berhasil ditambahkan";
        }
             return Response()->json(compact('status','message'));
        }
     } else {
         echo "Maaf, data hanya dapat diakses oleh admin.";
     }
}

    public function update($id, Request $req){
        
        if(Auth::user()->level=="admin") {
        $validator=Validator::make($req->all(),
            [
                'judul'=>'required',
                'penerbit'=>'required',
                'pengarang'=>'required',
                'foto'=>'required'
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        } 
        $ubah=BukuModel::where('id', $id)->update([
            'judul'=>$req->judul,
            'penerbit'=>$req->penerbit,
            'pengarang'=>$req->pengarang,
            'foto'=>$req->foto
        ]);

        if($ubah){
            $status="1";
            $message="Data berhasil diubah!";
        } else {
            $status="0";
            $message="Data tidak berhasil diubah";
        }
            return Response()->json(compact('status','message'));
    }  else {
        echo "Maaf, data hanya dapat diakses oleh admin.";
    }
}

    public function destroy($id){
        if(Auth::user()->level=="admin") {
        $hapus=BukuModel::where('id', $id)->delete();
        if($hapus){
            $status="1";
            $message="Data berhasil dihapus!";
        } else {
            $status="0";
            $message="Data tidak berhasil dihapus";
        }
        return Response()->json(compact('status','message'));
    } else {
        echo "Maaf, data hanya dapat diakses oleh admin.";
    }
}

    public function show(){
        if(Auth::user()->level=="admin") {

        $buku = BukuModel::all();
        $status="1";

        return Response()->json(compact('buku', 'status'));
    } else {
        echo "Maaf, data hanya dapat diakses oleh admin.";
    }
}
}