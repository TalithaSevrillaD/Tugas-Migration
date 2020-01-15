<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SeederAnggota::class);
        $this->call(SeederBuku::class);
        $this->call(SeederPetugas::class);
    }
}
