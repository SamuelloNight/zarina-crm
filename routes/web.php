<?php

use App\Http\Controllers\Web\AuthenticateController;
use App\Http\Controllers\Web\Customer\MainController;
use App\Http\Controllers\Web\Customer\OrdersController;
use App\Http\Controllers\Web\Customer\ProfileController;
use App\Http\Controllers\Web\Customer\ReviewsController;
use App\Http\Controllers\Web\Customer\SettingsController;
use App\Http\Controllers\Web\Manager\AuthenticateController as ManagerAuthenticateController;
use App\Http\Controllers\Web\Manager\CustomersController;
use App\Http\Controllers\Web\Manager\MainController as ManagerMainController;
use App\Http\Controllers\Web\Manager\OrdersController as ManagerOrdersController;
use App\Http\Controllers\Web\Manager\ReviewsController as ManagerReviewsController;
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
 * Routes for manager
 */
Route::prefix('manager')->group(function () {
  Route::get('/', function () {
    return redirect()->route('manager.orders.fresh');
  })->name('manager');

  Route::prefix('auth')->group(function () {
    Route::prefix('login')->group(function () {
      Route::get('/', [ManagerAuthenticateController::class, 'show'])->name('manager.login');
      Route::post('/', [ManagerAuthenticateController::class, 'login']);
    });

    Route::get('logout', [ManagerAuthenticateController::class, 'logout'])->name('manager.logout');
  });

  Route::prefix('dashboard')->middleware(['manager'])->group(function () {
    Route::get('main', [ManagerMainController::class, 'show'])->name('manager.main');

    Route::prefix('orders')->group(function () {
      Route::get('fresh', [ManagerOrdersController::class, 'showFresh'])->name('manager.orders.fresh');
      Route::get('processing', [ManagerOrdersController::class, 'showProcessing'])->name('manager.orders.processing');
      Route::get('more/{id}', [ManagerOrdersController::class, 'showMore'])->name('manager.orders.more');
      Route::get('accept/{id}', [ManagerOrdersController::class, 'accept'])->name('manager.orders.accept');
      Route::get('status/{id}', [ManagerOrdersController::class, 'status'])->name('manager.orders.status');
    });

    Route::prefix('reviews')->group(function () {
      Route::get('/', [ManagerReviewsController::class, 'show'])->name('manager.reviews');
      Route::get('publish-toggle/{id}', [ManagerReviewsController::class, 'publishToggle'])->name('manager.reviews.publish');
      Route::get('delete/{id}', [ManagerReviewsController::class, 'delete'])->name('manager.reviews.delete');
    });

    Route::prefix('customers')->group(function () {
      Route::get('/', [CustomersController::class, 'show'])->name('manager.customers');
      Route::get('edit/{id}', [CustomersController::class, 'showEdit'])->name('manager.customers.edit');
    });
  });
});

/**
 * Common routes
 */
Route::prefix('sys')->group(function () {
  Route::get('change-language', [LanguageController::class, 'change'])->name('sys.changeLanguage');
});
