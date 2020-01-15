<?php

use Illuminate\Database\Seeder;

class SeederAnggota extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AnggotaModel::insert([
            [
                'nama_anggota'=>'talitha',
                'alamat'=>'gatau',
                'telp'=>'0891231415',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_anggota'=>'Jimin',
                'alamat'=>'Busan',
                'telp'=>'08294279',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_anggota'=>'Taehyung',
                'alamat'=>'Daegu',
                'telp'=>'0823972957',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_anggota'=>'Namjoon',
                'alamat'=>'Ilsan',
                'telp'=>'086741284',
                'created_at'=>Date('Y-m-d H:i:s')
            ],
            [
                'nama_anggota'=>'Yoongi',
                'alamat'=>'Daegu',
                'telp'=>'0851419385',
                'created_at'=>Date('Y-m-d H:i:s')
            ]
        ]);
    }
}
