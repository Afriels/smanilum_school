<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ExtracurricularController as AdminExtracurricularController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostCategoryController as AdminPostCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\Public\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('public.home');
Route::get('/profil', fn () => redirect()->route('public.pages.show', 'profil-sekolah'))->name('public.profile');
Route::get('/akademik', fn () => redirect()->route('public.pages.show', 'akademik'))->name('public.academic');
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('public.pages.show');
Route::get('/berita', [PostController::class, 'index'])->name('public.posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('public.posts.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('public.galleries.index');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('public.galleries.show');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('public.extracurriculars.index');
Route::get('/kontak', [ContactController::class, 'create'])->name('public.contact');
Route::post('/kontak', [ContactController::class, 'store'])->middleware('throttle:public-contact')->name('public.contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->middleware('throttle:admin-login')->name('login.store');
    });

    Route::middleware(['auth', 'role:super-admin,content-admin,editor,viewer'])->group(function () {
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });

    Route::middleware(['auth', 'role:super-admin,content-admin,editor'])->group(function () {
        Route::resource('categories', AdminPostCategoryController::class)->except('show');
        Route::resource('posts', AdminPostController::class)->except('show');
        Route::resource('banners', AdminBannerController::class)->except('show');
        Route::resource('pages', AdminPageController::class)->except('show');
        Route::resource('extracurriculars', AdminExtracurricularController::class)->except('show');
        Route::resource('announcements', AdminAnnouncementController::class)->except('show');
        Route::resource('galleries', AdminGalleryController::class)->except('show');
        Route::get('/settings', [AdminSiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');
        Route::post('/settings/update', [AdminSiteSettingController::class, 'update'])->name('settings.update.post');
    });

    Route::middleware(['auth', 'role:super-admin'])->group(function () {
        Route::resource('users', AdminUserController::class)->except('show');
    });
});
