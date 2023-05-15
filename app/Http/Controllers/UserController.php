<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getuser()
    {
        $get_user = DB::table('user')->get();
        return response()->json($get_user);
    }

    public function getkasir()
    {
        $kasir = DB::table('user')->where('role','Kasir')->get();
            return response()->json($kasir);
    }

    public function selectuser($id)
    {
        $getuser = DB::table('user')->where('id_user', $id)->get();
        return response()->json($getuser);
    }

    public function createuser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'email' => 'required|unique:user',
            'password' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->tojson(), 422);
        }

        $create = DB::table('user')->insert([
            'nama' => $req->input('nama'),
            'email' => $req->input('email'),
            'gender' => $req->input('gender'),
            'password' => Hash::make($req->input('password')),
            'role' => $req->input('role'),
        ]);

        return response()->json([
            'Status' => 'Success'
        ]);
    }

    public function updateuser(Request $req, $id)
    {
        // $validator = Validator::make($req->all(), [

        // ]);
        $update = DB::table('user')->where('id_user', $id)->update([
            'nama' => $req->input('nama'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'role' => $req->input('role'),
            'gender' => $req->input('gender'),
        ]);

        if ($update) {
            return response()->json('Berhasil');
        } else {
            return response()->json('gagal');
        }
    }

    public function deleteuser($id)
    {
        $delete = DB::table('user')->where('id_user', $id)->delete();
        return response()->json([
            'Pesan' => 'Berhasil'
        ]);
    }
}