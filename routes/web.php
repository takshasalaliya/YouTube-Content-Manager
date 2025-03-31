<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




Route::middleware(['Admin:admin'])->group(function(){
    //    
       Route::get('/', function () {
           return view('index');
       });
     Route::post('manually_form',[UserController::class,'manually_form']);
     Route::post('excel',[UserController::class,'excel']);
     Route::get('list',[UserController::class,'list']);
     Route::post('file/{id}',[UserController::class,'file']);
     Route::get('/dowload',[UserController::class,'dowload']);
     Route::get('/logout',[UserController::class,'logout']);
     Route::post('/share/{id}',[UserController::class,'share']);
});


Route::get('/login_',[UserController::class,'login']);
Route::get('/register/{id}',[UserController::class,'form']);
Route::view('/login','login');

