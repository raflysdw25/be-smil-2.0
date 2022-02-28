<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// Resource
use App\Http\Resources\BookingPengembalianResource;
use App\Http\Resources\BookingPengembalianCollection;



// Models
use App\Models\BookingPengembalian;


class BookingPengembalianController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','api']);
    }

    /**
     * @OA\Get(
     *     path="/api/admin/booking-pengembalian",
     *     operationId="getAllBookingPengembalian",
     *     tags={"Booking Pengembalian Alat"},
     *     summary="Return List of BookingPengembalian",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/BookingPengembalianListDefaultResource"),          
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingPengembalian = BookingPengembalian::orderBy('id', 'ASC')->get();

        if($bookingPengembalian){
            return response()->json([
                "response" => [
                    "code" => 200,
                    "status" => "success",
                    "mesasge" => "List Booking Pengembalian Berhasil didapatkan"
                ],
                "data" => $bookingPengembalian,
            ], 200);
        }else{
            return response()->json([
                "response" => [
                    "code" => 500,
                    "status" => "success",
                    "mesasge" => "List Booking Pengembalian Gagal didapatkan"
                ],
                "data" => null,
            ], 500);

        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/booking-pengembalian",
     *     operationId="getAllBookingPengembalianByFilter",
     *     tags={"Booking Pengembalian Alat"},
     *     summary="Return List of BookingPengembalian by Filter",
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
    public function filter(Request $request)
    {
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');

        // Filter: Nama Alat, Jenis Alat, Asal Pengadaan, Tahun Pengadaan
        $bookingPengembalian = BookingPengembalian::with(['peminjaman_need_pengembalian', 'booking_by_mahasiswa', 'booking_by_staff'])->orderBy($sortBy, $sortDirection);

        if($request->has('appointment_date') && $request->appointment_date != null){
            $bookingPengembalian->where('appointment_date', '=', $request->appointment_date);
        }

        if($request->has('nomor_induk') && $request->nomor_induk != ''){
            $bookingPengembalian->where('nim_mahasiswa', 'ilike','%'.$request->nomor_induk.'%')->orWhere('nip_staff', 'ilike', '%'.$request->nomor_induk.'%');
        }

        if($request->has('booking_notes') && $request->booking_notes != ''){
            $bookingPengembalian->where('booking_notes', 'ilike', '%'.$request->booking_notes.'%');
        }
        
        if($request->has('is_booking_cancel') && $request->is_booking_cancel !== ''){
            $bookingPengembalian->where('is_booking_cancel', '=', $request->is_booking_cancel);
        }

        if($request->has('process_by')&& $request->process_by != ''){
            $bookingPengembalian->where('process_by', 'ilike', '%'.$request->process_by.'%');
        }
        
        
                
        $collection = new BookingPengembalianCollection($bookingPengembalian->paginate($paginate));

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
        
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/api/admin/booking-pengembalian/{id}",
     *     operationId="getAllBookingPengembalianById",
     *     tags={"Booking Pengembalian Alat"},
     *     summary="Get BookingPengembalian Detail Information",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="BookingPengembalian ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\Response(
     *        response="200", 
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/BookingPengembalianDetailResource")
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
        $bookingPengembalian = BookingPengembalian::with(['peminjaman_need_pengembalian', 'booking_by_mahasiswa', 'booking_by_staff'])->find($id);

        if($bookingPengembalian == null){
            return ResponseFormatter::error(null, 'Data Booking Pengembalian tidak ditemukan', 404);
        }

        return ResponseFormatter::success($bookingPengembalian, 'Data Booking Pengembalian berhasil didapatkan', 200);
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
     *     path="/api/admin/booking-pengembalian/{id}",
     *     operationId="updateExistedBookingPengembalian",
     *     tags={"Booking Pengembalian Alat"},
     *     summary="Update Existed BookingPengembalian",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="BookingPengembalian ID",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *          type="integer"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBookingPengembalianRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
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
    public function update(Request $request, $id)
    {
        $bookingPengembalian = BookingPengembalian::find($id);

        if($bookingPengembalian == null){
            return ResponseFormatter::error(null, 'Booking Pengembalian tidak ditemukan', 404);
        }

        $validator = Validator::make($request->all(),[
            'appointment_date' => ['required', 'date'],
            'nim_mahasiswa' => ['string', 'exists:App\Models\Mahasiswa,nim'],
            'nip_staff' => ['string', 'exists:App\Models\Staff,nip'],
            'peminjaman_id' => ['numeric', 'nullable', 'exists:App\Models\Peminjaman,id'],
            'is_booking_cancel' => ['required','boolean'],
            'booking_notes' => ['string'],
            'process_by' => ['string'],
        ]);

        if($validator->fails()){
            return ResponseFormatter::error(null, $validator->errors(), 400);
        }

        $bookingPengembalian->update([
            'appointment_date' => $request->appointment_date,
            'nim_mahasiswa' => $request->nim_mahasiswa,
            'nip_staff' => $request->nip_staff,
            'peminjaman_id' => $request->peminjaman_id,
            'is_booking_cancel' => $request->is_booking_cancel,
            'booking_notes' => $request->booking_notes,
            'process_by' => $request->process_by,
        ]);

        if($bookingPengembalian){
            return ResponseFormatter::success($bookingPengembalian, 'Booking Pengembalian berhasil diubah', 200);
        }else{
            return ResponseFormatter::error(null, 'Booking Pengembalian gagal diubah');
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
     *     path="/api/admin/booking-pengembalian/{id}",
     *     operationId="deleteExistingBookingPengembalian",
     *     tags={"Booking Pengembalian Alat"},
     *     summary="Delete Existed Booking Pengembalian",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Parameter(
     *        name="id",
     *        description="BookingPengembalian ID",
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
        $bookingPengembalian = BookingPengembalian::find($id);

        if($bookingPengembalian == null){
            return ResponseFormatter::error(null, 'Booking Pengembalian tidak ditemukan', 404);
        }
        try {
            
            $bookingPengembalian->delete();
            return ResponseFormatter::error(null, 'Booking Pengembalian berhasil dihapus', 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[0];            
            return ResponseFormatter::error(null, $e->errorInfo[2], 403);
        }
    }
}
