<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTypesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/employees/{id?}', [EmployeesController::class, 'index']);
Route::post('/employees', [EmployeesController::class, 'create']);
Route::post('/employees/{id}', [EmployeesController::class, 'update']);
Route::put('/employees/{id}', [EmployeesController::class, 'update']);
Route::delete('/employees/{id}', [EmployeesController::class, 'delete']);


Route::get('login', function () {
    $response = ['message' => 'Invalid Token', 'status' => 'error'];
    return response()->json($response, 401);
})->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request  $request) {
    return $request->user();
});


// Api  products types admin site
Route::get('product-types/{id?}', [ProductTypesController::class, 'index']);
Route::post('product-types', [ProductTypesController::class, 'create']);
Route::post('product-types/{id}', [ProductTypesController::class, 'update']);
Route::put('product-types/{id}', [ProductTypesController::class, 'update']);
Route::delete('product-types/{id}', [ProductTypesController::class, 'delete']);





// Api products  admin site
Route::get('products/{id?}', [ProductsController::class, 'index']);
Route::post('products', [ProductsController::class, 'create']);
Route::post('products/{id}', [ProductsController::class, 'update']);
Route::put('products/{id}', [ProductsController::class, 'update']);
Route::delete('products/{id}', [ProductsController::class, 'delete']);



// Api show products types cho customer site

Route::get('public/product-types', [ProductTypesController::class, 'publicGetAll']);


// Api products  customer site
Route::get('public/products', [ProductsController::class, 'publicGetProductsAll']);

// Api admin site
Route::get('/admin-site', [AdminController::class, 'index']);


//Customer Site
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::post('order', [OrderController::class, 'order']);