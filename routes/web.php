<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VehicleController;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name(
            'register.show'
        );
        Route::post('/register', 'RegisterController@register')->name(
            'register.perform'
        );

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        /**
         * Forget and Reset password Routes
         */
        Route::get(
            'forget-password',
            'ForgotPasswordController@showForgetPasswordForm'
        )->name('forget.password.get');
        Route::post(
            'forget-password',
            'ForgotPasswordController@submitForgetPasswordForm'
        )->name('forget.password.post');
        Route::get(
            'reset-password/{token}',
            'ForgotPasswordController@showResetPasswordForm'
        )->name('reset.password.get');
        Route::post(
            'reset-password',
            'ForgotPasswordController@submitResetPasswordForm'
        )->name('reset.password.post');
    });

    Route::group(['middleware' => ['auth']], function () {
        // Profile edit 
        // Route::get('/profile/edit', 'AdminController@edit')->name(
        //     'profile.edit'
        // );
        // Route::post('/profile/update', 'AdminController@update')->name(
        //     'profile.update'
        // );
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name(
            'logout.perform'
        );

        Route::middleware(['checkUserRole:admin'])->group(function () {
            Route::get('/admin/dashboard', 'AdminController@dashboard')->name(
                'admin.dashboard'
            );
            // Users routes
            Route::get('/create', 'AdminController@create')->name(
                'admin.create'
            );
            Route::get('/show', 'AdminController@show')->name('admin.show');
            Route::post('/user/store', 'AdminController@store')->name(
                'admin.store'
            );
            Route::post('/user/search', 'AdminController@search')->name(
                'admin.search'
            );
            Route::resource('user', AdminController::class); 
            Route::get('/details/{id}', 'AdminController@details')->name(
                'admin.details'
            );
            // Vehicles routes
            Route::get('/createv', 'VehicleController@create')->name(
                'vehicle.create'
            );
            Route::get('/showv', 'VehicleController@show')->name(
                'vehicle.show'
            );
            Route::post('/vehicle/search', 'VehicleController@search')->name(
                'vehicle.search'
            );
            Route::post('/vehicle/store', 'VehicleController@store')->name(
                'vehicle.store'
            );
            Route::post('/vehicle/delete', [
                VehicleController::class,
                'delete',
            ])->name('vehicle.delete');
            // Route::get('/details_vehicle/{id}', 'VehicleController@details')->name('vehicle.details');
            Route::resource('vehicule', VehicleController::class);
            Route::get('/getVehicleImages/{id}', 'VehicleController@getImages');
        });

        Route::middleware([
            'checkUserRole:client',
            'checkUserRole:mechanic',
        ])->group(function () {
            // Both routes
            Route::get('/both/dashboard', 'BothController@dashboard')->name(
                'both.dashboard'
            );
        });

        Route::middleware(['checkUserRole:client'])->group(function () {
            // Client routes
            Route::get('/client/dashboard', 'ClientController@dashboard')->name(
                'client.dashboard'
            );
        });

        Route::middleware(['checkUserRole:mechanic'])->group(function () {
            // Mechanic routes
            Route::get(
                '/mechanic/dashboard',
                'MechanicController@dashboard'
            )->name('mechanic.dashboard');
        });
    });
});
