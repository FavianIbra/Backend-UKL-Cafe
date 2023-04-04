<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Hash;

class MenuController extends Controller {
    public function createMenu (Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_menu'=>'required',
            'jenis'=>'required',
            'deskripsi'=>'required',
            'gambar'=>'required',
            'harga'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }
        // $image_path = $req->file('image')->store('images','public');

        $save = Menu::create([
            'nama_menu'=>$req->get('nama_menu'),
            'jenis'=>$req->get('jenis'),
            'deskripsi'=>$req->get('deskripsi'),
            'gambar'=>$req->get('gambar'),
            'harga'=>$req->get('harga'),
        ]);
        if($save){
            return Response()->json(['status'=>true, 'message'=>'Sukses menambahkan menu']);
        } else {
            return Response()->json(['status'=>false, 'message'=>'Gagal menambahkan menu']);
        }
    }
}