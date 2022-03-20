<?php

namespace App\Http\Controllers\API\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\UserVerification;
use Illuminate\Support\Facades\Hash;

// Email Confirmation
use Illuminate\Support\Facades\Mail;
use App\Mail\PeminjamanAlatEmail;

// Model
use App\Models\Peminjaman;
use App\Models\Mahasiswa;
use App\Models\DetailAlat;
use App\Models\DetailPeminjaman;
use App\Models\Staff;
use App\Models\LogPeminjaman;

// Resources & Collections 
use App\Http\Resources\PeminjamanResource;
use App\Http\Resources\PeminjamanCollection;

class PeminjamanAlatController extends Controller
{

    public function __construct(){
        $this->middleware(['auth:api', 'isPeminjam']);
    }

    /**
     * @OA\Post(
     *     path="/api/peminjaman/cek-peminjaman",
     *     operationId="getDataPeminjaman",
     *     tags={"Peminjaman Alat - Peminjam"},
     *     summary="Check latest peminjaman",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterPeminjamanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/PeminjamanListDefaultResource"),
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

    //Untuk dapet data peminjaman terbaru
    public function getRecentPeminjaman(Request $request)
    {
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'DESC');

        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string",
            "is_mahasiswa" => "required|boolean"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $recentPeminjaman = Peminjaman::with(['detail_peminjaman_model.barcode_alat_pinjam.alat_model', 'detail_peminjaman_model.alat_pinjam', 'mahasiswa_peminjam_model', 'staff_peminjam_model'])            
            ->orderBy($sortBy, $sortDirection);
        
        if($request->is_mahasiswa == false){
            $recentPeminjaman->where('nip_staff', '=', $request->nomor_induk);
        }else{
            $recentPeminjaman->where('nim_mahasiswa', '=', $request->nomor_induk);
        }

        // Created At, Expected Return Date, Nomor Induk, Peminjaman Status
        if($request->has('created_date') && $request->created_date != null){
            $recentPeminjaman->where('created_date', '=', $request->created_date);
        }
        
        if($request->has('expected_return_date') && $request->expected_return_date != null){
            $recentPeminjaman->where('expected_return_date', '=', $request->expected_return_date);
        }

        if($request->has('pjm_status') && $request->pjm_status != null){
            $recentPeminjaman->where('pjm_status', '=', $request->pjm_status);
        }

        $collection = new PeminjamanCollection($recentPeminjaman->paginate($paginate));
        return $collection;        
    }
    
    /**
     * @OA\Post(
     *  path="/api/peminjaman/cek-alat",
     *  summary="Check Alat",
     *  description="Check Alat",
     *  operationId="checkAlat",
     *  tags={"Peminjaman Alat - Peminjam"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"barcode_alat"},
     *       @OA\Property(property="barcode_alat", type="string"),
     *    ),
     * ),
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/ConfirmAlatResource"),          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */

    public function confirmAlat(Request $request){
        $validator = Validator::make($request->all(), [
            "barcode_alat" => 'required|string'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $alat = DetailAlat::with(['alat_model'])->where('barcode_alat', '=' ,$request->barcode_alat)->first();
        if($alat){
            if($alat->condition_status == 2){
                $data = [
                    "alat_name" => $alat->alat_model->alat_name,
                    "barcode_alat" => $alat->barcode_alat
                ];
                return ResponseFormatter::success($data,'Alat ditemukan', 200);
            }else{
                return ResponseFormatter::success(null, 'Alat dalam keadaan rusak', 200);
            }
        }else{
            return ResponseFormatter::error(null, 'Alat tidak ditemukan', 404);
        }
    }


    // UNUSED
    // Untuk mendapatkan data mahasiswa atau staff untuk peminjaman
    /**
     * @OA\Post(
     *     path="/api/peminjaman/get-peminjam",
     *     operationId="getDataPeminjam",
     *     tags={"Peminjaman Alat - Peminjam"},
     *     summary="Get Data Peminjam",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *        required={"nomor_induk"},
     *        @OA\Property(property="nomor_induk", type="string"),
     *       ),
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/InfoPeminjamResource"),
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
    public function getDataPeminjam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nomor_induk" => "required|string"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }
        // Get Data peminjam
        $nomor_induk = null;
        $mahasiswa = Mahasiswa::find($request->nomor_induk);
        if($mahasiswa == null){
            $staff = Staff::find($request->nomor_induk);
            if($staff == null){
                return ResponseFormatter::error(null, 'Peminjam tidak ditemukan', 404);
            }else{
                if(!$staff->is_verified){
                    return ResponseFormatter::success(null, 'Email Staff belum diverifikasi');
                }
                $nomor_induk = $staff->nip;
                $data = [
                    "nim_mahasiswa"=> "",
                    "nip_staff" => $staff->nip,
                    "staff_fullname" => $staff->staff_fullname,
                    "mahasiswa_fullname" => "",
                ];                
            }
        }else{
            if(!$mahasiswa->is_verified){
                return ResponseFormatter::success(null, 'Email Mahasiswa belum diverifikasi');
            }
            $nomor_induk = $mahasiswa->nim;
            $data = [
                "nim_mahasiswa" => $mahasiswa->nim,
                "nip_staff" => "",
                "staff_fullname" => "",
                "mahasiswa_fullname" => $mahasiswa->mahasiswa_fullname
            ];
        }

        return ResponseFormatter::success($data, 'Data Peminjam berhasil didapatkan', 200);        
    }


    /**
     * @OA\Post(
     *     path="/api/peminjaman/add-peminjaman",
     *     operationId="createDataPeminjam",
     *     tags={"Peminjaman Alat - Peminjam"},
     *     summary="Create New Peminjaman",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StorePeminjamanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
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
    public function createPeminjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nim_mahasiswa" => "nullable|string|exists:App\Models\Mahasiswa,nim",           
            "nip_staff" => "nullable|string|exists:App\Models\Staff,nip",           
            "nip_staff_in_charge" => "nullable|string|exists:App\Models\Staff,nip",           
            "pjm_purpose" => 'required|string',
            "ruangan_id" => 'nullable|integer|exists:App\Models\Ruangan,id',
            "expected_return_date" => "required|date",
            "pjm_type" => 'in:long,short',
            "pjm_status" => "nullable|integer", 
            "list_alat" => "required|array"
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }
        

        $pjm_status = $request->pjm_status; //Status Peminjaman
        

        // Jika Peminjaman Status null (Bukan Booking Peminjaman)
        if($pjm_status == null){
            $pjm_status = 4;
        }

        $peminjaman = Peminjaman::create([
            "nim_mahasiswa" => $request->nim_mahasiswa,
            "nip_staff" => $request->nip_staff,
            "nip_staff_in_charge" => $request->nip_staff_in_charge,
            "pjm_purpose" => $request->pjm_purpose,
            "ruangan_id" => $request->ruangan_id,
            "expected_return_date" => $request->expected_return_date,
            "pjm_type" => $request->pjm_type,
            "pjm_status" =>$pjm_status,
            "created_date" => Carbon::now(),
        ]);

        $list_alat = $request->list_alat;
        if($peminjaman){
            // Kalo booking peminjaman
            foreach ($list_alat as $alat) {
                $alatId = null;
                $barcodeAlat = null;

                if($pjm_status === 1){
                    $alatId = $alat;
                }else{
                    $barcodeAlat = $alat;
                    $detailAlat = DetailAlat::with(['alat_model', 'lokasi_model'])->where('barcode_alat', '=', $barcodeAlat)->first();
                    // Perlu cek apakah alat habis pakai atau tidak, jika habis pakai, available status 3, condition status 4 (habis), lokasi : stored decrement, available increment
                    if($detailAlat->alat_model->habis_pakai){
                        $detailAlat->update([
                            "available_status" => 3,
                            "condition_status" => 4,
                        ]);
                        $detailAlat->lokasi_model()->decrement('stored_capacity');
                        $detailAlat->lokasi_model()->increment('available_capacity');
                    }else{
                        $detailAlat->update([
                            "available_status" => 3
                        ]);
                    }

                    $alatId = $detailAlat->alat_id;
                }

                $detailPeminjaman[] = new DetailPeminjaman([                    
                    'alat_id' => $alatId,
                    'barcode_alat' => $barcodeAlat,
                ]);
            }

            $peminjaman->detail_peminjaman_model()->saveMany($detailPeminjaman);
            

            $dataLog = [
                "peminjaman_id" => $peminjaman->id,
                "action" => "CREATED",
                "created_by" => Auth::user()->nip === null || Auth::user()->nip === "" ? Auth::user()->mahasiswa_user->mahasiswa_fullname : Auth::user()->staff_user->staff_fullname,
            ];

            $log = LogPeminjaman::create($dataLog);

            // $this->sendEmailPeminjaman($peminjaman->id);

            return ResponseFormatter::success($peminjaman,'Peminjaman berhasil dilakukan', 201);
        }
    }

    protected function sendEmailPeminjaman($peminjamanId){
        $request = new Request();
        $peminjaman = Peminjaman::with(
            [
                'mahasiswa_peminjam_model', 
                'staff_peminjam_model', 
                'staff_in_charge_model', 
                'ruangan_model', 
                'detail_peminjaman_model.barcode_alat_pinjam',
                'detail_peminjaman_model.alat_pinjam'
            ])->find($peminjamanId);

        $notification = [            
            "peminjam_name" => "", 
            "in_charge" => "-",
            "expected_return_date" => Carbon::createFromFormat('Y-m-d', $peminjaman->expected_return_date)->format('d F Y'),
            "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman->created_at)->format('d F Y'),
        ];
        $request->email = "";

        if($peminjaman->nim_mahasiswa != null){
            $notification["peminjam_name"] = $peminjaman->mahasiswa_peminjam_model->mahasiswa_fullname;
            $request->email = $peminjaman->mahasiswa_peminjam_model->email;
        }
        
        if($peminjaman->nip_staff != null){
            $notification["peminjam_name"] = $peminjaman->staff_peminjam_model->staff_fullname;
            $request->email = $peminjaman->staff_peminjam_model->email;
        }
        
        if($peminjaman->nip_staff_in_charge != null){
            $notification["in_charge"] = $peminjaman->nip_staff_in_charge.' - '.$peminjaman->staff_in_charge_model->staff_fullname;
        }

        // if($peminjaman->pjm_status == 1){
        //     $notification["message_peminjaman"] = "Perlihatkan email ini kepada staff laboratorium pada saat pengambilan alat.";
        // }else{
        //     $notification["message_peminjaman"] = "Kembalikan alat yang telah dipinjam tepat pada waktunya";
        // }

        $notification = (Object) $notification;
        Mail::to($request->email)->queue(new PeminjamanAlatEmail($peminjaman, $notification));

        // Mail::send('emails.emailNotificationBooking', ['peminjaman' => $peminjaman, "notification" => $notification], function($message) use($request){
        //     $message->to($request->email);
        //     $message->subject('Bukti Peminjaman Alat Laboratorium');
        // });

    }
}
