<?php
namespace App\Http\Controllers;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Hash;

class MejaController extends Controller {
    public function createMeja (Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nomor_meja'=>'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());
        }

        $save = Meja::create([
            'nomor_meja'=>$req->get('nomor_meja'),
        ]);
        if($save){
            return Response()->json(['status'=>true, 'message'=>'Sukses Menambah Meja']);
        } else {
            return Response()->json(['status'=>false, 'message'=>'Gagal Menambah Meja']);
        }
    }

    public function updateMeja(Request $req, $id_meja)
    {
       $validator = Validator::make($req->all(),[
        'nomor_meja'=>'required',
       ]);
       if($validator->fails()){
        return Response()->json($validator->errors()->toJson());
       }

    $ubah=Meja::where('id_meja',$id_meja)->update([
        'nomor_meja' =>$req->get('nomor_meja'),

    ]);
    if($ubah){
        return Response()->json(['status'=>true,'message' => 'Berhasil Mengubah Meja']);
    } else {
        return Response()->json(['status'=>false,'message' => 'Gagal Mengubah Meja']);
    }
    }

    public function deleteMeja($id_meja)
    {
        $hapus=Meja::where('id_meja', $id_meja)->delete();
        if($hapus){
            return Response()->json(['status'=>true, 'message' => 'Sukses Hapus Meja']);
        } else {
            return Response()->json(['status'=>false,'message' => "Gagal Hapus Meja"]);
        }
    }
}