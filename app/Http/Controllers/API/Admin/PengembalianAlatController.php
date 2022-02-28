<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail; 
use App\Mail\UserVerification;
use Illuminate\Support\Facades\Hash;

// Model
use App\Models\Peminjaman;
use App\Models\DetailAlat;


// Resource
use App\Http\Resources\PeminjamanResource;


class PengembalianAlatController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * @OA\Post(
     *     path="/api/admin/get-need-returned",
     *     operationId="getNeedReturnedPeminjaman",
     *     tags={"Pengembalian Alat - Admin"},
     *     summary="Get Need Returned peminjaman",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *        required={"nomor_induk"},
     *        @OA\Property(property="nomor_induk", type="string"),
     *       ),
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/PeminjamanDetailResource"),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server"
     *      )
     * )
     */
    public function getReturnedPeminjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        // Untuk mendapatkan peminjaman dengan status 4 (belum kembali) dengan prioritas tipe peminjaman short, jika tidak ada lalu long
        $returnedPeminjaman = Peminjaman::with(['detail_peminjaman_model.barcode_alat_pinjam.alat_model', 'staff_peminjam_model', 'mahasiswa_peminjam_model', 'staff_in_charge_model', 'ruangan_model'])->orderBy('created_at', 'DESC')
            ->orderByRaw("case pjm_type when 'short' then 1 when 'long' then 2 end")           
            ->where('nip_staff', '=', $request->nomor_induk)->where('pjm_status', '=', 4)
            ->orWhere('nim_mahasiswa', '=', $request->nomor_induk)->where('pjm_status', '=', 4)->get(); 

        if(sizeof($returnedPeminjaman) == 0){
            return ResponseFormatter::success(null, 'Tidak ada peminjaman yang perlu dikembalikan', 200);
        }else{
            return ResponseFormatter::success($returnedPeminjaman, 'Peminjaman berhasil didapatkan', 200);
        }
    }


    /**
     * @OA\Put(
     *  path="/api/admin/return-peminjaman/{peminjamanId}",
     *  summary="Return Peminjaman",
     *  description="Return Peminjaman",
     *  operationId="returnPeminjaman",
     *  tags={"Pengembalian Alat - Admin"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\Parameter(
     *     name="peminjamanId",
     *     description="Peminjaman Id",
     *     required=true,
     *     in="path",
     *     @OA\Schema(
     *      type="integer"
     *     )
     *  ),
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/PeminjamDefaultResource"),          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function returnPeminjaman($peminjamanId)
    {
        $peminjaman = Peminjaman::with(['detail_peminjaman_model.barcode_alat_pinjam.alat_model'])->find($peminjamanId);
        if($peminjaman == null){
            return ResponseFormatter::error(null, 'Peminjaman tidak ditemukan', 404);
        }

        $peminjaman->pjm_status = 5;     
        $list = [];  
        foreach ($peminjaman->detail_peminjaman_model as $detail) {
            
            // Ubah Status Ketersediaan Jika alat bukan habis pakai
            $alat = DetailAlat::with(['alat_model', 'lokasi_model'])->where('barcode_alat', '=', $detail->barcode_alat)->first();
            
            if($alat->alat_model->habis_pakai == true){
                continue;
            }else{
                if($alat->condition_status === 2){
                    $alat->available_status = 2;
                }
            }
            $alat->save();             

        }

        $peminjaman->save();

        if($peminjaman){
            return ResponseFormatter::success(null, 'Pengembalian Alat selesai dilakukan', 200);
        }else{
            return ResponseFormatter::error(null, 'Pengembalian gagal dilakukan', 500);
        }
    }
}
