<?php

use App\Http\Controllers\Web\AuthenticateController;
use App\Http\Controllers\Web\Customer\MainController;
use App\Http\Controllers\Web\Customer\OrdersController;
use App\Http\Controllers\Web\Customer\ProfileController;
use App\Http\Controllers\Web\Customer\ReviewsController;
use App\Http\Controllers\Web\Customer\SettingsController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\System\LanguageController;
use Illuminate\Support\Facades\Route;

/**
 * Home page
 */
Route::get('/', [HomeController::class, 'show'])->name('home');

/**
 * Routes for authorization
 */
Route::prefix('auth')->group(function () {
  Route::prefix('register')->group(function () {
    Route::get('/', [AuthenticateController::class, 'show'])->name('customer.register');
    Route::post('/', [AuthenticateController::class, 'register'])->name('customer.register.form');
  });

  Route::prefix('login')->group(function () {
    Route::get('/', [AuthenticateController::class, 'show'])->name('customer.login');
    Route::post('/', [AuthenticateController::class, 'login'])->name('customer.login.form');
  });

  Route::get('logout', [AuthenticateController::class, 'logout'])->name('customer.logout');
});

/**
 * Routes for customer dashboard
 */
Route::prefix('dashboard')->middleware(['customer'])->group(function () {
  Route::get('main', [MainController::class, 'show'])->name('customer.dashboard.main');

  Route::prefix('orders')->group(function () {
    Route::get('list', [OrdersController::class, 'show'])->name('customer.dashboard.orders');
    Route::get('more/{id}', [OrdersController::class, 'more'])->name('customer.dashboard.orders.more');
    Route::get('delete/{id}', [OrdersController::class, 'delete'])->name('customer.dashboard.orders.delete');

    Route::prefix('create')->group(function () {
      Route::get('/', [OrdersController::class, 'show'])->name('customer.dashboard.order');
      Route::post('/', [OrdersController::class, 'create']);
    });
  });

  Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('customer.dashboard.profile');
  });

  Route::prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'show'])->name('customer.dashboard.settings');
    Route::post('profile', [SettingsController::class, 'profile'])->name('customer.dashboard.settings.profile');
    Route::post('password', [SettingsController::class, 'password'])->name('customer.dashboard.settings.password');
  });


  Route::prefix('reviews')->group(function () {
    Route::get('list', [ReviewsController::class, 'show'])->name('customer.dashboard.reviews');

    Route::prefix('create')->group(function () {
      Route::get('/', [ReviewsController::class, 'show'])->name('customer.dashboard.review');
      Route::post('/', [ReviewsController::class, 'create']);
    });
  });
});

/**
 * Common routes
 */
Route::prefix('sys')->group(function () {
  Route::get('change-language', [LanguageController::class, 'change'])->name('sys.changeLanguage');
});
