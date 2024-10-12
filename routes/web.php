<?php

use App\Http\Controllers\AdminVideoController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuditionController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideoRatingController;
use App\Models\Plan;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome', ['plans' => Plan::where('is_active', 1)->get()]);
})->name('welcome');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Auth::routes(['verify' => true]);
Route::get('/top/{plan?}', [VideoRatingController::class, 'countAvg']);

Route::get('/home', function () {
    return view('welcome', ['plans' => Plan::where('is_active', 1)->get()]);
})->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/get-pre-signed-url', [VideoController::class, 'generatePreSignedUrl'])->name('get-pre-signed-url');

    Route::get('/payment/{plan?}', [PaymentController::class, 'charge'])->name('goToPayment');
    Route::post('payment/process-payment/{plan?}', [PaymentController::class, 'processPayment'])->name('processPayment');

    Route::group(['prefix' => 'paypal'], function () {
        Route::post('/order/create', [PaypalController::class, 'create'])->name('paypal.create');
        Route::post('/order/capture/', [PayPalController::class, 'capture'])->name('paypal.capture');
    });

    Route::resource('user-details', UserDetailController::class);
    Route::resource('audition', AuditionController::class);

    Route::get('/upload-video/{plan?}', [VideoController::class, 'index'])->name('upload-video');
    Route::get('/upload-video/TNDS-S1', [VideoController::class, 'index'])->name('upload-video.TNDS-S1');
    Route::post('/upload-video', [VideoController::class, 'upload'])->name('video.upload');
    Route::get('/thank-you', function () {
        return view('thanks');
    })->name('thank-you');
});

// ========== Admin ================
Route::middleware(['role:guru|admin'])->group(function () {

    Route::get('/admin/videos', [AdminVideoController::class, 'index'])->name('admin.videos.index');
    Route::get('/admin/videos/{video}', [AdminVideoController::class, 'show'])->name('admin.videos.show');
    Route::get('/admin/videos/{guru}/{video}', [AdminVideoController::class, 'showByGuru'])->name('admin.videos.show-by-guru');
    Route::post('/admin/{video}/rate_video', [VideoRatingController::class, 'rateVideo'])->name('guru.rate.video');
    Route::get('/admin/auditions', [AdminVideoController::class, 'topList'])->name('admin.auditions.index');
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('gurus', GuruController::class);
        Route::post('/admin/gurus/updateStatus', [GuruController::class, 'updateStatus'])->name('admin.gurus.update-status');
        Route::post('/admin/gurus/updateAudition', [GuruController::class, 'updateAudition'])->name('admin.gurus.assign-audition');
        Route::post('/admin/gurus/ratingReminder', [GuruController::class, 'ratingReminder'])->name('admin.gurus.send-rating-reminder');
        Route::get('/admin/users', [AdminVideoController::class, 'userList'])->name('admin.users.index');
        Route::get('/admin/users/{user}', [AdminVideoController::class, 'user'])->name('admin.users.show');
        Route::get('/admin/auditions/top/{audition?}/{status?}/{top?}/{sort?}', [AdminVideoController::class, 'topList'])->name('admin.auditions.top');
        Route::post('/admin/auditions/top/updateStatus', [AdminVideoController::class, 'updateStatus'])->name('admin.auditions.updateStatus');
        Route::get('/admin/auditions/{audition}', [AdminVideoController::class, 'audition'])->name('admin.auditions.show');
        Route::post('/export-toppers', [AdminVideoController::class, 'exportToppers'])->name('export.toppers');
        Route::post('/export-exportUserList', [AdminVideoController::class, 'exportUserList'])->name('export.userList');
        Route::post('/export-audition', [AdminVideoController::class, 'exportaudition'])->name('export.audition');
    });
});

Route::get('privacy-policy', function () {
    return view('pvc');
});
Route::get('terms-conditions', function () {
    return view('tandc');
});
Route::get('refund-cancelation', function () {
    return view('refcanc');
});
