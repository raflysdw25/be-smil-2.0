<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 /**
 * @OA\Info(
 *    version="1.0.0",
 *    title="API Documentation for SMIL",
 *    description="Dokumentasi API untuk Sistem Manajemen Inventaris Lab TIK PNJ",
 *    @OA\Contact(
 *      email="muhammad.raflysadewa.tik17@mhsw.pnj.ac.id"
 *    ),
 *     
 * )
 * @OA\Tag(
 *     name="Authentication",
 *     description="API Endpoints of Authentication Admin"
 * )
 *  
 * @OA\Tag(
 *     name="User",
 *     description="API Endpoints of User Admin / Staff Laboratorium"
 * )
 * 
 * @OA\Tag(
 *     name="Dashboard",
 *     description="API Endpoints of Dashboard Admin"
 * ) 
 * @OA\Tag(
 *     name="Peminjam",
 *     description="API Endpoints of common Peminjam activity"
 * )
 * 
 * @OA\Tag(
 *     name="Pengembalian Alat - Admin",
 *     description="API Endpoints of Pengembalian Alat by Admin"
 * )
 * 
 * @OA\Tag(
 *     name="Booking Pengembalian Alat",
 *     description="API Endpoints of Booking Pengembalian by Admin"
 * )
 * 
 * @OA\Tag(
 *     name="Peminjaman Alat - Peminjam",
 *     description="API Endpoints of Peminjaman Alat by Peminjam"
 * )
 * 
 * @OA\Tag(
 *     name="Buat Laporan Kerusakan - Peminjam",
 *     description="API Endpoints of Buat Laporan Kerusakan by Peminjam"
 * )
 * @OA\Tag(
 *     name="User Account - Peminjam",
 *     description="API Endpoints of Buat Laporan Kerusakan by Peminjam"
 * )
 * 
 * @OA\Tag(
 *     name="Booking Pengembalian Alat",
 *     description="API Endpoints of Booking Pengembalian by Admin"
 * )
 * 
 * @OA\Tag(
 *     name="Mahasiswa",
 *     description="API Endpoints of Mahasiswa in Admin Portal"
 * )
 * @OA\Tag(
 *     name="Peminjaman",
 *     description="API Endpoints of Peminjaman"
 * )
 * 
 * @OA\Tag(
 *     name="Alat",
 *     description="API Endpoints of Alat Lab"
 * )
 * 
 * @OA\Tag(
 *     name="Jenis Alat",
 *     description="API Endpoints of Jenis Alat"
 * )
 * 
 * @OA\Tag(
 *     name="Detail Alat",
 *     description="API Endpoints of Detail Alat Lab"
 * )
 * @OA\Tag(
 *     name="Image Alat",
 *     description="API Endpoints of Image Alat Lab"
 * )
 * 
 * @OA\Tag(
 *     name="Laporan Kerusakan Alat",
 *     description="API Endpoints of Laporan Kerusakan Alat Lab"
 * )
 * 
 * 
 * @OA\Tag(
 *     name="Supplier",
 *     description="API Endpoints of Supplier Admin"
 * )
 * @OA\Tag(
 *     name="Prodi",
 *     description="API Endpoints of Prodi"
 * )
 * @OA\Tag(
 *     name="Satuan",
 *     description="API Endpoints of Satuan"
 * )
 * @OA\Tag(
 *     name="Jabatan",
 *     description="API Endpoints of Jabatan"
 * )
 * @OA\Tag(
 *     name="Staff",
 *     description="API Endpoints of Staff"
 * )
 * 
 * @OA\Tag(
 *     name="Asal Pengadaan",
 *     description="API Endpoints of Asal Pengadaan"
 * )
 * 
 * @OA\Tag(
 *     name="Ruangan",
 *     description="API Endpoints of Ruangan"
 * )
 * 
 * @OA\Tag(
 *     name="Lokasi Penyimpanan",
 *     description="API Endpoints of Lokasi Penyimpanan"
 * )

 * 
 * @OA\SecurityScheme(
 *     name="Authorization",
 *     securityScheme="bearerAuth",
 *     scheme="bearer",
 *     type="http",
 *     bearerFormat="JWT",
 *     in="header",
 *     
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
