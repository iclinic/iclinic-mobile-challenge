<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\PhysicianController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CLINICS
Route::get(
    'clinics',
    [ClinicController::class, 'index']
)->middleware('auth:api');

Route::get(
    'clinics/{id}',
    [ClinicController::class, 'getById']
)->middleware('auth:api');

Route::post(
    'clinics',
    [ClinicController::class, 'store']
)->middleware('auth:api');


Route::put(
    'clinics/{id}',
    [ClinicController::class, 'update']
)->middleware('auth:api');

Route::delete(
    'clinics/{id}',
    [ClinicController::class, 'delete']
)->middleware('auth:api');

// PATIENTS
Route::get(
    'patients',
    [PatientController::class, 'index']
)->middleware('auth:api');

Route::get(
    'patients/{id}',
    [PatientController::class, 'getById']
)->middleware('auth:api');

Route::post(
    'patients',
    [PatientController::class, 'store']
)->middleware('auth:api');


Route::put(
    'patients/{id}',
    [PatientController::class, 'update']
)->middleware('auth:api');

Route::delete(
    'patients/{id}',
    [PatientController::class, 'delete']
)->middleware('auth:api');

// PHYSICIANS
Route::get(
    'physicians',
    [PhysicianController::class, 'index']
)->middleware('auth:api');

Route::get(
    'physicians/{id}',
    [PhysicianController::class, 'getById']
)->middleware('auth:api');

Route::post(
    'physicians',
    [PhysicianController::class, 'store']
)->middleware('auth:api');


Route::put(
    'physicians/{id}',
    [PhysicianController::class, 'update']
)->middleware('auth:api');

Route::delete(
    'physicians/{id}',
    [PhysicianController::class, 'delete']
)->middleware('auth:api');


// PRESCRIPTIONS
Route::get(
    'prescriptions',
    [PrescriptionController::class, 'index']
)->middleware('auth:api');

Route::get(
    'prescriptions/{id}',
    [PrescriptionController::class, 'getById']
)->middleware('auth:api');

Route::post(
    'prescriptions',
    [PrescriptionController::class, 'store']
)->middleware('auth:api');


Route::put(
    'prescriptions/{id}',
    [PrescriptionController::class, 'update']
)->middleware('auth:api');

Route::delete(
    'prescriptions/{id}',
    [PrescriptionController::class, 'delete']
)->middleware('auth:api');
