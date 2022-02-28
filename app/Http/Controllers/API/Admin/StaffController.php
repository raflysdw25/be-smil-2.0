<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
// use Mail; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\UserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Email Confirmation
use App\Mail\ConfirmationEmail;


// Resource and Collection
use App\Http\Resources\StaffResource;
use App\Http\Resources\StaffCollection;


// Model
use App\Models\Staff;
use App\Models\User;
use App\Models\UserVerify;

class StaffController extends Controller
{


    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/admin/staff",
     *     operationId="getAllStaff",
     *     tags={"Staff"},
     *     summary="Return List of Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffListDefaultResource"),          
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
    public function index()
    {

        $staff = Staff::with(['staff_prodi'])->whereNotIn('nip',['admin'])->orderBy('created_at', 'ASC')->get();
        
        if($staff){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Staff Berhasil didapatkan"
                ],
                "data" => $staff,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Staff Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/admin/staff/list/un-register-staff",
     *     operationId="getAllUnregisterStaffLab",
     *     tags={"Staff"},
     *     summary="Return List of Unregister Staff Lab",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffListDefaultResource"),          
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
    public function unRegisterStaff()
    {
        // Untuk memanggil List Staff Jurusan yang belum terdaftar sebagai admin SMIL
        // $staff = DB::table('staff')->leftJoin('users', 'staff.nip', '=', 'users.nip')->where('users.nip', '=', null)->whereNotIn('staff.nip',['admin'])->orderBy('staff.created_at','ASC')->select('staff.*')->get();

        $staff = User::with(['staff_user'])->where('user_roles', '=', 2)->where('nip', '!=', null)->orderBy('id', 'ASC')->get();

        if($staff){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Staff Belum terdaftar didapatkan"
                ],
                "data" => $staff,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "failed",
                    "mesasge" => "List Staff Belum Terdaftar Gagal didapatkan"
                ],
                "data" => null,
            ], 500);
        }
    }
    
    /**
     * @OA\Post(
     *     path="/api/admin/filter/staff",
     *     operationId="getAllStaffByFilter",
     *     tags={"Staff"},
     *     summary="Return List of Staff by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="page",
     *        description="Page",
     *        required=false,
     *        in="query",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffListResource"),
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
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'ASC');

        $staff = Staff::with(['staff_prodi'])->orderBy($sortBy,$sortDirection);

        
        // Filter berdasarkan nip
        if($request->has('nip') && $request->nip !== ''){
            $staff->where('nip', 'ilike', '%'.$request->nip.'%');
        }
        
        // Filter berdasarkan nama staff
        if($request->has('staff_fullname') && $request->staff_fullname !== ''){
            $staff->where('staff_fullname', 'ilike', '%'.$request->staff_fullname.'%');
        }
        
        // Filter berdasarkan prodi id
        if($request->has('prodi_id') && $request->prodi_id !== null){
            $staff->where('prodi_id', '=', $request->prodi_id);
        }
        
        // Filter berdasarkan email
        if($request->has('email') && $request->email !== ''){
            $staff->where('email', 'ilike', '%'.$request->email.'%');
        }

        

        $collection = new StaffCollection($staff->whereNotIn('nip', ['admin'])->paginate($paginate));
        return $collection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/admin/staff",
     *     operationId="createNewStaff",
     *     tags={"Staff"},
     *     summary="Create New Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffDetailResource"),
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:App\Models\Staff,nip',
            'staff_fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'prodi_id' => 'nullable|integer|exists:App\Models\Prodi,id',            
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $staff = Staff::create([
            'nip' => $request->nip,
            'staff_fullname' => $request->staff_fullname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'prodi_id' => $request->prodi_id,
            'is_verified' => true,
        ]);

        if($staff){
            $user = User::create([
                "nip" => $staff->nip,
                "email" => $staff->email,
                "password" => bcrypt($staff->nip),                
                "is_verified" => true,
                'user_roles' => 2,
            ]);
            if($user){
                return ResponseFormatter::success($staff, 'Staff berhasil ditambahkan', 201);
            }else{
                return ResponseFormatter::error(null, 'Staff gagal ditambahkan');
            }
        }else{
            return ResponseFormatter::error(null, 'Staff gagal ditambahkan');
        }

        
        // $token = Str::random(64);
  
        // UserVerify::create([
        //     'nip_staff' => $staff->nip, 
        //     'token' => $token
        // ]);

        // // Send Confirmation Email
        // $verifyEmail = [
        //     "verify_name" => $staff->staff_fullname,
        //     "verify_roles" => "STAFF JURUSAN",
        //     "additional_message" => "Anda baru dapat melakukan proses peminjaman setelah
        //     melakukan verifikasi email anda.",
        //     "token" => $token
        // ];

        // // Send Confirmation Email
        // Mail::to($staff->email)->queue(new ConfirmationEmail($verifyEmail));

        
    }

    /**
     * @OA\Get(
     *     path="/api/admin/staff/resend-email-verify/{nip}",
     *     operationId="resendEmailVerify",
     *     tags={"Staff"},
     *     summary="Resend Email Verify",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/StaffDetailResource")
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

    public function resendVerifyEmail($nip){
        $staff = Staff::find($nip);

        if($staff == null){
            return ResponseFormatter::error(null, 'Staff tidak ditemukan', 404);
        }

        if($staff->is_verified){
            return ResponseFormatter::success(null, 'Staff sudah terverifikasi');
        }

        $userVerify = UserVerify::where('nip_staff', '=', $nip)->first();
        $verifyEmail = [
            "verify_name" => $staff->staff_fullname,
            "verify_message" => "Email anda telah didaftarkan pada Sistem Manajemen Inventaris Laboratorium Teknik Informatika dan Komputer Politeknik Negeri Jakarta. Untuk melanjutkan proses peminjaman Alat melalui sistem ini, silahkan verifikasi email anda melalui link dibawah ini",
            "additional_message" => "Anda baru dapat melakukan proses peminjaman setelah
            melakukan verifikasi email anda.",
            "token" => $userVerify->token
        ];
        $request = new Request();
        $request->email = $staff->email;
        Mail::send('emails.emailVerificationEmail', ['verifyEmail' => $verifyEmail], function($message) use($request){
            $message->to($request->email);
            $message->subject('Verifikasi Email Staff');
        });

        return ResponseFormatter::success($staff, 'Verifikasi Email berhasil dikirimkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/admin/staff/{nip}",
     *     operationId="getAllStaffByNip",
     *     tags={"Staff"},
     *     summary="Get Staff Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/StaffDetailResource")
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
    public function show($nip)
    {
        try {
            $staff = Staff::findOrFail($nip);
            return ResponseFormatter::success(new StaffResource($staff), 'Staff berhasil didapatkan', 200);
            //code...
        } catch (ModelNotFoundException $exception) {
            //throw $th;
            return ResponseFormatter::error(null, $exception->getMessage());
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *     path="/api/admin/staff/{nip}",
     *     operationId="updateExistedStaff",
     *     tags={"Staff"},
     *     summary="Update Existed Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreStaffRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/StaffDetailResource"),
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
    public function update(Request $request, Staff $staff)
    {
        $validator = Validator::make($request->all(), [
            'nip' => ['required', Rule::unique('App\Models\Staff')->ignore($staff->nip, 'nip')],
            'staff_fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'prodi_id' => 'integer'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }


        $staff->update($request->all());
        if($staff){
            return ResponseFormatter::success($staff, 'Staff berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Staff gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *     path="/api/admin/staff/{nip}",
     *     operationId="deleteExistingStaff",
     *     tags={"Staff"},
     *     summary="Delete Existed Staff",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="nip",
     *        description="Staff NIP",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="string"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/DeleteDefaultResource"),
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
    public function destroy($nip)
    {
        $staff = Staff::find($nip);
        if($staff == null){
            return ResponseFormatter::error(null, 'Staff tidak ditemukan', 404);
        }
        
        try {
            
            $staff->delete();
            return ResponseFormatter::success(null, 'Staff berhasil dihapus', 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[0];
            if($errorCode == "23503"){
                return ResponseFormatter::error(null, 'Staff masih digunakan', 403);
            }else{
                return ResponseFormatter::error(null, $e->errorInfo[2], 403);
            }
        }

       
    }
}
