<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

// Resource
use App\Http\Resources\PeminjamanResource;
use App\Http\Resources\PeminjamanCollection;




// Models
use App\Models\Peminjaman;
use App\Models\DetailAlat;
use App\Models\DetailPeminjaman;
use App\Models\LogPeminjaman;

class PeminjamanController extends Controller
{
    protected $user;
    protected $isAuthorize;
    public function __construct(){
        $this->middleware('auth:api');
        // $this->user = Auth::user();
        $this->isAuthorize = Auth::user() && Auth::user()->jabatan_id == 2;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/peminjaman",
     *     operationId="getAllPeminjamanByFilter",
     *     tags={"Peminjaman"},
     *     summary="Return List of Peminjaman by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterPeminjamanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/PeminjamanListResource"),
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
    public function filter(Request $request)
    {  
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'DESC');

        $peminjaman = Peminjaman::with(['mahasiswa_peminjam_model', 'staff_peminjam_model', 'staff_in_charge_model', 'ruangan_model', 'detail_peminjaman_model.barcode_alat_pinjam.alat_model', 'detail_peminjaman_model.alat_pinjam'])->orderBy($sortBy, $sortDirection);

        // Created At, Expected Return Date, Nomor Induk, Peminjaman Status
        if($request->has('created_date') && $request->created_date != null){
            $peminjaman->where('created_date', '=', $request->created_date);
        }
        
        if($request->has('expected_return_date') && $request->expected_return_date != null){
            $peminjaman->where('expected_return_date', '=', $request->expected_return_date);
        }
        
        if($request->has('nomor_induk') && $request->nomor_induk != ''){
            $peminjaman->where('nim_mahasiswa', 'ilike','%'.$request->nomor_induk.'%')->orWhere('nip_staff', 'ilike', '%'.$request->nomor_induk.'%');
        }
        
        if($request->has('pjm_status') && $request->pjm_status != null){
            $peminjaman->where('pjm_status', '=', $request->pjm_status);
        }

        $collection = new PeminjamanCollection($peminjaman->paginate($paginate));

        return $collection;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/admin/peminjaman/{id}",
     *     operationId="getAllpeminjamanById",
     *     tags={"Peminjaman"},
     *     summary="Get Peminjaman Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="peminjaman ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/PeminjamanDetailResource")
     *     ),
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['mahasiswa_peminjam_model', 'staff_peminjam_model', 'staff_in_charge_model', 'ruangan_model', 'detail_peminjaman_model.barcode_alat_pinjam.alat_model', 'detail_peminjaman_model.alat_pinjam', 'log_peminjaman'])->find($id);

        if($peminjaman === null){
            return ResponseFormatter::error(null,'Data Peminjaman tidak ditemukan', 404);
        }

        return ResponseFormatter::success($peminjaman, 'Data Peminjamana berhasil didapatkan', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * @OA\Put(
     *     path="/api/admin/peminjaman/approve-action/{peminjamanid}",
     *     operationId="Approve Action Peminjaman",
     *     tags={"Peminjaman"},
     *     summary="Approve Action Peminjaman ",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="peminjamanid",
     *        description="Peminjaman ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(
     *              required={"is_approved"},
     *              @OA\Property(property="is_approved",type="boolean"),
     *              @OA\Property(property="pjm_notes",type="string"),
     *          ) 
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
    public function approveAction(Request $request, $id)
    {
        // Atur agar approveAction hanya bisa dilakukan oleh user dengan Jabatan Kepala Laboratorium / Super Admin
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to do this action', 403);
        }
        // PJM Status Only change to 3 (Ditolak) & 4 (Belum Kembali)
        $peminjaman = Peminjaman::find($id);
        if($peminjaman == null){
            return ResponseFormatter::error(null,'Peminjaman tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            "is_approved" => "required|boolean",
            "pjm_notes" => "nullable|string",
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $isApproved = $request->is_approved;
        $statusPeminjaman = $isApproved ? 2 : 3;

        $peminjaman->update([
            "pjm_status" => $statusPeminjaman,
            "pjm_notes" => $request->pjm_notes,
        ]);

        if($peminjaman){
            $dataLog = [
                "peminjaman_id" => $peminjaman->id,
                "action" => $isApproved ? "ACCEPTED" : "REJECTED",
                "created_by" => Auth::user()->staff_user->staff_fullname,
            ];

            $log = LogPeminjaman::create($dataLog);
            if($log){
                return ResponseFormatter::success($peminjaman, 'Persetujuan peminjaman berhasil disimpan', 200);
            }
        }else{
            return ResponseFormatter::error(null,'Persetujuan peminjaman gagal disimpan', 500);
        }
    }

    /**
     * @OA\Post(
     *  path="/api/admin/peminjaman/cek-alat",
     *  summary="Check Alat",
     *  description="Check Alat",
     *  operationId="checkAlat",
     *  tags={"Peminjaman"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"barcode_alat", "alat_id"},
     *       @OA\Property(property="barcode_alat", type="string"),
     *       @OA\Property(property="alat_id", type="integer"),
     *    ),
     * ),
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/CheckAlatPeminjamanResource"),          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function confirmAlat(Request $request){
        $validator = Validator::make($request->all(), [
            "barcode_alat" => 'required|string',
            "alat_id" => 'required|integer'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $alat = DetailAlat::with(['alat_model'])->where('barcode_alat', '=' ,$request->barcode_alat)->first();
        if($alat){
            if($alat->condition_status == 2 && $alat->available_status == 2){
                $data = ["barcode_valid" => $alat->alat_model->id === $request->alat_id];
                return ResponseFormatter::success($data,'Alat ditemukan', 200);
            }else{
                return ResponseFormatter::success(false, 'Alat tidak dapat digunakan', 200);
            }
        }else{
            return ResponseFormatter::error(null, 'Alat tidak ditemukan', 404);
        }
    }

    /**
     * @OA\Post(
     *  path="/api/admin/peminjaman/register-alat-dipinjam/{peminjaman_id}",
     *  summary="Register Alat Dipinjam",
     *  description="Register Alat Dipinjam",
     *  operationId="registerAlatDipinjam",
     *  tags={"Peminjaman"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"list_detail_peminjaman"},
     *       @OA\Property(
     *          property="list_detail_peminjaman", type="array", 
     *          @OA\Items()
     *       ),   
     *    ),
     *  ),
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/PeminjamanDetailResource")          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function registerAlatDipinjam(Request $request, $peminjaman_id)
    {
        $validator = Validator::make($request->all(), [
            "list_detail_peminjaman" => 'required|array'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $peminjaman = Peminjaman::with(['detail_peminjaman_model'])->find($peminjaman_id);
        if($peminjaman == null){
            return ResponseFormatter::error(null, 'Peminjaman tidak ditemukan', 404);
        }

        $listDetailPeminjaman = $request->list_detail_peminjaman;
        
        foreach ($listDetailPeminjaman as $detail) {
            $getDetail = $peminjaman->detail_peminjaman_model()->where('id', '=', $detail["id"])->first();
            $getDetail->barcode_alat = $detail["barcode_alat"];            
            $getDetail->save();
            $detailAlat = $getDetail->barcode_alat_pinjam()->with(['lokasi_model', 'alat_model'])->first();
            $detailAlat->available_status = 3;
            if($detailAlat->alat_model->habis_pakai){
                $detailAlat->condition_status = 4;
                $detailAlat->lokasi_model()->decrement('stored_capacity');
                $detailAlat->lokasi_model()->increment('available_capacity');
            }
            $detailAlat->save();
        }

        $peminjaman->pjm_status = 4;
        $peminjaman->save();

        $dataLog = [
            "peminjaman_id" => $peminjaman->id,
            "action" => "REGISTER",
            "created_by" => Auth::user()->staff_user->staff_fullname,
        ];

        $log = LogPeminjaman::create($dataLog);

        return ResponseFormatter::success($peminjaman, 'Alat berhasil didaftarkan', 200);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *     path="/api/admin/peminjaman/{id}",
     *     operationId="deleteExistingPeminjaman",
     *     tags={"Peminjaman"},
     *     summary="Delete Existed Peminjaman",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Peminjaman ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/DeleteDefaultResource")
     *     ),
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
    public function destroy($id)
    {
        if($this->isAuthorize == false){
            return ResponseFormatter::error(null, 'User Unauthorized to do this action', 403);
            
        }
        $peminjaman = Peminjaman::find($id);

        if($peminjaman == null){
            return ResponseFormatter::error(null, 'Peminjaman tidak ditemukan', 404);
        }
        try {
            
            $peminjaman->delete();           
            return ResponseFormatter::error(null, 'Peminjaman berhasil dihapus', 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[0];            
            return ResponseFormatter::error(null, $e->errorInfo[2], 403);
        }
        
    }
}
