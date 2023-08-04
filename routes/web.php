<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FavoriteController;
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
    return view('welcome');
});

Route::post('/favorite', [FavoriteController::class, 'favorite'])->name('favorite');


Route::get('/', [FrontendController::class, 'index'])->name('welcome.index');
Route::get('/aboutus', [FrontendController::class, 'aboutus'])->name('aboutus.index');
Route::get('/details/{id}', [FrontendController::class, 'viewrecipe'])->name('recipedetails.index');
Route::get('/category/{id}', [FrontendController::class, 'viewcategory'])->name('categorydetails');


Route::get('/addrecipe', [RecipesController::class, 'index'])->name('recipe.index');
Route::get('/recipeform', [RecipesController::class, 'view'])->name('recipe.form');
Route::post('/recipeform', [RecipesController::class, 'store'])->name('recipe.store');
Route::group(['middleware'=>'auth'],function()
    {
    Route::group(['middleware'=> 'role:admin','prefix'=> 'admin', 'as'=> 'admin.'],function()
    {
        Route::resource('recipe', RecipeController::class);
    });
    });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('dashboard.index');
});


//User
Route::get('/userform', [UserController::class, 'index'])->name('user.index');
Route::post('/userform',[UserController::class,'register']);
Route::get('/usertable',[UserController::class,'view'])->name('userview');
Route::get('/user/edit/{id}',[UserController::class,'edit'])->name("useredit");
Route::post('/user/update/{id}',[UserController::class,'update'])->name("userupdate");
Route::get('/customer/delete/{id}',[UserController::class,'delete'])->name("userdelete");

//catagory
Route::get('/categoryform', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categoryform',[CategoryController::class,'register']);
Route::get('/categorytable',[CategoryController::class,'view'])->name('categoryview');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name("categoryedit");
Route::post('/category/update/{id}',[CategoryController::class,'update'])->name("categoryupdate");
Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name("categorydelete");

//ingredients

Route::get('/ingredientform', [IngredientsController::class, 'index'])->name('ingredient.index');
Route::post('/ingredientform',[IngredientsController::class,'register']);
Route::get('/ingredienttable',[IngredientsController::class,'view'])->name('ingredientview');
Route::get('/ingredient/edit/{id}',[IngredientsController::class,'edit'])->name("ingredientedit");
Route::post('/ingredient/update/{id}',[IngredientsController::class,'update'])->name("ingredientupdate");
Route::get('/ingredient/delete/{id}',[IngredientsController::class,'delete'])->name("ingredientdelete");

//recipe

Route::get('/recipe/edit/{id}',[RecipesController::class,'edit'])->name("recipeedit");
Route::post('/recipe/update/{id}',[RecipesController::class,'update'])->name("recipeupdate");
Route::get('/recipe/delete/{id}',[RecipesController::class,'destroy'])->name("recipedelete");
Route::get('/recipetable',[RecipesController::class,'table'])->name('recipeview');
