<?php

use App\Http\Controllers\Auth\DonationsListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\WithdrawController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\DonateController;

use GuzzleHttp\Middleware;
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/about', function () {
  return view('pages.about');
})->name('about');

Route::get('/donatepage/{id}', function ($id) {
  return view('pages.donatepage');
});

Route::get('/donatepage/{id}', [DonateController::class, 'show'])->name('donatepage.show');

Route::middleware(['guest'])->group(function () {
  Route::post('/login', [LoginController::class, 'login'])->name('login');
  Route::post('/register', [RegisterController::class, 'create'])->name('register');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/donations', [DonationsListController::class, 'index'])->name('donations.index');
  Route::put('/update_profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/delete_profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::post('/profile_create', [ProfileController::class, 'create'])->name('profile.create');
  Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
});

Route::post('/donation/{id}', [DonateController::class, 'create'])->name('donation.create');
Route::get('/donation/callback', [DonateController::class, 'callback'])->name('donation.callback');
Route::get('/donation/success', [DonateController::class, 'success'])->name('donation.success');
Route::get('/donation/error', [DonateController::class, 'error'])->name('donation.error');
Route::get('/donation/pending', [DonateController::class, 'pending'])->name('donation.pending');
Route::post('/yookassa/webhook', [DonateController::class, 'webhook'])
  ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/donation/status/{paymentId}', [DonateController::class, 'checkStatus'])->name('donation.status');

// Route::get('/debug-webhook', function () {
//   \Log::info('Debug webhook accessed');
//   return response()->json(['message' => 'Webhook endpoint is accessible']);
// });
// Route::get('/test-mail', function () {
//     Mail::raw('Тестовое письмо', function ($message) {
//         $message->to('test@example.com')->subject('Проверка');
//     });

//     return 'Чек логи';
// });