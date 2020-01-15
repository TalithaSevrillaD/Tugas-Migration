<?php

use Illuminate\Database\Seeder;

class SeederPetugas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PetugasModel::insert([
            [
                'nama_petugas'=>'Jaebum',
                'alamat'=>'Seoul',
                'telp'=>'082173981',
                'username'=>'Jaebumie',
                'password'=>'jaebumie123',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_petugas'=>'Bambam',
                'alamat'=>'Seoul',
                'telp'=>'08398235',
                'username'=>'Bambam1a',
                'password'=>'bambam123',
                'created_at'=> Date('Y-m-d H:i:s')

            ],
            [
                'nama_petugas'=>'Mark',
                'alamat'=>'Seoul',
                'telp'=>'081186429',
                'username'=>'Markiya',
                'password'=>'mark123',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_petugas'=>'Youngjae',
                'alamat'=>'Seoul',
                'telp'=>'087981284',
                'username'=>'Youngjae33',
                'password'=>'youngjae123',
                'created_at'=> Date('Y-m-d H:i:s')
            ],
            [
                'nama_petugas'=>'Jackson',
                'alamat'=>'Seoul',
                'telp'=>'08971284',
                'username'=>'Jacksonwang',
                'password'=>'Jackson123',
                'created_at'=> Date('Y-m-d H:i:s')
            ]
        ]);
    }
}
