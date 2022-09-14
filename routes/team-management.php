<?php

// Admin panels from the ODK Link Package:
use Illuminate\Support\Facades\Route;
use Stats4sd\TeamManagement\Http\Controllers\TeamMemberController;

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array)config('backpack.base.web_middleware', 'web'),
        (array)config('backpack.base.middleware_key', 'admin'),
    ),
], function () {

    Route::get('team/{team}/members/create', [TeamMemberController::class, 'create'])->name('teammembers.create');
    Route::post('team/{team}/members', [TeamMemberController::class, 'store'])->name('teammembers.store');
    Route::get('team/{team}/members/{user}/edit', [TeamMemberController::class, 'edit'])->name('teammembers.edit');
    Route::put('team/{team}/members/{user}', [TeamMemberController::class, 'update'])->name('teammembers.update');
    Route::delete('team/{team}/members/{user}', [TeamMemberController::class, 'destroy'])->name('teammembers.destroy');
});


