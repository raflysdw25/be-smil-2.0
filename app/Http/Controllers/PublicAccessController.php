<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LokasiPenyimpanan;

class PublicAccessController extends Controller
{
    public function getInfoLokasi($id){
        $lokasi = LokasiPenyimpanan::with(['lokasi_detail_alat.alat_model'])->findOrFail($id);
        $detailAlat = $lokasi->lokasi_detail_alat()->paginate(5);
        return view('publicAccesses.lokasi', ["lokasi" => $lokasi, "detailAlat" => $detailAlat]);
    }

    public function redirectIndex(){
        return redirect()->route('l5-swagger.default.api');
    }
}
