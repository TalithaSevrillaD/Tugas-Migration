<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use App\PeminjamModel;
use App\PetugasModel;
use App\AnggotaModel;
use DB;

class peminjamcontroller extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin") {
        $validator = Validator::make($req->all(),
            [
                'id_anggota'=>'required',
                'id_petugas'=>'required',
                'tgl_pinjam'=>'required',
                'deadline'=>'required',
                'tgl_kembali'=>'required',
                'denda'=>'required'
            ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        } else {
        $simpan = PeminjamModel::create([
            'id_anggota'=>$req->id_anggota,
            'id_petugas'=>$req->id_petugas,
            'tgl_pinjam'=>$req->tgl_pinjam,
            'deadline'=>$req->deadline,
            'tgl_kembali'=>$req->tgl_kembali,
            'denda'=>$req->denda
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
    echo "Maaf, anda bukan admin.";
}
}
    public function update($id, Request $req)
    {
        if(Auth::user()->level=="admin") {
        $validator = Validator::make($req->all(),
            [
                'id_anggota'=>'required',
                'id_petugas'=>'required',
                'tgl_pinjam'=>'required',
                'deadline'=>'required',
                'tgl_kembali'=>'required',
                'denda'=>'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah = PeminjamModel::where('id', $id)->update([
            'id_anggota'=>$req->id_anggota,
            'id_petugas'=>$req->id_petugas,
            'tgl_pinjam'=>$req->tgl_pinjam,
            'deadline'=>$req->deadline,
            'tgl_kembali'=>$req->tgl_kembali,
            'denda'=>$req->denda
        ]);
        if($ubah){
            $status="1";
            $message="Data berhasil diubah!";
        } else {
            $status="0";
            $message="Data tidak berhasil diubah";
        }
        return Response()->json(compact('status','message'));
    } else {
        echo "Maaf, anda bukan admin.";
    }
}

    public function destroy($id)
    {
        if(Auth::user()->level=="admin") {
        $hapus = PeminjamModel::where('id', $id)->delete();
        if($hapus){
            $status="1";
            $message="Data berhasil dihapus!";
        } else {
            $status="0";
            $message="Data tidak berhasil dihapus";
        }

        return Response()->json(compact('status','message'));
    } else {
        echo "Maaf, anda bukan admin.";
    }
}
    public function show()
    {
        if(Auth::user()->level=="admin") {
        $ok=DB::table('peminjaman');
        $status=1;
        $count=$ok->count();
        $pinjam=DB::table('peminjaman')
            ->join('anggota', 'anggota.id', '=', 'peminjaman.id_anggota')
            ->join('petugas', 'petugas.id', '=', 'peminjaman.id_petugas')
            ->select('anggota.id', 'anggota.nama_anggota', 'anggota.alamat', 'anggota.telp', 
            'petugas.nama_petugas', 'petugas.alamat', 'petugas.telp','petugas.username','peminjaman.tgl_pinjam', 'peminjaman.deadline', 'peminjaman.tgl_kembali', 'peminjaman.denda')
            ->get();

        return Response()->json(compact('count', 'pinjam', 'status'));
    } else {
        echo "Maaf, anda bukan admin."
    }
}
