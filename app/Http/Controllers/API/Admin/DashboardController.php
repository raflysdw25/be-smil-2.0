<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Collection;

// Resource
use App\Http\Resources\DashboardAlatResource;
use App\Http\Resources\DashboardAlatCollection;


// Models
use App\Models\Alat;
use App\Models\DetailAlat;
use App\Models\Peminjaman;
use App\Models\LaporanKerusakan;
use App\Models\BookingPengembalian;

class DashboardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admin/dashboard",
     *     operationId="getAllDashboard",
     *     tags={"Dashboard"},
     *     summary="Return List of Dashboard",
     *     security={ {"bearerAuth": {} }},
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardResource"),                    
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
    public function dashboardAdmin(){
        $detailAlat = DetailAlat::count();
        $con_good = DetailAlat::where('condition_status', '=', 2)->count();
        $con_bad = DetailAlat::where('condition_status', '=', 3)->orWhere('condition_status', '=', 6)->count();
        $con_empty = DetailAlat::where('condition_status', '=', 4)->count();
        $con_fix = DetailAlat::where('condition_status', '=', 5)->count();

        $peminjaman = Peminjaman::with(['mahasiswa_peminjam_model', 'staff_peminjam_model', 'detail_peminjaman_model'])->orderBy('created_at', 'DESC')->limit(5)->get();

        $laporan = LaporanKerusakan::with(['mahasiswa_lapor_model', 'staff_lapor_model'])->orderBy('created_at', 'DESC')->limit(5)->get();
        $bookingPengembalian = BookingPengembalian::with(['peminjaman_need_pengembalian', 'booking_by_mahasiswa', 'booking_by_staff'])->orderBy('created_at', 'DESC')->limit(5)->get();


        $dashboard = [
            "total_alat" => $detailAlat,
            "count_good" => $con_good,
            "count_damaged" => $con_bad,
            "count_empty" => $con_empty,
            "count_fix" => $con_fix,
            "recent_report" => $laporan,
            "recent_peminjaman" => $peminjaman,
            "recent_booking" => $bookingPengembalian,
        ];

        return ResponseFormatter::success($dashboard, "Dashboard berhasil didapatkan", 200);


    }

    /**
     * @OA\Post(
     *     path="/api/admin/filter/dashboard/alat",
     *     operationId="getAllAlatByFilter",
     *     tags={"Dashboard"},
     *     summary="Return List of Alat by Filter",
     *     security={ {"bearerAuth": {} }},
     *     @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/FilterAlatDashboardRequest") 
     *     ),
     *     @OA\Response(
     *          response="200", 
     *          description="Success",
     *          @OA\JsonContent(ref="#/components/schemas/AlatListDashboardResource"),
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
    public function listAlatForDashboard(Request $request){
        // Parameter : Nama Alat, Jenis Alat, Jumlah Alat, Kondisi Alat, Pagination, Jumlah Data yang ditampilkan, Sorting.
        $paginate = $request->input('page_size', 5);
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'ASC');
        

        $alat = Alat::with(['jenis_alat_model'])->withCount(['details' => function (Builder $query) use($request) {
            $query->where('condition_status', '=', $request->kondisi_alat);
        }])->orderBy($sortBy,$sortDirection);

        if($request->has('alat_name') && $request->alat_name !== ''){
            $alat->where('alat_name', 'ilike', '%'.$request->alat_name.'%');
        }
        
        if($request->has('jenis_alat_id') && $request->jenis_alat_id !== null){
            $alat->where('jenis_alat_id', '=', $request->jenis_alat_id);
        }

        $listAlat = $alat->get();
        $listAlat = $listAlat->filter(function($al) { return $al->details_count > 0; });
       
        
        $total = count($listAlat);
        $current_page = $request->query('page') ?? 1;
        $starting_point = ($current_page * $paginate) - $paginate;

        $listAlat = $listAlat->toArray();
        $listAlat = array_slice($listAlat, $starting_point, $paginate, true);
        $list_alat = [];
        
        foreach ($listAlat as $alat) {
            array_push($list_alat, $alat);
        }

        $listCollection = new Collection();
        foreach ($list_alat as $collection) {
            $listCollection->push((object) $collection);
        }
        
        $list = new Paginator($listCollection, $total, $paginate, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $collection = new DashboardAlatCollection($list);
        return $collection;
    }
}
