<?php

use App\Http\Controllers\Boilerplate\Auth\ForgotPasswordController;
use App\Http\Controllers\Boilerplate\Auth\LoginController;
use App\Http\Controllers\Boilerplate\Auth\RegisterController;
use App\Http\Controllers\Boilerplate\Auth\ResetPasswordController;
use App\Http\Controllers\Boilerplate\DatatablesController;
use App\Http\Controllers\Boilerplate\GptController;
use App\Http\Controllers\Boilerplate\ImpersonateController;
use App\Http\Controllers\Boilerplate\LanguageController;
use App\Http\Controllers\Boilerplate\Logs\LogViewerController;
use App\Http\Controllers\Boilerplate\Select2Controller;
use App\Http\Controllers\Boilerplate\Users\RolesController;
use App\Http\Controllers\Boilerplate\Users\UsersController;
use App\Http\Controllers\PernikahanController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BankController;

Route::group([
    'prefix'     => config('boilerplate.app.prefix', ''),
    'domain'     => config('boilerplate.app.domain', ''),
    'middleware' => ['web', 'boilerplate.locale'],
    'as'         => 'boilerplate.',
], function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Language switch
    if (config('boilerplate.locale.switch', false)) {
        Route::post('language', [LanguageController::class, 'switch'])->name('lang.switch');
    }

    // Frontend
    Route::group(['middleware' => ['boilerplate.guest']], function () {
        // Login
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        // Registration
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.post');

        // Password reset
        Route::prefix('password')->as('password.')->group(function () {
            Route::get('request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('request');
            Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
            Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('reset');
            Route::post('reset', [ResetPasswordController::class, 'reset'])->name('reset.post');
        });

        // First login
        Route::get('connect/{token?}', [UsersController::class, 'firstLogin'])->name('users.firstlogin');
        Route::post('connect/{token?}', [UsersController::class, 'firstLoginPost'])->name('users.firstlogin.post');
    });

    // Email verification
    Route::prefix('email')->middleware('boilerplate.auth')->as('verification.')->group(function () {
        Route::get('verify', [RegisterController::class, 'emailVerify'])->name('notice');
        Route::get('verify/{id}/{hash}', [RegisterController::class, 'emailVerifyRequest'])->name('verify');
        Route::post('verification-notification', [RegisterController::class, 'emailSendVerification'])->name('send');
    });

    // Backend
    Route::group(['middleware' => ['boilerplate.auth', 'ability:admin,backend_access', 'boilerplate.emailverified']], function () {
        // Impersonate another user
        if (config('boilerplate.app.allowImpersonate', false)) {
            Route::as('impersonate.')->group(function () {
                Route::get('unauthorized', [ImpersonateController::class, 'unauthorized'])->name('unauthorized');
                Route::prefix('impersonate')->group(function () {
                    Route::post('/', [ImpersonateController::class, 'impersonate'])->name('user');
                    Route::get('stop', [ImpersonateController::class, 'stopImpersonate'])->name('stop');
                    Route::post('select', [ImpersonateController::class, 'selectImpersonate'])->name('select');
                });
            });
        }

        // Dashboard
        Route::get('/', [config('boilerplate.menu.dashboard'), 'index'])->name('dashboard');

        // Galeri
        Route::get('/galeri', [GaleriController::class, 'index'])
            ->middleware(['boilerplateauth', 'ability:admin,lihat_galeri'])
            ->name('galeri');

        // Pernikahan
        Route::get('/pernikahan', [PernikahanController::class, 'index'])
            ->middleware(['boilerplateauth'])
            ->name('pernikahan');
        Route::post('/pernikahan', [PernikahanController::class, 'store'])
            ->middleware(['boilerplateauth'])
            ->name('store-pernikahan');
        Route::get('/show-pernikahan', [PernikahanController::class, 'show'])
            ->middleware(['boilerplateauth'])
            ->name('show-pernikahan');
        Route::get('/edit-pernikahan/{id}', [PernikahanController::class, 'edit'])
            ->middleware(['boilerplateauth'])
            ->name('edit-pernikahan');
        Route::put('/update-pernikahan/{id}', [PernikahanController::class, 'update'])
            ->middleware(['boilerplateauth'])
            ->name('update-pernikahan');
        Route::get('/preview-pernikahan/{id}', [PernikahanController::class, 'preview'])
            ->middleware(['boilerplateauth'])
            ->name('preview-pernikahan');

        // Rekening
        Route::get('/rekening', [RekeningController::class, 'index'])
            ->middleware(['boilerplateauth', 'ability:admin,lihat_rekening'])
            ->name('rekening');

        // Tamu
        Route::get('/tamu', [TamuController::class, 'index'])
            ->middleware(['boilerplateauth', 'ability:admin,lihat_tamu'])
            ->name('tamu');

        // Komentar
        Route::get('/komentar', [KomentarController::class, 'index'])
            ->middleware(['boilerplateauth', 'ability:admin,lihat_komentar'])
            ->name('komentar');

        // Bank
        Route::get('/bank', [BankController::class, 'index'])
            ->middleware(['boilerplateauth', 'ability:admin,lihat_bank'])
            ->name('bank');

        // Session keep-alive
        Route::post('keep-alive', [UsersController::class, 'keepAlive'])->name('keepalive');

        // Datatables
        Route::post('datatables/{slug}', [DatatablesController::class, 'make'])->name('datatables');
        Broadcast::channel('dt.{name}.{signature}', function ($user, $name, $signature) {
            return channel_hash_equals($signature, 'dt', $name);
        });

        // Select2
        Route::post('select2', [Select2Controller::class, 'make'])->name('select2');

        // Roles and users
        Route::resource('roles', RolesController::class)->except('show')->middleware(['ability:admin,roles_crud']);
        Route::resource('users', UsersController::class)->middleware('ability:admin,users_crud')->except('show');

        // Profile
        Route::prefix('userprofile')->as('user.')->group(function () {
            Route::get('/', [UsersController::class, 'profile'])->name('profile');
            Route::post('/', [UsersController::class, 'profilePost'])->name('profile.post');
            Route::post('settings', [UsersController::class, 'storeSetting'])->name('settings');
            Route::get('avatar/url', [UsersController::class, 'getAvatarUrl'])->name('avatar.url');
            Route::post('avatar/upload', [UsersController::class, 'avatarUpload'])->name('avatar.upload');
            Route::post('avatar/gravatar', [UsersController::class, 'getAvatarFromGravatar'])->name('avatar.gravatar');
            Route::post('avatar/delete', [UsersController::class, 'avatarDelete'])->name('avatar.delete');
        });

        // ChatGPT
        if (config('boilerplate.app.openai.key')) {
            Route::prefix('gpt')->as('gpt.')->group(function () {
                Route::get('/', [GptController::class, 'index'])->name('index');
                Route::post('/', [GptController::class, 'process'])->name('process');
            });
        }

        // Logs
        if (config('boilerplate.app.logs', false)) {
            Route::prefix('logs')->as('logs.')->middleware('ability:admin,logs')->group(function () {
                Route::get('/', [LogViewerController::class, 'index'])->name('dashboard');
                Route::prefix('list')->group(function () {
                    Route::get('/', [LogViewerController::class, 'listLogs'])->name('list');
                    Route::delete('delete', [LogViewerController::class, 'delete'])->name('delete');
                    Route::prefix('{date}')->group(function () {
                        Route::get('/', [LogViewerController::class, 'show'])->name('show');
                        Route::get('download', [LogViewerController::class, 'download'])->name('download');
                        Route::get('{level}', [LogViewerController::class, 'showByLevel'])->name('filter');
                    });
                });
            });
        }
    });
});
