<?php


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

Route::get('category-list', [App\Http\Controllers\CategoryController::class, 'categories']);
Route::post('save-category', [App\Http\Controllers\CategoryController::class, 'store']);
Route::delete('delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
Route::get('item-list', [App\Http\Controllers\ItemController::class, 'items']);
Route::post('save-item', [App\Http\Controllers\ItemController::class, 'store']);
Route::delete('delete-item/{id}', [App\Http\Controllers\ItemController::class, 'delete']);
