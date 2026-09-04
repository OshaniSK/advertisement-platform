<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Advertisement;
use App\Http\Controllers\MessageController;



Route::get('/', function () {
    $advertisements = Advertisement::where('status', 'approved')->get();

    return view('welcome', compact('advertisements'));
});

Route::get('/advertisements', [AdvertisementController::class, 'index'])
    ->name('advertisements.index');

Route::get('/advertisements/create', [AdvertisementController::class, 'create'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.create');

Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])
    ->name('advertisements.show');

Route::get('/advertisements/{advertisement}/contact', function (Advertisement $advertisement) {
    if ($advertisement->status !== 'approved') {
        abort(404);
    }

     return view('advertisements.contact', compact('advertisement'));
})->name('contact.seller');

Route::post('/advertisements/{advertisement}/contact', [MessageController::class, 'send'])
    ->middleware('auth')
    ->name('contact.seller.send');

Route::get('/messages', [MessageController::class, 'inbox'])
    ->middleware('auth')
    ->name('messages.inbox');

Route::get('/messages/{advertisement}/{other_user}', 
    [MessageController::class, 'conversation'])
    ->middleware('auth')
    ->name('messages.conversation');

Route::post('/messages/{advertisement}/{other_user}', 
    [MessageController::class, 'sendMessage'])
    ->middleware('auth')
    ->name('messages.send');

Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('messages.reply');

Route::get('/messages/conversation/{advertisement}/{other_user}', [MessageController::class, 'conversation'])
    ->middleware('auth')
    ->name('messages.conversation');

Route::post('/messages/conversation/{advertisement}/{other_user}', [MessageController::class, 'sendMessage'])
    ->middleware('auth')
    ->name('messages.sendMessage');

Route::get('/messages/{advertisement}/{other_user}', 
    [MessageController::class, 'conversation'])
    ->middleware('auth')
    ->name('messages.conversation');

Route::post('/messages/{advertisement}/{other_user}', 
    [MessageController::class, 'sendMessage'])
    ->middleware('auth')
    ->name('messages.send');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');

Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.updateRole');    

Route::patch('/admin/advertisements/{advertisement}/approve', [AdminController::class, 'approve'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.advertisements.approve');

Route::patch('/admin/advertisements/{advertisement}/reject', [AdminController::class, 'reject'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.advertisements.reject');

  Route::get('/advertiser/dashboard', [AdvertiserController::class, 'dashboard'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertiser.dashboard');

  Route::get('/advertisor/dashboard', [AdvertiserController::class, 'dashboard'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisor.dashboard');

Route::post('/advertisements', [AdvertisementController::class, 'store'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.store');

    Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.edit');

Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.update');

Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.destroy');

  require __DIR__.'/auth.php';



