<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps=null ;
    protected $table="transaksi";
    protected $primarykey="id_transaksi";
    protected $fillable=['tanggal_pesan','id_meja','id_user','id_menu','nama_pelanggan','status','total_pesanan','total_harga'];
}