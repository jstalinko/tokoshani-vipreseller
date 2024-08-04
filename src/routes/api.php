<?php

use Illuminate\Support\Facades\Route;
use Jstalinko\TokoshaniVipreseller\Http\Controllers\VipresellerController;

Route::get('/profile' ,[VipresellerController::class , 'getProfile'])->name('tokoshani.vipreseller.profile');