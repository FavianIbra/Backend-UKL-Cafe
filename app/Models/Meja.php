<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    public $timestamps=null ;
    protected $table="meja";
    protected $primarykey="id_meja";
    protected $fillable=['nomor_meja'];
}