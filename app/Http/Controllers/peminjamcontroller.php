<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use App\PeminjamModel;
use App\PetugasModel;
use App\AnggotaModel;
use App\DetailModel;
use App\BukuModel;
use DB;
use Auth;

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
        echo "Maaf, anda bukan admin.";
            }
    }

    public function storeDetail(Request $req)
    {
        if(Auth::user()->level=="petugas") {
            $validator = Validator::make ($req->all(),
                [
                    'id_peminjaman'=>'required',
                    'id_buku'=>'required',
                    'qty'=>'required'
                ]
            );
            if($validator->fails()){
                return Response()->json($validator->errors());
            } else {
                $simpan = DetailModel::create([
                    'id_peminjaman'=>$req->id_peminjaman,
                    'id_buku'=>$req->id_buku,
                    'qty'=>$req->qty
                ]);

                if($simpan){
                    $status="1";
                    $message="Data berhasil ditambahkan!";
                } else {
                    $status ="0";
                    $message="Data tidak berhasil ditambahkan";
                }

                return Response()->json(compact('status', 'message'));
                }
            } else {
                echo "Maaf, data hanya dapat diakses oleh petugas.";
            }
        }

        public function updateDetail($id, Request $req){
            if(Auth::user()->level=="petugas") {
            $validator=Validator::make($req->all(),
                [
                    'id_peminjaman'=>'required',
                    'id_buku'=>'required',
                    'qty'=>'required',
                    
                ]
            );
            if($validator->fails()){
                return Response()->json($validator->errors());
            } 
            $change=DetailModel::where('id', $id)->update([
                    'id_peminjaman'=>$req->id_peminjaman,
                    'id_buku'=>$req->id_buku,
                    'qty'=>$req->qty
            ]);

            if($change){
                $status="1";
                $message="Data berhasil diubah!";
            } else {
                $status="0";
                $message="Data tidak berhasil diubah";
            }
                return Response()->json(compact('status','message'));
    }  else {
        echo "Maaf, data hanya dapat diakses oleh petugas.";
    }
        }

        public function destroyDetail($id){
            if(Auth::user()->level=="petugas") {
                $delete=DetailModel::where('id', $id)->delete();
                if($delete){
                    $status="1";
                    $message="Data berhasil dihapus!";
                } else {
                    $status="0";
                    $message="Data tidak berhasil dihapus";
                }
                return Response()->json(compact('status','message'));
            } else {
                echo "Maaf, data hanya dapat diakses oleh petugas.";
            }
        }

        public function transaksi($id){
            if(Auth::user()->level=="petugas") {
            $peminjaman = DB::table('peminjaman')
            ->join('anggota', 'anggota.id', '=', 'peminjaman.id_anggota')
            ->select('peminjaman.id', 'peminjaman.id_anggota', 'anggota.nama_anggota',
                    'peminjaman.id_petugas', 'peminjaman.tgl_pinjam', 'peminjaman.deadline', 
                    'peminjaman.tgl_kembali', 'peminjaman.denda')
            ->where('peminjaman.id', $id)
            ->get();

            $data=array();
            foreach ($peminjaman as $p){
                $ok = DetailModel::where('id_peminjaman', $p->id)->get();

                $arr_detail = array();
                foreach ($ok as $ok){
                    $arr_detail[]=array(
                        'id_peminjaman'=> $ok->id_peminjaman,
                        'id_buku'=>$ok->id_buku,
                        'qty'=>$ok->qty
                    );
                }

                $data[]=array(
                    'id' => $p->id,
                    'id_anggota'=>$p->id_anggota,
                    'nama_anggota'=>$p->nama_anggota,
                    'id_petugas'=>$p->id_petugas,
                    'tgl_pinjam'=>$p->tgl_pinjam,
                    'deadline'=>$p->deadline,
                    'tgl_kembali'=>$p->tgl_kembali,
                    'denda'=>$p->denda,
                    'detail_buku'=>$arr_detail
                );
            }

            return Response()->json(compact('data'));
        } else {
            echo "Maaf, data hanya dapat diakses oleh petugas.";
        }
        }
    
}

