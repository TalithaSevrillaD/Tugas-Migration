<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    protected $table= "detailpeminjaman";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'id', 'id_peminjaman', 'id_buku', 'qty'
    ];
}
