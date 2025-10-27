<?php
use Illuminate\Support\Facades\Route;

Route::apiResource('products', \App\Http\Controllers\ProductController::class);
Route::apiResource('tasks', \App\Http\Controllers\TaskController::class);

?>