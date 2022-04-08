<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\BaseCode\UserManagement\UserController;
use App\Http\BaseCode\RolesandPermissions\RoleController;
use App\Http\BaseCode\SanctumRegisteration\RegisterController;
use App\Http\BaseCode\RolesandPermissions\PermissionController;

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

Route::group(['middleware'=>'auth:sanctum'], function() {
    
    // +++++++++++++++++++++++++++++++start Role api+++++++++++++++++++++++++++++++++++
    Route::post('roles/grant',              [RoleController::class  ,  'grant']);
    Route::post('roles/revoke',             [RoleController::class    , 'revoke']);
    Route::apiresource('roles',             RoleController::class);
    // +++++++++++++++++++++++++++++++end Role api+++++++++++++++++++++++++++++++++++++

    // +++++++++++++++++++++++++++++++start Permission api+++++++++++++++++++++++++++++
    Route::post('permissions/grant/{role}', [PermissionController::class,    'grant']);
    Route::post('permissions/revoke/{role}',[PermissionController::class,    'revoke']);
    Route::apiresource('permissions',        PermissionController::class)->except('update','store','destroy');
    // +++++++++++++++++++++++++++++++end Permission api+++++++++++++++++++++++++++++++

    // +++++++++++++++++++++++++++++++start UserManegment api++++++++++++++++++++++++++
    Route::get('users/count',               [UserController::class,'count']);
    Route::apiresource('users',             UserController::class)->except('show','update','store');
    // +++++++++++++++++++++++++++++++end UserManegment api++++++++++++++++++++++++++++

        
    // +++++++++++++++++++++++++++++++start Registerations api+++++++++++++++++++++++++
    Route::group(['prefix' => 'User','controller'=>RegisterController::class], function() {
        Route::post('/register',               'register');
        Route::get('/logout',                  'logout');
    });
    // +++++++++++++++++++++++++++++++end Registerations api+++++++++++++++++++++++++++

});

Route::post('/login',             [RegisterController::class,'login']);
