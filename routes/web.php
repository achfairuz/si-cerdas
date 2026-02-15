<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Education\EducationController;
use App\Http\Controllers\Recipe\RecipeController;
use App\Http\Controllers\User\ProfileController;
use App\Models\Category;
use App\Models\Education;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $latestRecipe = Recipe::latest()->first();
    $latestEducation = Education::latest()->first();
    return view('pages.user.home', compact('latestRecipe', 'latestEducation'));
})->name('home');

Route::get('/tentang', function () {
    return view('pages.user.tentang');
})->name('tentang');


Route::get('/education/{slug}', [EducationController::class, 'show'])
    ->name('education.show');
Route::get('/recipe/{slug}', [RecipeController::class, 'show'])
    ->name('recipe.show');



// Route::get('/login', function () {
//     return view('pages.auth.login');
// })->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {

        $recipeCountRaw = Recipe::count();
        $educationCountRaw = Education::count();
        $categoryCountRaw = Category::count();

        return view('pages.admin.dashboard', [
            'recipeCount' => number_format($recipeCountRaw),
            'educationCount' => number_format($educationCountRaw),
            'categoryCount' => number_format($categoryCountRaw),
        ]);
    })->name('admin.dashboard');



    Route::prefix('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('educations', EducationController::class);
        Route::resource('recipes', RecipeController::class);
        Route::resource('users', ProfileController::class);
    });
    Route::get('/admin/change-password', [ProfileController::class, 'changePasswordForm'])
        ->name('users.password.form');

    Route::put('/admin/change-password', [ProfileController::class, 'changePassword'])
        ->name('users.password.update');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
