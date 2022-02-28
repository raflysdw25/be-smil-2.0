<?php

namespace App\Http\Controllers\API\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\UserVerification;
use Illuminate\Support\Facades\Hash;

// Email Confirmation
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;

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
use App\Models\User;
use App\Models\BookingPengembalian;

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

class PeminjamController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/peminjaman/get-staff",
     *  summary="Get List Staff",
     *  description="Get List Staff",
     *  operationId="getListStaff",
     *  tags={"Peminjam"},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function getStaff(){
        $listStaff = Staff::orderBy('staff_fullname', 'ASC')->whereNotIn('nip', ['admin'])->get();
        $newListStaff = [];
        foreach ($listStaff as $staff) {
            $data = [
                "nip" => $staff->nip,
                "staff_fullname" => $staff->staff_fullname
            ];
            array_push($newListStaff,$data);
        }
        if($listStaff){
            return ResponseFormatter::success($newListStaff,'List Staff berhasil didapatkan', 200);
        }else{
            return ResponseFormatter::error(null, 'List Staff gagal didapatkan', 500);
        }
    }
    /**
     * @OA\Get(
     *  path="/api/peminjaman/get-ruangan",
     *  summary="Get List Ruangan",
     *  description="Get List Ruangan",
     *  operationId="getListRuangan",
     *  tags={"Peminjam"},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/RuanganListDefaultResource"),          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function getRuangan(){
        $ruangan = Ruangan::orderBy('id', 'ASC')->get();
        if($ruangan){
            return ResponseFormatter::success($ruangan,'List Ruangan berhasil didapatkan', 200);
        }else{
            return ResponseFormatter::error(null, 'List Ruangan gagal didapatkan', 500);
        }
    }
    /**
     * @OA\Get(
     *  path="/api/peminjaman/get-alat",
     *  summary="Get List Alat",
     *  description="Get List Alat",
     *  operationId="getListAlat",
     *  tags={"Peminjam"},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/ListAlatPinjamResource")          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function getAlat(){
        $listAlat = Alat::with(['details'])->orderBy('id', 'ASC')->where('can_borrowed', true)->get();
        
        $newList = [];
        foreach ($listAlat as $alat) {
            $alat_available = $alat->details()->where('available_status', '=', 2)->count();
            if($alat_available == 0){
                continue;
            }else{
                $data = [
                    "id" => $alat->id,
                    "alat_name" => $alat->alat_name,
                    "alat_available" => $alat_available
                ];
                array_push($newList,$data);
            }
        }
        if($listAlat){
            return ResponseFormatter::success($newList,'List Alat berhasil didapatkan', 200);
        }else{
            return ResponseFormatter::error(null, 'List Alat gagal didapatkan', 500);
        }
    }
    /**
     * @OA\Get(
     *  path="/api/peminjaman/get-prodi",
     *  summary="Get List Prodi",
     *  description="Get List Prodi",
     *  operationId="getListProdi",
     *  tags={"Peminjam"},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/ProdiListDefaultResource"),                    
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function getProdi(){
        $prodi = Prodi::orderBy('id', 'ASC')->get();
        if($prodi){
            return ResponseFormatter::success($prodi,'List Prodi berhasil didapatkan', 200);
        }else{
            return ResponseFormatter::error(null, 'List Prodi gagal didapatkan', 500);
        }
    }
    
    /**
     * @OA\Post(
     *     path="/api/peminjaman/add-mahasiswa",
     *     operationId="createNewMahasiswa",
     *     tags={"Peminjam"},
     *     summary="Create New Mahasiswa",
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMahasiswaRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/MahasiswaDetailResource"),
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
    public function addNewMahasiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|unique:App\Models\Mahasiswa,nim',
            'mahasiswa_fullname' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'register_year' => 'required|string',
            'address'=> 'nullable|string',
            'prodi_id' => 'required|integer|exists:App\Models\Prodi,id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 404);
        }

        
        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'mahasiswa_fullname' => $request->mahasiswa_fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'register_year' => $request->register_year,
            'address'=> $request->address,
            'prodi_id' => $request->prodi_id,
            'is_verified' => true,
        ]);

        if($mahasiswa){
            $user = User::create([
                "nim" => $mahasiswa->nim,
                "email" => $mahasiswa->email,
                "password" => bcrypt($mahasiswa->nim),                
                "is_verified" => true,
                'user_roles' => 2,
            ]);

            if($user){
                return ResponseFormatter::success(new MahasiswaResource($mahasiswa), 'Mahasiswa berhasil ditambahkan', 201);
            }else{
                return ResponseFormatter::error(null, 'Mahasiswa gagal ditambahkan', 500);
            }
        }else{
            return ResponseFormatter::error(null, 'Mahasiswa gagal ditambahkan', 500);
        }

        // $token = Str::random(64);
  
        // UserVerify::create([
        //     'nim_mahasiswa' => $mahasiswa->nim, 
        //     'token' => $token
        // ]);

        // $verifyEmail = [
        //     "verify_name" => $mahasiswa->mahasiswa_fullname,
        //     "verify_roles" => "MAHASISWA",
        //     "additional_message" => "Anda baru dapat melakukan proses peminjaman setelah melakukan verifikasi email anda.",
        //     "token" => $token
        // ];

        // // Send Confirmation Email
        // Mail::to($staff->email)->queue(new ConfirmationEmail($verifyEmail));                
    }

}
