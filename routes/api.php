<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

//**VAMOS BUSCAR OS DADOS À BD**
//NomeController que criamos com o comando

//Users
Route::get('/users', [UserController::class, 'index']);
Route::prefix('/user')->group(function (){
        Route::post('/store', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    }
);

//Customers
Route::get('/customers', [CustomerController::class, 'index']);
Route::prefix('/customer')->group(function (){
        Route::post('/store', [CustomerController::class, 'store']);
        Route::get('/{customer}', [CustomerController::class, 'show']);
        Route::put('/{id}', [CustomerController::class, 'update']);
        Route::delete('/{id}', [CustomerController::class, 'destroy']);
    }
);

//Products
Route::get('/products', [ProductController::class, 'index']);
Route::prefix('/product')->group(function (){
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/{product}', [ProductController::class, 'show']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    }
);

//Orders
Route::get('/orders', [OrderController::class, 'index']);
Route::prefix('/order')->group(function (){
        Route::post('/store', [OrderController::class, 'store']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'destroy']);
    }
);

//Order Items
Route::get('/orderItems', [OrderItemController::class, 'index']);
Route::prefix('/orderItem')->group(function (){
        Route::post('/store', [OrderItemController::class, 'store']);
        Route::get('/{orderItem}', [OrderItemController::class, 'show']);
        Route::put('/{id}', [OrderItemController::class, 'update']);
        Route::delete('/{id}', [OrderItemController::class, 'destroy']);
    }
);