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

    public function updateMenu(Request $req, $id_menu)
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
    //    $image_path = $req->file('image')->store('images','public');

    $ubah=Menu::where('id_menu',$id_menu)->update([
        'nama_menu' =>$req->get('nama_menu'),
        'jenis' =>$req->get('jenis'),
        'deskripsi' =>$req->get('deskripsi'),
        'gambar' =>$req->get('gambar'),
        'harga' =>$req->get('harga'),

    ]);
    if($ubah){
        return Response()->json(['status'=>true,'message' => 'Berhasil Mengubah Menu']);
    } else {
        return Response()->json(['status'=>false,'message' => 'Gagal Mengubah Menu']);
    }
    }

    public function deleteMenu($id_menu)
    {
        $hapus=Menu::where('id_menu', $id_menu)->delete();
        if($hapus){
            return Response()->json(['status'=>true, 'message' => 'Sukses Hapus Menu']);
        } else {
            return Response()->json(['status'=>false,'message' => "Gagal Hapus Menu"]);
        }
    }
}