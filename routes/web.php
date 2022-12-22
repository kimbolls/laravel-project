<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/add',[HomeController::class,'displayAddStudent']);
Route::post('/adddata',[HomeController::class,'addnewstudent']);

Route::get('/create',[HomeController::class,'displayAddProject']);
Route::post('/createproject',[HomeController::class,'addnewproject']);

Route::get('/displayprojects',[HomeController::class,'displayProjects']);
Route::get('/deleteproject/{id}',[HomeController::class,'deleteprojects']);

Route::get('/updateproject/{id}',[HomeController::class,'showupdate']);
Route::post('/update/{id}',[HomeController::class,'updateprojects']);


Route::get('/displaystudents',[HomeController::class,'displaystudents']);
Route::get('/deletestudent/{id}',[HomeController::class,'deletestudents']);

Route::view('/test','unusedhome');


// Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

