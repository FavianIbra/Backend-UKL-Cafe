<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $fillable = ['id_meja', 'nomor_meja', 'status'];
    protected $primarykey = 'id_meja';
}