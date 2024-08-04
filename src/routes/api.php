<?php

use Illuminate\Support\Facades\Route;
use Jstalinko\TokoshaniVipreseller\Http\Controllers\VipresellerController;

Route::group(['prefix' => 'shn-api'], function () {
    Route::get('/profile', [VipresellerController::class, 'getProfile'])->name('tokoshani.vipreseller.profile');
    Route::group(['prefix' => '/services'], function () {
        Route::get('/games', [VipresellerController::class, 'getGameFeatureServices'])->name('tokoshani.vipreseller.gamefeatureservices');
        Route::get('/prepaid', [VipresellerController::class, 'getPrepaidServices'])->name('tokoshani.vipreseller.prepaidservices');
    });
});
