<?php

use Illuminate\Database\Seeder;

class SeederBuku extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BukuModel::insert([
            [
                'judul'=>'aku tanpamu',
                'penerbit'=>'Gramed',
                'pengarang'=>'siapa',
                'foto'=>'-',
                'created_at'=>Date('Y-m-d H:i:s')
            ],
            [
                'judul'=>'kamu tanpaku',
                'penerbit'=>'Diamond',
                'pengarang'=>'jimin',
                'foto'=>'-',
                'created_at'=>Date('Y-m-d H:i:s')
            ],
            [
                'judul'=>'Aku dan Kamu',
                'penerbit'=>'Media',
                'pengarang'=>'Krystal',
                'foto'=>'-',
                'created_at'=>Date('Y-m-d H:i:s')
            ],
            [
                'judul'=>'Senja',
                'penerbit'=>'MAC',
                'pengarang'=>'Diandra',
                'foto'=>'-',
                'created_at'=>Date('Y-m-d H:i:s')
            ],
            [
                'judul'=>'Bumi berbicara',
                'penerbit'=>'Erlang',
                'pengarang'=>'Sam',
                'foto'=>'-',
                'created_at'=>Date('Y-m-d H:i:s')
            ]
        ]);
    }
}
