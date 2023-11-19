<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\RecipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::prefix('V1')->group(function () {

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::apiResource('recipes',RecipeController::class); //para definir los 5 métodos del api para recipes
    Route::get('tags', [TagController::class, 'index']);
    Route::get('tags/{tag}', [TagController::class, 'show']);

});
