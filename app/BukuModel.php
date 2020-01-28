<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    protected $table = "buku";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'id', 'judul', 'penerbit', 'pengarang', 'foto'
    ];
}
