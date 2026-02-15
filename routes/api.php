<?php

use App\Http\Controllers\API\ConsumebleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('category/{type}', [ConsumebleController::class, 'category']);
Route::get('education/{categoryId}', [ConsumebleController::class, 'educationByCategory']);
Route::get('recipe/{categoryId}', [ConsumebleController::class, 'RecipeByCategory']);
Route::get('education/{slug}', [ConsumebleController::class, 'detailEducation']);
Route::get('recipe/{slug}', [ConsumebleController::class, 'detailRecipe']);
