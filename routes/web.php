<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimelogsController;
use App\Http\Controllers\ProjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// get list action
Route::get('timelogs-list', [TimelogsController::class, 'index']);

//add new entry action
Route::get('add-new-timelog', [TimelogsController::class, 'create']);

//Store a newly created resource in storage.
Route::post('store-form', [TimelogsController::class, 'store']);

//Edite time log row
Route::get('{row_id}/edit-time-log', [TimelogsController::class, 'edit'])->name('my-edit');

//Delete time log row
Route::get('{row_id}/delete-time-log', [TimelogsController::class, 'destroy'])->name('my-delete');

//update time log row
Route::post('update-row', [TimelogsController::class, 'update']);

//show time log in chart
Route::get('chartjs', [TimelogsController::class, 'chartshow']);

//Export time logs data to csv file
Route::get('expot-timelogs', [TimelogsController::class, 'exportCsv'])->name('expot-timelogs');

//add new project action
Route::get('add-new-project', [ProjectsController::class, 'create']);

//Store a newly created resource in storage.
Route::post('store-project-form', [ProjectsController::class, 'store']);

// get list action
Route::get('projects-list', [ProjectsController::class, 'index']);



