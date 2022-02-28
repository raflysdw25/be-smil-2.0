<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'loginPeminjam']]);
    }

    protected function guard(){
        return Auth::guard('api');
    }

    /**
     * @OA\Post(
     * path="/api/auth/login",
     * summary="Login Admin",
     * description="Login Admin by nip, and password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"nip","password"},
     *       @OA\Property(property="nip", type="string"),
     *       @OA\Property(property="password", type="string", format="password"),
     *    ),
     * ),
     * @OA\Response(
     *   response="200", 
     *   description="Success",
     *   @OA\JsonContent(ref="#/components/schemas/AuthorizationResource"),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     * 
     */
    public function login(Request $request){
        
        $validasi = Validator::make($request->all(), [
            "nip" => "required|string",
            "password" => "required|string"
        ]);

        if($validasi->fails()){
            return ResponseFormatter::error(null, $validasi->errors(), 400);
        }

        $token_validity = (24*60);
        auth()->factory()->setTTL($token_validity);

        if(!$token = auth()->attempt($validasi->validate())){
            return ResponseFormatter::error(null, "NIP atau Password tidak sesuai, silahkan coba kembali", 403);
        }

        if(Auth::user()->user_roles === 2){
            return ResponseFormatter::error(null, "User tidak memiliki akses", 403);
        }
        
        if(!Auth::user()->is_verified){
            return ResponseFormatter::error(null, "Silahkan verifikasi email anda terlebih dahulu", 403);
        }
        

        // Cek Period Active
        $today = Carbon::now()->format('Y-m-d');
        if(Auth::user()->end_active_period < $today){
            return ResponseFormatter::error(null, "Masa aktif akun anda sudah habis, silahkan hubungi kepala laboratorium", 403);
        }

        return $this->responseWithToken($token);
    }


    /**
     * @OA\Post(
     * path="/api/auth/login-peminjam",
     * summary="Login Peminjam",
     * description="Login Peminjam by nip or nim, and password",
     * operationId="authLoginPeminjam",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"password"},
     *       @OA\Property(property="nip", type="string"),
     *       @OA\Property(property="nim", type="string"),
     *       @OA\Property(property="password", type="string", format="password"),
     *    ),
     * ),
     * @OA\Response(
     *   response="200", 
     *   description="Success",
     *   @OA\JsonContent(ref="#/components/schemas/AuthorizationResource"),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     * 
     */

    //  Referensi : https://websolutionstuff.com/post/login-with-mobile-number-using-laravel-custom-auth
    // Ide: Tambah kolom nomor_induk untuk proses login peminjam
    public function loginPeminjam(Request $request){
        
        $validasi = Validator::make($request->all(), [
            "nip" => ["string", 'nullable'],
            "nim" => ["string", 'nullable'],
            "password" => "required|string"
        ]);

        if($validasi->fails()){
            return ResponseFormatter::error(null, $validasi->errors(), 400);
        }

        $token_validity = (24*60);
        auth()->factory()->setTTL($token_validity);

        if(!$token = auth()->attempt($validasi->validate())){
            return ResponseFormatter::error(null, "Nomor Induk atau Password tidak sesuai, silahkan coba kembali", 403);
        }

        if(Auth::user()->user_roles === 0){
            return ResponseFormatter::error(null, "User tidak memiliki akses", 403);
        }
        
        if(!Auth::user()->is_verified){
            return ResponseFormatter::error(null, "Silahkan verifikasi email anda terlebih dahulu", 403);
        }
        

        return $this->responseWithToken($token);
    }

    /**
     * @OA\Post(
     * path="/api/auth/change-password/{userId}",
     * summary="ChangePasswordAuth",
     * description="Change Password for first Login",
     * operationId="authChangePassword",
     * security={ {"bearerAuth": {} }},
     * tags={"Authentication"},
     *     @OA\Parameter(
     *        name="userId",
     *        description="User ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"password","password_confirmation"},
     *       @OA\Property(property="password", type="string", format="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="password"),
     *    ),
     * ),
     * @OA\Response(
     *   response="200", 
     *   description="Success",
     *   @OA\JsonContent(ref="#/components/schemas/AuthDefaultResource"),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
     * @OA\Response(
     *    response=404,
     *    description="User Not Found",
     * )
     * @OA\Response(
     *    response=400,
     *    description="Bad Request",
     * )
     */

    public function changePassword(Request $request, $userId){
        $validasi = Validator::make($request->all(), [
            "password" => "required|confirmed|string"
        ]);

        if($validasi->fails()){
            return ResponseFormatter::error(null, $validasi->error(), 400);
        }

        $user = User::find($userId);
        if($user == null){
            return ResponseFormatter::error(null, 'User tidak ditemukan', 404);
        }

        $user->update([
            "password" => Hash::make($request->password),            
        ]);

        return ResponseFormatter::success(null, 'Password berhasil diubah', 200);
    }

    
    /**
     * @OA\Post(
     *  path="/api/auth/check-auth",
     *  summary="Check Admin Authentication",
     *  description="Check Admin Authentication",
     *  operationId="checkAuth",
     *  tags={"Authentication"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/AuthDefaultResource"),          
     *   ),
     *  @OA\Response(
     *    response="401", 
     *    description="Unauthorized",          
     *   ),
     * )          
     */
    public function checkUserAuth(){
        if(auth()->check()){
            return ResponseFormatter::success(true, 'User is Authorized', 200);
        }else{
            return ResponseFormatter::error(false,'User is unauthorized', 403);
        }
    }

    /**
     * @OA\Post(
     *  path="/api/auth/logout",
     *  summary="Logout Admin",
     *  description="Logout Admin",
     *  operationId="authLogout",
     *  tags={"Authentication"},
     *  security={ {"bearerAuth": {} }},
     *  @OA\Response(
     *    response="200", 
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/AuthDefaultResource"),           
     *   ),
     * )          
     */
    public function signout(){
        Auth::logout();
        return response()->json([
            'response' => [
                'code' => 200,
                'status' => 'success',
                'message'=> 'User Logged Out'
            ], 
            'data' => null,
        ]);
    }

    protected function responseWithToken($token){
        
        $isMahasiswa = Auth::user()->nip === null || Auth::user()->nip === "" ? true : false;
        $responseData = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'id' => Auth::user()->id,
            'user_active_period' => Auth::user()->start_active_period,
            'user_expire_period' => Auth::user()->end_active_period,
            'staff_model' => Auth::user()->staff_user,
            'mahasiswa_model' => Auth::user()->mahasiswa_user,
            'jabatan_model' => Auth::user()->jabatan_user,
            "first_login" => Auth::user()->first_login,
            'is_mahasiswa' => $isMahasiswa,
            'image_data' => Auth::user()->image_data,
            
        ];

        return ResponseFormatter::success($responseData, 'User berhasil login', 200);
    }
}
