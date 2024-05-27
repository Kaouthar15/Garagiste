<?php

use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\RegisterController;
use LaravelLang\Publisher\Console\Add;

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

        Route::group(
            ['middleware' => ['auth', 'is_verify_email']],
            function () {
                Route::get('dashboard', [
                    RegisterController::class,
                    'dashboard',
                ]);
            }
        );
        Route::get('account/verify/{token}', [
            RegisterController::class,
            'verifyAccount',
        ])->name('user.verify');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('users', 'index');
            Route::get('users-export', 'export')->name('users.export');
            Route::post('users-import', 'import')->name('users.import');
        });
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
            Route::put('/user/{id}', [AdminController::class, 'update'])->name(
                'user.update'
            );
            Route::get('/user/{user}/edit', [
                AdminController::class,
                'edit',
            ])->name('user.edit');
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
            Route::put('/vehicles/{vehicle}', [
                VehicleController::class,
                'update',
            ])->name('vehicle.update');
            Route::resource('vehicule', VehicleController::class);
            Route::get('/getVehicleImages/{id}', 'VehicleController@getImages');
            Route::get('/statistics/user', 'AdminController@chartsUser')->name(
                'user.statistics'
            );
            Route::get(
                '/statistics/vehicle',
                'VehicleController@chartsVehicle'
            )->name('vehicle.statistics');
            Route::get(
                '/users/{user}/download-pdf',
                'AdminController@downloadPDF'
            )->name('users.download-pdf');
            Route::get(
                '/vehicles/{vehicle}/download-pdf',
                'VehicleController@downloadPDF'
            )->name('vehicles.download-pdf');
            Route::post('/vehicle/delete', [
                VehicleController::class,
                'delete',
            ])->name('vehicle.delete');
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
Route::get('/changeLocale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});
