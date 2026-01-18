<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Add this route for dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    Route::get('/list-lucky-draw', [DashboardController::class, 'listAttendeesLuckyDrawAdmin']);
    Route::get('/attendee/{id}', [DashboardController::class, 'getAttendee']);
    Route::get('/remove-attendee', [DashboardController::class, 'listAttendeesAdmin']);
    Route::get('/list', [DashboardController::class, 'getList']);
    Route::get('/total-count-attendee', [DashboardController::class, 'getTotalCount']);
    Route::get('/total-attending', [DashboardController::class, 'getTotalCountAttending']);
    Route::get('/total-not-attending', [DashboardController::class, 'getTotalCountNotAttending']);
    Route::get('/total-attending-by-category/{category}', [DashboardController::class, 'getTotalCountByCategory']);
    Route::get('/total-attending-by-type/{type}', [DashboardController::class, 'getTotalCountByType']);
    Route::put('/update-attendee/{id}/', [DashboardController::class, 'updateAttendeeProfile']);
    Route::delete('/delete-attendee/{id}', [DashboardController::class, 'deleteAttendeeProfile']);
    Route::get('/attendees/{id}', [DashboardController::class, 'getAttendeeProfile']);  

    // Add this route for creating a user
    Route::post('/create-user', [ProfileController::class, 'createUser']);

    // Add this route for admin lucky draw list
    Route::get('/attendees-lucky-draw', [DashboardController::class, 'listAttendeesLuckyDrawAdmin']);
    Route::get('/lucky-draw-attendee-list', [DashboardController::class, 'luckyDrawListAll']);
    
});

// Add this route for attendee processing and verification
Route::get('/', [AttendeeController::class, 'index']);
Route::get('/verify', [AttendeeController::class, 'qrcodeView']);
Route::post('/submit-form', [AttendeeController::class, 'createAttendee']);
Route::post('/attendeeConfirm', [AttendeeController::class, 'verifyAttendee']);

// Add this route for redemption kiosk and over the counter
Route::get('/qrcode', [AttendeeController::class, 'qrcode']);
Route::get('/redemption', [AttendeeController::class, 'redemption']);

//lucky draw
Route::get('/lucky-draw', [AttendeeController::class, 'luckyDraw']);
Route::get('/list-draw', [AttendeeController::class, 'getListLuckyDraw']);
Route::get('/register-to-lucky-draw/{token}', [AttendeeController::class, 'participateLuckyDraw']);

// add attendee to lucky draw
Route::get('/scan-attendee-qr', [AttendeeController::class, 'scanAttendeeQrCode']);

require __DIR__.'/auth.php';
