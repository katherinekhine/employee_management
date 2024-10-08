<?php

use App\Http\Controllers\AuthController;
use GraphQL\GraphQL as GraphQLGraphQL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Nuwave\Lighthouse\GraphQL;
<<<<<<< HEAD
use Nuwave\Lighthouse\Support\Facades\GraphQL;
=======
// use Nuwave\Lighthouse\Support\Facades\GraphQL;
>>>>>>> c0c7afd (update api.php, app.php (after rollback))


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // GraphQL::routes();
});
