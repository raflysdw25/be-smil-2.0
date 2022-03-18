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
use Illuminate\Support\Facades\Auth;

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
use App\Http\Resources\BookingPengembalianResource;
use App\Http\Resources\BookingPengembalianCollection;

class UserAccountController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api', 'isPeminjam']);
    }

    /**
     * @OA\Put(
     *     path="/api/peminjaman/update-profile/{id}",
     *     operationId="updateProfileUser",
     *     tags={"User Account - Peminjam"},
     *     summary="Update Existed User",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="User ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailResource"),
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
    public function updateUserProfile(Request $request,$id){        

        $validator = Validator::make($request->all(), [                                  
            'email' => ['email'],
            'fullname' => ['string'], 
            'phone_number' => ['string'],
            'address' => ['string', 'nullable'],
            'prodi_id' => ['numeric', 'nullable', 'exists:App\Models\Prodi,id'],
            'image_data' => ['string', 'nullable'],
        ]);        

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $user = User::with(['jabatan_user', 'staff_user', 'mahasiswa_user'])->find($request->id);

        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        try {
            $user->update([
                'email' => $request->email,
                'image_data' => $request->image_data
            ]);
            
            if($user->nip === null || $user->nip === ''){
                $user->mahasiswa_user->update([
                    'email' => $request->email,
                    'mahasiswa_fullname' => $request->fullname,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'prodi_id' => $request->prodi_id
                ]);
            }else{
                $user->staff_user->update([
                    'email' => $request->email,
                    'staff_fullname' => $request->fullname,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'prodi_id' => $request->prodi_id
                ]);
            }

            return ResponseFormatter::success($user, 'Data user berhasil diperbarui', 200);
            
            
        } catch (\Illuminate\Database\QueryException $e) {
            return ResponseFormatter::error(null, $e, 500);
        }

    }

    public function getImagePeminjam($id)
    {        

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        return ResponseFormatter::success(["image_data" => $user->image_data], 'User berhasil didapatkan', 200);
    }


    /**
     * @OA\Post(
     *     path="/api/peminjaman/get-booking-pengembalian",
     *     operationId="getBookingPengembalianUser",
     *     tags={"User Account - Peminjam"},
     *     summary="Return Users List of Booking Pengembalian by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterBookingPengembalianRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/BookingPengembalianListResource"),
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
    public function getBookingPengembalian(Request $request)
    {
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');


        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string",
            "is_mahasiswa" => "required|boolean"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        // Filter: Nama Alat, Jenis Alat, Asal Pengadaan, Tahun Pengadaan
        $bookingPengembalian = BookingPengembalian::with(['peminjaman_need_pengembalian', 'booking_by_mahasiswa', 'booking_by_staff'])->orderBy($sortBy, $sortDirection);


        if($request->is_mahasiswa == false){
            $bookingPengembalian->where('nip_staff', '=', $request->nomor_induk);
        }else{
            $bookingPengembalian->where('nim_mahasiswa', '=', $request->nomor_induk);
        }

        if($request->has('appointment_date') && $request->appointment_date != null){
            $bookingPengembalian->where('appointment_date', '=', $request->appointment_date);
        }        

        if($request->has('booking_notes') && $request->booking_notes != ''){
            $bookingPengembalian->where('booking_notes', 'ilike', '%'.$request->booking_notes.'%');
        }
        
        if($request->has('is_booking_cancel') && $request->is_booking_cancel != ''){
            if($request->is_booking_cancel != 0){
                $isBookingCancel = $request->is_booking_cancel === 1 ? false : true;
                $bookingPengembalian->where('is_booking_cancel', '=', $isBookingCancel);
            }else{
                $bookingPengembalian->whereNull('is_booking_cancel');
            }
        }

        if($request->has('process_by') && $request->process_by != ''){
            $bookingPengembalian->where('process_by', 'ilike', '%'.$request->process_by.'%');
        }
        
        
                
        $collection = new BookingPengembalianCollection($bookingPengembalian->paginate($paginate));

        return $collection;
    }

    public function getReadyReturnPeminjaman(Request $request){
        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string",
            "is_mahasiswa" => "required|boolean",
            "pjm_status" => "required|numeric"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        
    }

    /**
     * @OA\Post(
     *     path="/api/peminjaman/submit-booking-pengembalian",
     *     operationId="submitBookingPengembalian",
     *     tags={"User Account - Peminjam"},
     *     summary="Submit Booking Pengembalian",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBookingPengembalianRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/BookingPengembalianDetailResource"),
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

    public function submitBookingPengembalian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => ['numeric', 'nullable'],
            'appointment_date' => ['required', 'date'],
            'nim_mahasiswa' => ['string', 'nullable'],
            'nip_staff' => ['string', 'nullable'],
            'peminjaman_id' => ['numeric', 'nullable'],            
            'booking_notes' => ['string', 'nullable'],
            'is_booking_cancel' => ['boolean', 'nullable'],
            'is_submit_booking' => ['required','boolean'] //true : create, false: update
        ]);        

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        try {
            $bookingPengembalian = null;
            if($request->is_submit_booking == true){
                $bookingPengembalian = BookingPengembalian::create([
                    'appointment_date' => $request->appointment_date ,
                    'nim_mahasiswa' => $request->nim_mahasiswa ,
                    'nip_staff' => $request->nip_staff ,
                    'peminjaman_id' => $request->peminjaman_id ,
                    'is_booking_cancel' => null,
                    'booking_notes' => $request->booking_notes ,                
                ]);            
                return ResponseFormatter::success($bookingPengembalian, 'Booking Pengembalian berhasil dibuat', 201);
            }else{
                $bookingPengembalian = BookingPengembalian::find($request->booking_id);
                $role = $request->is_mahasiswa == true ? 'Mahasiswa' : 'Staff Jurusan';
                $fullname = $request->is_mahasiswa == true ? Auth::user()->mahasiswa_user->mahasiswa_fullname : Auth::user()->staff_user->staff_fullname;
                $process_by = $request->is_booking_cancel == true ? $fullname.' '.'('.$role.')'  : $bookingPengembalian->process_by;
                $bookingPengembalian->update([
                    'appointment_date' => $request->appointment_date ,
                    'nim_mahasiswa' => $request->nim_mahasiswa ,
                    'nip_staff' => $request->nip_staff ,
                    'peminjaman_id' => $request->peminjaman_id ,
                    'is_booking_cancel' => $request->is_booking_cancel ,
                    'booking_notes' => $request->booking_notes,
                    'process_by' => $process_by,             
                ]);
                $successWording = $request->is_booking_cancel == true ? 'Booking Pengembalian berhasil dibatalkan' : 'Booking Pengembalian berhasil diubah';
                return ResponseFormatter::success($bookingPengembalian, $successWording, 200);
            }
            
            
        } catch (\Illuminate\Database\QueryException $e) {
            return ResponseFormatter::error(null, $e, 403);
        }

    }

    /**
     * @OA\Post(
     *     path="/api/peminjaman/add-laporan-kerusakan",
     *     operationId="createNewLaporanKerusakanByUser",
     *     tags={"User Account - Peminjam"},
     *     summary="Create New LaporanKerusakan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLaporanKerusakanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/LaporanKerusakanDetailResource"),
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
