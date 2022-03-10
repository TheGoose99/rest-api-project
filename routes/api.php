<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\CustomerController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

});

Route::resource('/employee', EmployeeController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class);
Route::resource('/expense', ExpenseController::class);

Route::Post('/salary/paid/{id}', [SalaryController::class, 'Paid']);
Route::Get('/salary', [SalaryController::class, 'AllSalary']);
Route::Get('/salary/view/{id}', [SalaryController::class, 'ViewSalary']);
Route::Get('/edit/salary/{id}', [SalaryController::class, 'EditSalary']);
Route::Post('/salary/update/{id}', [SalaryController::class, 'SalaryUpdate']);

Route::PATCH('/stock/update/{id}', [ProductController::class, 'StockUpdate']);

Route::resource('/customer', CustomerController::class);
