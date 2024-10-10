<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use GraphQL\GraphQL as GraphQLGraphQL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Nuwave\Lighthouse\GraphQL;
// use Nuwave\Lighthouse\Support\Facades\GraphQL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/import-excel', [EmployeeController::class, 'import_excel']);
    Route::post('/import-excel', [EmployeeController::class, 'import_excel_post']);
    Route::get('/export-excel', [EmployeeController::class, 'export']);
    // GraphQL::routes();
});
