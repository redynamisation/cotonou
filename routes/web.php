<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('annonces', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('library', [LibraryController::class, 'index'])->name('library.index');
Route::get('partenaires', [PartnerController::class, 'index'])->name('partners.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Administration
    Route::view('admin/users', 'admin.users')->name('admin.users');
    Route::view('admin/activities', 'admin.activities')->name('admin.activities');
    Route::view('admin/tasks', 'admin.tasks')->name('admin.tasks');
    Route::get('admin/announcements', [AnnouncementController::class, 'adminIndex'])->name('admin.announcements');
    Route::post('admin/announcements', [AnnouncementController::class, 'store'])->name('admin.announcements.store');
    Route::get('admin/library', [LibraryController::class, 'adminIndex'])->name('admin.library');
    Route::post('admin/library', [LibraryController::class, 'store'])->name('admin.library.store');
    Route::get('admin/partners', [PartnerController::class, 'adminIndex'])->name('admin.partners');
    Route::post('admin/partners', [PartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('admin/events', [EventController::class, 'adminIndex'])->name('admin.events');
    Route::post('admin/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::view('admin/event-expenses', 'admin.event-expenses')->name('admin.event-expenses');
    
    // Commission routes
    Route::get('commissions', [CommissionController::class, 'index'])->name('commissions.index');
    Route::get('finances', [FinanceController::class, 'index'])->name('finances.index');
    Route::get('events', [TicketController::class, 'index'])->name('events.index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
