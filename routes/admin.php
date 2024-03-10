<?php

use App\Http\Controllers\HeroController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes for User Dashboard
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.pages.home');
    });

    //Hero routes
    Route::get('hero/home', [HeroController::class, 'Hero'])->name('home.hero');
    Route::get('hero/add', [HeroController::class, 'AddHero'])->name('add.hero');
    Route::post('hero/store', [HeroController::class, 'StoreHero'])->name('store.hero');
    Route::get('hero/edit/{id}', [HeroController::class, 'EditHero']);
    Route::post('hero/update/{id}', [HeroController::class, 'UpdateHero']);
    Route::get('hero/delete/{id}', [HeroController::class, 'DeleteHero']);

});