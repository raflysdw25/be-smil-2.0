<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\UserVerification;
use Illuminate\Support\Facades\Auth;

// Email Confirmation
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationEmail;

// Resource
use App\Http\Resources\StaffLaboratoriumResource;
use App\Http\Resources\StaffLaboratoriumCollection;




// Models
use App\Models\User;
use App\Models\Staff;
use App\Models\UserVerify;



class StaffLaboratoriumController extends Controller
{
    protected $user;
    protected $isAuthorize;
    public function __construct(){
        $this->middleware('auth:api');
        
        $this->isAuthorize = Auth::user() && (Auth::user()->jabatan_id == 1 || Auth::user()->jabatan_id == 2);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/admin/user",
     *     operationId="getAllUser",
     *     tags={"User"},
     *     summary="Return List of User",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserListDefaultResource"),          
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
        // Optional, nampilin semua user, tapi di FE dibedain berdasarkan user_roles
        $user = User::with(['jabatan_user', 'staff_user'])->orderBy('id', 'ASC')->whereNotIn('user_roles', [0,2])->get();

        if($user){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List User Berhasil didapatkan"
                ],
                "data" => $user,
            ], 200);
        }

    }

    // Filter
    /**
     * @OA\Post(
     *     path="/api/admin/filter/user",
     *     operationId="getAllUserByFilter",
     *     tags={"User"},
     *     summary="Return List of User by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterUserRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/UserListResource"),
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
        
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to access this data', 403);
        }
        
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');
        
        $user = User::with(['jabatan_user', 'staff_user'])
                ->orderBy($sortBy, $sortDirection);                
        
        // Filter
        $condition = 0;

        if($request->has('nip') && $request->nip !== ""){
            $user->where('nip', 'ilike', '%'.$request->nip.'%');
        }

        if($request->has('jabatan_id') && $request->jabatan_id !== null){    
            $user->where('jabatan_id', '=', $request->jabatan_id);
        }
        
        if($request->has('hak_akses') && $request->hak_akses !== null){
            $hak_akses = $request->hak_akses;
            $today = Carbon::now()->format('Y-m-d');
            if($hak_akses === 1){
                // Hak Akses: Punya Akses
                $user->where('end_active_period', '>', $today)->where('first_login', '!=', true);
            }else if($hak_akses === 2){
                // Hak Akses: Kadaluarsa
                $user->where('end_active_period', '<', $today);
            }else if($hak_akses === 3){
                // Hak Akses : Belum Ubah Password
                $user->where([['first_login', '=', true], ['is_verified', '=', true]]);
            }else if($hak_akses === 4){
                // Hak Akses: Belum Verifikasi Email
                $user->where('is_verified', '=', false);
            }
        }


        $collection = new StaffLaboratoriumCollection($user->whereNotIn('user_roles',[0,2])->paginate($paginate));
        
        // return $collection;
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
     *     path="/api/admin/user",
     *     operationId="createNewUser",
     *     tags={"User"},
     *     summary="Create New User",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest") 
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
    public function store(Request $request)
    {
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to access this data', 403);
        }
        
        $validator = Validator::make($request->all(), [            
            // 'nip' => ['required', 'exists:App\Models\Staff,nip', 'string'],
            'id' => ['required', 'numeric'],
            'email' => ['email'],
            'start_active_period' => ['date'],
            'end_active_period' => ['date'],
            'jabatan_id' => 'required|integer|exists:App\Models\Jabatan,id'
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        
        // $user = User::create([
        //     "nip" => $request->nip,
        //     "email" => $request->email,
        //     "start_active_period" => $request->start_active_period,
        //     "end_active_period" => $request->end_active_period,
        //     "jabatan_id" => $request->jabatan_id,
        //     "is_verified" => true,
        //     'user_roles' => 1,
        // ]);

        $user = User::find($request->id);
        $user->update([            
            "start_active_period" => $request->start_active_period,
            "end_active_period" => $request->end_active_period,
            "jabatan_id" => $request->jabatan_id,            
            'user_roles' => 1,
        ]);

        // $token = Str::random(64);
  
        // UserVerify::create([
        //     'user_id' => $user->id, 
        //     'token' => $token
        // ]);

        // $verifyEmail = [
        //     "verify_name" => $request->staff_fullname,
        //     "verify_roles" => "ADMIN SISTEM",
        //     "additional_message" => "Anda baru dapat mengakses halaman admin setelah melakukan verifikasi email anda.",
        //     "token" => $token
        // ];

        // Mail::to($user->email)->queue(new ConfirmationEmail($verifyEmail));        

        if($user){
            return ResponseFormatter::success($user, 'User berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'User gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/admin/user/{id}",
     *     operationId="getAllUserById",
     *     tags={"User"},
     *     summary="Get User Detail Information",
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
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/UserDetailResource")
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
    public function show($id)
    {
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to access this data', 403);
        }

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        return ResponseFormatter::success(new StaffLaboratoriumResource($user), 'User berhasil didapatkan', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/admin/user/get-image/{id}",
     *     operationId="getUserImageById",
     *     tags={"User"},
     *     summary="Get User Image",
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
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",     
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
    public function getImageUser($id)
    {        

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        return ResponseFormatter::success(["image_data" => $user->image_data], 'User berhasil didapatkan', 200);
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
     *     path="/api/admin/user/{id}",
     *     operationId="updateExistedUser",
     *     tags={"User"},
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
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [                        
            'email' => ['email'],
            'fullname' => ['string'], 
            'phone_number' => ['string'],
            'address' => ['string'],
            'prodi_id' => ['numeric', 'nullable', 'exists:App\Models\Prodi,id'],
            'image_data' => ['string'],
        ]);        

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $user = User::with(['jabatan_user', 'staff_user'])->find($id);

        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        // Pengembangan Lanjutan: Cek berdasarkan NIM atau NIP apakah null untuk menentukan update data

        $staff = Staff::find($user->nip);

        if($staff == null){
            return ResponseFormatter::error(null, 'Staff tidak ditemukan', 404);
        }

        try {
            $user->update([
                'email' => $request->email,
                'image_data' => $request->image_data
            ]);
    
            $staff->update([
                'email' => $request->email,
                'staff_fullname' => $request->fullname,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'prodi_id' => $request->prodi_id
            ]);
    
            return ResponseFormatter::success($user, 'Data user berhasil diperbarui', 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            return ResponseFormatter::error(null, $e, 500);
        }
        
        
    }   

    /**
     * @OA\Put(
     *     path="/api/admin/user/update-jabatan/{id}",
     *     operationId="updateExistedUserJabatan",
     *     tags={"User"},
     *     summary="Update Jabatan User Admin",
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
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserJabatanRequest") 
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
    public function updateJabatan(Request $request, $id){
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to access this data', 403);
        }

        $user = User::find($id);
        if($user == null ){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            "start_active_period"=> "required|date",
            "end_active_period"=> "required|date",
            "jabatan_id"=> "required|integer|exists:App\Models\Jabatan,id",
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $user->update([
            "start_active_period" => $request->start_active_period,
            "end_active_period" => $request->end_active_period,
            "jabatan_id" => $request->jabatan_id,
        ]);

        if($user){
            return ResponseFormatter::success($user, 'Jabatan user berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Jabatan user gagal diubah', 500);
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
     *     path="/api/admin/user/{id}",
     *     operationId="deleteExistingUser",
     *     tags={"User"},
     *     summary="Delete Existed User",
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
    public function destroy($id)
    {
        if(!$this->isAuthorize){
            return ResponseFormatter::error(null, 'User Unauthorized to access this data', 403);
        }

        $user = User::find($id);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        $user->delete();
        if($user){
            return ResponseFormatter::success(null, 'User berhasil dihapus', 200);
        }else{
            return ResponseFormatter::error(null, 'User gagal dihapus', 500);
        }
    }
}
