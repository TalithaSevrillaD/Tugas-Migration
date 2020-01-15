<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaModel extends Model
{
    protected $table = "anggota";
    protected $primaryKey = "id";
    public $timestamps = false;
}
