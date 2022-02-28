<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserVerifyController;
use App\Http\Controllers\PublicAccessController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect()->route('l5-swagger.default.api');
// });

Route::get('/',[PublicAccessController::class, 'redirectIndex'])->name('redirect-index');

// User Verify
Route::get('user-data/verify/{token}', [UserVerifyController::class,'verifyUserData'])->name('user-data.verify');

Route::get('view-user-verify', [UserVerifyController::class,'ViewUserVerified'])->name('user-data.view-user-verify');

Route::get('public-access/lokasi/{id}',[PublicAccessController::class, 'getInfoLokasi'])->name('public-access.lokasi');

