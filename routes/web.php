<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FounderController as AdminFounderController;
use App\Http\Controllers\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\SongController as AdminSongController;
use App\Http\Controllers\Admin\TranslationController as AdminTranslationController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuditionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/locale', [LocaleController::class, 'update'])->name('locale.update');

Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artists/{group}', [ArtistController::class, 'show'])->name('artists.show');

Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/music/{song}', [MusicController::class, 'show'])->name('music.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/auditions', [AuditionController::class, 'index'])->name('auditions.index');
Route::get('/auditions/apply', [AuditionController::class, 'create'])->name('auditions.apply');
Route::post('/auditions/apply', [AuditionController::class, 'store'])->middleware('throttle:8,1')->name('auditions.store');

Route::get('/business', [BusinessController::class, 'index'])->name('business.index');
Route::post('/business', [BusinessController::class, 'store'])->middleware('throttle:8,1')->name('business.store');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [NewsController::class, 'show'])->name('news.show');

Route::view('/copyright', 'legal.copyright')->name('legal.copyright');
Route::view('/privacy', 'legal.privacy')->name('legal.privacy');
Route::view('/terms', 'legal.terms')->name('legal.terms');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:8,1')->name('login.store');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:8,1')->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

Route::redirect('/studio', '/admin');
Route::redirect('/studio/login', '/admin/login');

Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminSessionController::class, 'create'])->name('login');
    Route::post('/login', [AdminSessionController::class, 'store'])->middleware('throttle:6,1')->name('login.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminSessionController::class, 'destroy'])->name('logout');

    Route::resource('groups', AdminGroupController::class)->except(['show']);
    Route::resource('members', AdminMemberController::class)->except(['show']);
    Route::resource('songs', AdminSongController::class)->except(['show']);
    Route::resource('news', AdminNewsController::class)->except(['show'])->parameters(['news' => 'news']);
    Route::resource('founders', AdminFounderController::class)->except(['show']);
    Route::resource('reviews', AdminReviewController::class)->except(['show']);

    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}', [AdminApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}', [AdminApplicationController::class, 'destroy'])->name('applications.destroy');

    Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('inquiries.update');
    Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::get('/languages', [AdminTranslationController::class, 'index'])->name('translations.index');
    Route::put('/languages', [AdminTranslationController::class, 'update'])->name('translations.update');

    Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
