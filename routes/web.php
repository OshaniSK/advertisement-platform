<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $advertisements = Advertisement::where('status', 'approved')
        ->latest()
        ->get();

    return view('welcome', compact('advertisements'));

})->name('home');


/*
|--------------------------------------------------------------------------
| Advertisements - Public
|--------------------------------------------------------------------------
*/

// Browse approved advertisements
Route::get('/advertisements', [AdvertisementController::class, 'index'])
    ->name('advertisements.index');

// View a single approved advertisement
Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show'])
    ->name('advertisements.show');


/*
|--------------------------------------------------------------------------
| Advertisements - Advertiser
|--------------------------------------------------------------------------
*/

// Create advertisement page
Route::get('/advertisements/create', [AdvertisementController::class, 'create'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.create');

// Store advertisement
Route::post('/advertisements', [AdvertisementController::class, 'store'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.store');

// Edit advertisement
Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.edit');

// Update advertisement
Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.update');

// Delete advertisement
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertisements.destroy');

    /* Favorites */
Route::get('/favorites', [FavoriteController::class, 'index'])
    ->middleware(['auth', 'role:visitor'])
    ->name('favorites.index');

Route::post('/advertisements/{advertisement}/favorite', [FavoriteController::class, 'store'])
    ->middleware('auth')
    ->name('favorites.store');

Route::delete('/advertisements/{advertisement}/favorite', [FavoriteController::class, 'destroy'])
    ->middleware('auth')
    ->name('favorites.destroy');



/*
|--------------------------------------------------------------------------
| Contact Seller
|--------------------------------------------------------------------------
*/

// Contact seller page
Route::get('/advertisements/{advertisement}/contact', function (Advertisement $advertisement) {

    // Only approved advertisements can be contacted
    if ($advertisement->status !== 'approved') {
        abort(404);
    }

    return view('advertisements.contact', compact('advertisement'));

})->middleware('auth')->name('contact.seller');


// Send first message to seller
Route::post('/advertisements/{advertisement}/contact', [MessageController::class, 'send'])
    ->middleware('auth')
    ->name('contact.seller.send');


/*
|--------------------------------------------------------------------------
| Messages / Conversations
|--------------------------------------------------------------------------
*/

// Messages inbox
Route::get('/messages', [MessageController::class, 'inbox'])
    ->middleware('auth')
    ->name('messages.inbox');


// Open a conversation
Route::get('/messages/{advertisement}/{other_user}', [MessageController::class, 'conversation'])
    ->middleware('auth')
    ->name('messages.conversation');


// Send message inside an existing conversation
Route::post('/messages/{advertisement}/{other_user}', [MessageController::class, 'sendMessage'])
    ->middleware('auth')
    ->name('messages.send');


// Reply to an existing message
Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('messages.reply');


/*
|--------------------------------------------------------------------------
| Default Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');


// Manage users
Route::get('/admin/users', [AdminUserController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');


// Update user role
Route::patch('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.updateRole');


// Approve advertisement
Route::patch('/admin/advertisements/{advertisement}/approve', [AdminController::class, 'approve'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.advertisements.approve');


// Reject advertisement
Route::patch('/admin/advertisements/{advertisement}/reject', [AdminController::class, 'reject'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.advertisements.reject');


/*
|--------------------------------------------------------------------------
| Advertiser
|--------------------------------------------------------------------------
*/

// Advertiser dashboard
Route::get('/advertiser/dashboard', [AdvertiserController::class, 'dashboard'])
    ->middleware(['auth', 'role:advertiser'])
    ->name('advertiser.dashboard');


/*
|--------------------------------------------------------------------------
| Visitor
|--------------------------------------------------------------------------
*/

// Visitor dashboard
Route::get('/visitor/dashboard', [VisitorController::class, 'dashboard'])
    ->middleware(['auth', 'role:visitor'])
    ->name('visitor.dashboard');

/* Notifications */

Route::middleware('auth')->group(function () {

    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::get(
        '/notifications/{notification}/open',
        [NotificationController::class, 'open']
    )->name('notifications.open');

    Route::post(
        '/notifications/{notification}/read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    Route::post(
        '/notifications/read-all',
        [NotificationController::class, 'markAllAsRead']
    )->name('notifications.readAll');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';