<?php

namespace App\Http\Controllers\API\Peminjaman;

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
use App\Models\Mahasiswa;
use App\Models\UserVerify;
use App\Models\Staff;
use App\Models\Peminjaman;
use App\Models\LaporanKerusakan;
use App\Models\Ruangan;
use App\Models\Alat;
use App\Models\DetailAlat;
use App\Models\DetailPeminjaman;
use App\Models\LokasiPenyimpanan;
use App\Models\Prodi;

// Resource
use App\Http\Resources\MahasiswaResource;
use App\Http\Resources\StaffResource;
use App\Http\Resources\PeminjamanResource;
use App\Http\Resources\LaporanKerusakanResource;
use App\Http\Resources\RuanganResource;
use App\Http\Resources\AlatResource;
use App\Http\Resources\DetailAlatResource;
use App\Http\Resources\LokasiPenyimpananResource;
use App\Http\Resources\ProdiResource;

class BuatLaporanController extends Controller
{
    // public function __construct(){
    //     $this->middleware(['auth', 'api']);
    // }

    // UNUSED
    /**
     * @OA\Post(
     *  path="/api/peminjaman/cek-pelapor",
     *  summary="Check Reporter",
     *  description="Check Reporter",
     *  operationId="checkReport",
     *  tags={"Buat Laporan Kerusakan - Peminjam"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"nomor_induk"},
     *       @OA\Property(property="nomor_induk", type="string"),
     *    ),
     * ),
     *  @OA\Response(
     *    response="200", 
     *    description="Success",          
     *    @OA\JsonContent(ref="#/components/schemas/CekPelaporResource"),
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function confirmPeminjam(Request $request){
        $validator = Validator::make($request->all(), [
            "nomor_induk" => 'required|string'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $valid = false;
        $pelapor = '';

        $mahasiswa = Mahasiswa::find($request->nomor_induk);
        if($mahasiswa == null){
            $staff = Staff::find($request->nomor_induk);
            if($staff == null){
                $pelapor = 'unknown';
            }else{
                $pelapor = 'staff';
                $valid = true;
            }
        }else{
            $valid = true;
            $pelapor = 'mahasiswa';
        }

        $data = [
            "valid" => $valid,
            "pelapor" => $pelapor
        ];
        return ResponseFormatter::success($data, 'Pemeriksaan berhasil dilakukan', 200);
    }
   
    public function addNewLaporanKerusakan(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string",
            "barcode_alat" => "required|string|exists:App\Models\DetailAlat,barcode_alat",
            "chronology" => "required|string",
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->erros(), 400);
        }
        
        $nip_staff = '';
        $nim_mahasiswa = '';
        $mahasiswa = Mahasiswa::find($request->nomor_induk);
        if($mahasiswa == null){
            $staff = Staff::find($request->nomor_induk);
            if($staff == null){
                return ResponseFormatter::error(null, 'Pelapor tidak ditemukan', 404);
            }else{
                $nip_staff = $request->nomor_induk;
            }
        }else{
           $nim_mahasiswa = $request->nomor_induk;
        } 

        $laporan = LaporanKerusakan::create([
            "nim_mahasiswa" => $nim_mahasiswa,
            "nip_staff" => $nip_staff,
            "barcode_alat" => $request->barcode_alat,
            "chronology" => $request->chronology,
            "report_status" => 1,
            "report_date" => Carbon::now()
        ]);

        $laporan->barcode_alat_rusak()->update([
            "condition_status" => 1,
            "available_status" => 1,
        ]);

        if($laporan){
            return ResponseFormatter::success(new LaporanKerusakanResource($laporan), 'Laporan kerusakan berhasil dibuat', 201);
        }else{
            return ResponseFormatter::error(null, 'Laporan Kerusakan gagal dibuat', 500);
        } 
    }
}
