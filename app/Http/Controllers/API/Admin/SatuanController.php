<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\SatuanResource;
use App\Http\Resources\SatuanCollection;




// Models
use App\Models\Satuan;


class SatuanController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }
     /**
     * @OA\Get(
     *     path="/api/admin/satuan",
     *     operationId="getAllSatuan",
     *     tags={"Satuan"},
     *     summary="Return List of Satuan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SatuanListDefaultResource"),          
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
        $satuan = Satuan::orderBy('id', 'ASC')->get();

        return response()->json([
            "response" => [
                "code" => 200,
                "status" => "success",
                "mesasge" => "List Satuan Berhasil didapatkan"
            ],
            "data" => $satuan,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/satuan",
     *     operationId="getAllSatuanByFilter",
     *     tags={"Satuan"},
     *     summary="Return List of Satuan by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="page",
     *        description="Page List",
     *        required=false,
     *        in="query",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterSatuanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SatuanListResource"),
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
        $sortDirection = $request->input('sort_direction', 'ASC');
        
        $satuan = Satuan::orderBy($sortBy, $sortDirection);
        
        // $condition = [];
        if($request->has('satuan_jumlah_name') && $request->satuan_jumlah_name !== ''){
           
            $satuan->where('satuan_jumlah_name', 'ilike', '%'.$request->satuan_jumlah_name.'%');
        }

        if($request->has('id') && $request->id !== null){
            $satuan->where('id', '=', $request->id);
        }

        $collection = new SatuanCollection($satuan->paginate($paginate));
        
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
     *     path="/api/admin/satuan",
     *     operationId="createNewSatuan",
     *     tags={"Satuan"},
     *     summary="Create New Satuan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSatuanRequest") 
     *     ),
     *     @OA\Response(
     *          response="201", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SatuanDetailResource"),
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
            'satuan_jumlah_name' => 'required|string|unique:App\Models\Satuan,satuan_jumlah_name'
        ]);
        
        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $satuan = Satuan::create([            
            'satuan_jumlah_name' => $request->satuan_jumlah_name
        ]);
        if($satuan){
            return ResponseFormatter::success($satuan, 'Satuan berhasil ditambahkan', 201);
        }else{
            return ResponseFormatter::error(null, 'Satuan gagal ditambahkan');
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
     *     path="/api/admin/satuan/{id}",
     *     operationId="getAllSatuanById",
     *     tags={"Satuan"},
     *     summary="Get Satuan Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Satuan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/SatuanDetailResource")
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
        $satuan = Satuan::find($id);
        if($satuan == null){
            return ResponseFormatter::error(null, 'Satuan tidak ditemukan', 404);

        }
        return ResponseFormatter::success(new SatuanResource($satuan), 'Satuan berhasil didapatkan', 200);
        
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
     *     path="/api/admin/satuan/{id}",
     *     operationId="updateExistedSatuan",
     *     tags={"Satuan"},
     *     summary="Update Existed Satuan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Satuan ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSatuanRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/SatuanDetailResource"),
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
        $satuan = Satuan::find($id);
        if($satuan == null){
            return ResponseFormatter::error(null, 'Satuan tidak ditemukan', 404);
        }
        $validator = Validator::make($request->all(), [
            'satuan_jumlah_name' => ['required', 'string', Rule::unique('App\Models\Satuan')->ignore($satuan->satuan_jumlah_name, 'satuan_jumlah_name') ]
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $satuan->update($request->only('satuan_jumlah_name'));

        if($satuan){
            return ResponseFormatter::success($satuan, 'Satuan berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Satuan gagal diubah');
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
     *     path="/api/admin/satuan/{id}",
     *     operationId="deleteExistingSatuan",
     *     tags={"Satuan"},
     *     summary="Delete Existed Satuan",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="Satuan ID",
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
        $satuan = Satuan::find($id);
        if($satuan == null){
            return ResponseFormatter::error(null, 'Satuan tidak ditemukan', 404);
        }
        try {
            
            $satuan->delete();

            return ResponseFormatter::success(null, 'Satuan berhasil dihapus', 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[0];
            if($errorCode == "23503"){
                return ResponseFormatter::error(null, 'Satuan masih digunakan', 403);
            }else{
                return ResponseFormatter::error(null, $e->errorInfo[2], 403);
            }
        }
        
        
    }
}
