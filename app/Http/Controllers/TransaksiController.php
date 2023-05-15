<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Menu;
use App\Models\Meja;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function gettransaksi()
    {
        $gettransaksi = Transaksi::get();
        return response()->json($gettransaksi);
    }

    public function ongoing()
    {
        $get = DB::table('meja')->where('status', 'digunakan')->get();
        return response()->json($get);
    }

    public function getongoingtransaksi($id)
    {
        $gettransaksi = DB::table('transaksi')->where('id_meja', $id)->where('status', 'belum_bayar')->first();
        return response()->json($gettransaksi);
    }

    public function totalharga($id)
    {
        $gettotal = DB::table('transaksi')->where('id_meja', $id)->where('status', 'belum_bayar')->sum('total_harga');
        return response()->json($gettotal);
    }

    public function getcart()
    {
        $cart = DB::table('transaksi')->where('id_meja', null)
            ->join('menu', 'transaksi.id_menu', '=', 'menu.id_menu')
            ->get();
        return response()->json($cart);
    }

    public function selecttransaksi($id)
    {
        $gettransaksi = DB::table('transaksi')->where('id_pelayanan', $id)->get();
        return response()->json($gettransaksi);
    }

    public function tambahpesanan(Request $req)
    {
        $harga_menu = DB::table('menu')->where('id_menu', $req->input('id_menu'))->select('harga')->first();
        $harga_menu = $harga_menu->harga;

        $tgl_pesan = Carbon::now();
        $total_pesanan = $req->input('total_pesanan');
        $total_harga = $harga_menu * $total_pesanan;

        $tambah = DB::table('transaksi')->insert([
            'id_menu' => $req->input('id_menu'),
            'tanggal_pesan' => $tgl_pesan,
            'total_pesanan' => $total_pesanan,
            'total_harga' => $total_harga,
            'status' => 'belum_bayar'
        ]);

        if ($tambah) {
            return response()->json('Berhasil');
        } else {
            return response()->json('Gagal');
        }
    }

    public function checkout(Request $req)
    {
        $id_pelayanan = Str::random(5);

        $checkout = DB::table('transaksi')->where('id_pelayanan', null)->update([
            'id_pelayanan' => $id_pelayanan,
            'id_user' => $req->input('id_user'),
            'id_meja' => $req->input('id_meja'),
            'nama_pelanggan' => $req->input('nama_pelanggan')
        ]);

        $updatemeja = DB::table('meja')->where('id_meja', $req->input('id_meja'))->update([
            'status' => 'Digunakan'
        ]);

        if ($checkout && $updatemeja) {
            return response()->json('Berhasil');
        } else {
            return response()->json('Gagal');
        }
    }

    public function donetransaksi($id)
    {
        $done = DB::table('transaksi')->where('id_meja', $id)->where('status', 'belum_lunas')->update([
            'status' => 'lunas'
        ]);

        $meja = DB::table('meja')->where('id_meja', $id)->update([
            'status' => 'kosong'
        ]);

        if ($done && $meja) {
            return response()->json([
                'Message' => 'Sukses'
            ]);
        } else {
            return response()->json([
                'Message' => 'gagal'
            ]);
        }
    }
}