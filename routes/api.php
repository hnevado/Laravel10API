<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\RecipeController;

use App\Http\Controllers\Api\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/*
Para testear las peticiones, instalar telescope:
composer require laravel/telescope
php artisan telescope:install
*/


//Ruta de inicio de sesión para la creación de token

Route::get('login',[LoginController::class,'store']);

//composer require laravel/sanctum
//El token se puede generar por terminal con tinker: php artisan tinker
//$user = App\Models\User::find(5);  
//$user->createToken('app'); 
//plainTextToken: "1|8SEiMoHStTiXbEDa8K4QkRM7JKzoDM8bRMCmPbWra7f5fcd1",

Route::middleware('auth:sanctum')->group(function () {

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::apiResource('recipes',RecipeController::class); //para definir los 5 métodos del api para recipes
    Route::get('tags', [TagController::class, 'index']);
    Route::get('tags/{tag}', [TagController::class, 'show']);

});


/*
Route::get('recipes', [RecipeController::class, 'index']);
Route::post('recipes', [RecipeController::class, 'store']);
Route::get('recipes/{recipe}', [RecipeController::class, 'show']);
Route::put('recipes', [RecipeController::class, 'update']);
Route::delete('recipes', [RecipeController::class, 'destroy']);
*/

