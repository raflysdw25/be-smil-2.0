<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controller
// use App\Http\Controllers\API\ProdiController;
use App\Http\Controllers\API\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'middleware' => 'api', 'namespace' => 'App\Http\Controllers\API\Auth'], function($router){
    // Auth
    Route::post('logout', 'AuthController@signout')->name('auth.logout');
    Route::post('check-auth', 'AuthController@checkUserAuth')->name('auth.check-auth');
    Route::post('change-password/{userId}', 'AuthController@changePassword')->name('auth.change-password');

});

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\API\Auth'], function($router){
    // Auth
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('login-peminjam', 'AuthController@loginPeminjam')->name('auth.peminjam');

});

Route::group(['middleware' => ['api', 'isAdmin'],'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\API\Admin'], function($router) {

    Route::get('dashboard', 'DashboardController@dashboardAdmin')->name('dashboard.admin');
    Route::post('filter/dashboard/alat', 'DashboardController@listAlatForDashboard')->name('dashboard.alat');

    Route::apiResource('prodi', 'ProdiController');
    Route::apiResource('satuan', 'SatuanController');
    Route::apiResource('asal', 'AsalPengadaanController');
    Route::apiResource('staff', 'StaffController');
    Route::apiResource('jabatan', 'JabatanController');
    Route::apiResource('user', 'StaffLaboratoriumController');
    Route::apiResource('lokasi', 'LokasiPenyimpananController');
    Route::apiResource('jenis', 'JenisAlatController');
    Route::apiResource('supplier', 'SupplierController');
    Route::apiResource('mahasiswa', 'MahasiswaController');
    Route::apiResource('ruangan', 'RuanganController');
    Route::apiResource('alat', 'AlatController');
    Route::apiResource('detail-alat', 'DetailAlatController');
    Route::apiResource('image-alat', 'ImageAlatController');
    Route::apiResource('laporan', 'LaporanKerusakanController');
    Route::apiResource('peminjaman', 'PeminjamanController');
    Route::apiResource('booking-pengembalian', 'BookingPengembalianController');
    
    // Filter Route
    Route::post('filter/prodi', 'ProdiController@filter')->name('filter.prodi');
    Route::post('filter/satuan', 'SatuanController@filter')->name('filter.satuan');
    Route::post('filter/asal', 'AsalPengadaanController@filter')->name('filter.asal');
    Route::post('filter/jabatan', 'JabatanController@filter')->name('filter.jabatan');
    Route::post('filter/staff', 'StaffController@filter')->name('filter.staff');
    Route::post('filter/user', 'StaffLaboratoriumController@filter')->name('filter.user');
    Route::post('filter/lokasi', 'LokasiPenyimpananController@filter')->name('filter.lokasi');
    Route::post('filter/jenis', 'JenisAlatController@filter')->name('filter.jenis');
    Route::post('filter/supplier', 'SupplierController@filter')->name('filter.supplier');
    Route::post('filter/mahasiswa', 'MahasiswaController@filter')->name('filter.mahasiswa');
    Route::post('filter/ruangan', 'RuanganController@filter')->name('filter.ruangan');
    Route::post('filter/alat', 'AlatController@filter')->name('filter.alat');
    Route::post('filter/detail-alat/{alatId}', 'DetailAlatController@filter')->name('filter.detailalat');
    Route::post('filter/laporan', 'LaporanKerusakanController@filter')->name('filter.laporan');
    Route::post('filter/peminjaman', 'PeminjamanController@filter')->name('filter.peminjaman');
    Route::post('filter/booking-pengembalian', 'BookingPengembalianController@filter')->name('filter.bookingpengembalian');

    // Pengembalian Alat Controlelr
    Route::post('/get-need-returned', 'PengembalianAlatController@getReturnedPeminjaman')->name('peminjam.get-need-returned');
    Route::put('/return-peminjaman/{peminjamanId}', 'PengembalianAlatController@returnPeminjaman')->name('peminjam.return-peminjaman');

    // Custom Method Route

    // Staff
    Route::get('staff/list/un-register-staff', 'StaffController@unRegisterStaff')->name('staff.un-register-staff');
    Route::get('staff/resend-email-verify/{nip}', 'StaffController@resendVerifyEmail')->name('staff.resend-email-verify');

    // Lokasi Penyimpanan
    Route::get('lokasi/available/{totalNeed}', 'LokasiPenyimpananController@getAvailableLokasi')->name('lokasi.available-lokasi');
    
    // Detail Alat
    Route::get('detail-alat/get-by-alat-id/{alat_id}', 'DetailAlatController@getByAlatId')->name('detail-alat.get-alat-by-alatid'); 
    Route::put('detail-alat/update-condition/{alat_id}', 'DetailAlatController@updateConditionStatus')->name('detail-alat.update-condition');
    Route::put('detail-alat/update-available/{alat_id}', 'DetailAlatController@updateAvailableStatus')->name('detail-alat.update-available');

    // Image Alat
    Route::get('image-alat/get-by-alat-id/{alat_id}', 'ImageAlatController@getImageByAlatId')->name('image-alat.get-image-by-alatid');

    // Laporan Kerusakan
    Route::put('laporan/report-action/{laporan_id}', 'LaporanKerusakanController@reportAction')->name('laporan.report-action');
    
    // Peminjaman 
    Route::put('peminjaman/approve-action/{peminjaman_id}', 'PeminjamanController@approveAction')->name('peminjaman.approve-action');
    Route::post('peminjaman/cek-alat', 'PeminjamanController@confirmAlat')->name('peminjaman.cek-alat');
    Route::post('peminjaman/register-alat-dipinjam/{peminjaman_id}', 'PeminjamanController@registerAlatDipinjam')->name('peminjaman.register-alat-dipinjam');    

    // Staff Laboratorium
    Route::get('user/get-image/{id}', 'StaffLaboratoriumController@getImageUser')->name('user.get-image');
    Route::put('user/update-jabatan/{user_id}', 'StaffLaboratoriumController@updateJabatan')->name('user.update-jabatan');

    // Jabatan
    Route::get('jabatan/lab/staff-lab', 'JabatanController@getStaffJabatan')->name('jabatan.staff-lab');
});





Route::group(['middleware' => ['api', 'isPeminjam'], 'prefix' => 'peminjaman', 'namespace' => 'App\Http\Controllers\API\Peminjaman'], function($router){
    
    
    // Peminjaman Alat Controller
    Route::post('/cek-peminjaman', 'PeminjamanAlatController@getRecentPeminjaman')->name('peminjam.cek-peminjaman');
    Route::post('/cek-alat', 'PeminjamanAlatController@confirmAlat')->name('peminjam.cek-alat');    
    Route::post('/add-peminjaman', 'PeminjamanAlatController@createPeminjaman')->name('peminjam.add-peminjaman');
    
    // User Account Controller - Fitur yang dapat digunakan oleh peminjam
    Route::post('/add-laporan-kerusakan', 'UserAccountController@addNewLaporanKerusakan')->name('peminjam.add-laporan-kerusakan');
    Route::put('/update-profile/{id}', 'UserAccountController@updateUserProfile')->name('peminjam.update-profile-peminjam');
    Route::post('/get-booking-pengembalian', 'UserAccountController@getBookingPengembalian')->name('peminjam.get-booking-pengembalian');
    Route::post('/submit-booking-pengembalian', 'UserAccountController@submitBookingPengembalian')->name('peminjam.submit-booking-pengembalian');
    Route::get('peminjam/get-image/{id}', 'UserAccountController@getImagePeminjam')->name('peminjam.get-image');

    // UNUSED ROUTE
    Route::post('/cek-pelapor', 'BuatLaporanController@confirmPeminjam')->name('peminjam.cek-pelapor');
    Route::post('/get-peminjam', 'PeminjamanAlatController@getDataPeminjam')->name('peminjam.get-peminjam');
        
});

Route::group(['prefix' => 'peminjaman', 'namespace' => 'App\Http\Controllers\API\Peminjaman'], function($router) {
    // Peminjam Controller
    Route::post('/add-mahasiswa', 'PeminjamController@addNewMahasiswa')->name('peminjam.add-mahasiswa');
    Route::get('/get-prodi', 'PeminjamController@getProdi')->name('peminjam.get-prodi');
    Route::get('/get-ruangan', 'PeminjamController@getRuangan')->name('peminjam.get-ruangan');
    Route::get('/get-staff', 'PeminjamController@getStaff')->name('peminjam.get-staff');
    Route::get('/get-alat', 'PeminjamController@getAlat')->name('peminjam.get-alat');
});
