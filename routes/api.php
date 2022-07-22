<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use App\Http\Controllers\Api\NotesandlabelController;
use App\Http\Controllers\VerificationController;
use App\Models\Label;
use App\Models\Notes;

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
Route::post('/addToNotes',[NotesandlabelController::class,'addToNotes']);
Route::post('/addTolabel',[NotesandlabelController::class,'addTolabel']);
Route::post('/joinTable',[NotesandlabelController::class,'joinTable']);
Route::post('/delete',[NotesandlabelController::class,'delete']);
Route::post('/updateNotes',[NotesandlabelController::class,'updateNotes']);
Route::post('/updateLabel',[NotesandlabelController::class,'updateLabel']);
Route::get('/getUser',[CacheController::class, 'getUser']);
Route::get('/getNotesAndLabel',[CacheController::class, 'getNotesAndLabel']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/changepassword',[VerificationController::class,'changepassword'])->middleware('auth:api');
// Route::middleware('auth:api')->group(function(){
//     Route::get('get-user',[UserController::class,'userInfo']);
//     //Route::get('',[NotesandlabelController::class,'addToNotes']);
// });

