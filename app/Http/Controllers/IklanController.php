<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\iklan;

class IklanController extends Controller
{
    public function index($limit = 10, $offset = 0)
   {
       $data["count"] = iklan::count();
       $iklan = array();

        foreach(iklan::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"               => $p->id,
                "nama_barang"      => $p->nama_barang,
                "deskripsi"        => $p->deskripsi,
                "harga"            => $p->harga,
                'created_at'       => $p->created_at,
				'updated_at'       => $p->updated_at,
            ];
            array_push($iklan, $item);
        }
        $data["iklan"] = $iklan;
        $data["status"] = 1;
        return response($data);
   }

   public function store(Request $request)
   {
       $iklan = new iklan([
           'nama_barang'         => $request->nama_barang,
           'deskripsi'           => $request->deskripsi,
           'harga'               => $request->harga,
       ]);

       $iklan->save();
       return response()->json([
        'status'  => '1',
        'message' => 'Data Iklan Berhasil Ditambahkan'
       ]);
   }

   public function show($id)
   {
       $iklan = iklan::where('id', $id)->get();

       $dataiklan = array();
       foreach($iklan as $p) {
            $item = [
                'nama_barang'         => $p->nama_barang,
                'deskripsi'           => $p->deskripsi,
                'harga'               => $p->harga,
            ];
            array_push($dataiklan, $item);
       }

       $data["Data Iklan"] = $dataiklan;
       $data["status"] = 1;
       return response($data);
   }

   public function update($id, Request $request)
   {
       $iklan = iklan::where('id', $id)->first();

       $iklan->nama_barang     = $request->nama_barang;
       $iklan->deskripsi       = $request->deskripsi;
       $iklan->harga           = $request->harga;
       $iklan->updated_at      = now()->timestamp;

       $iklan->save();

       return response()->json([
        'status'  => '1',
        'message' => 'Data Iklan Berhasil Diubah'
       ]);
   }

   public function destroy($id)
   {
        $iklan = iklan::where('id', $id)->first();

        $iklan->delete();

        return response()->json([
            'status'  => '1',
            'message' => 'Data Iklan Berhasil Dihapus'
        ]);
   }
}

