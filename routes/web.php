<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Coach\CoachController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\FianceController;


Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::get('/', [App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::get('evenements', [App\Http\Controllers\EvenementController::class, 'index'])->name('evenements.index');
    Route::get('evenements/{evenement}', [App\Http\Controllers\EvenementController::class, 'show'])->name('evenements.show'); 

    Route::get('evenements/{evenement}/export-pdf', [App\Http\Controllers\EvenementController::class, 'exportPdf'])->name('evenements.exportPdf');
}); 


// Routes protégées par rôle

    // Routes pour les administrateurs
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/admin/coaches', [App\Http\Controllers\Admin\CoachController::class, 'index'])->name('admin.coaches.index');
        Route::get('/admin/coaches/create', [App\Http\Controllers\Admin\CoachController::class, 'create'])->name('admin.coaches.create');
        Route::post('/admin/coaches', [App\Http\Controllers\Admin\CoachController::class, 'store'])->name('admin.coaches.store');
        Route::get('/admin/coaches/{coach}/edit', [App\Http\Controllers\Admin\CoachController::class, 'edit'])->name('admin.coaches.edit');
        Route::put('/admin/coaches/{coach}', [App\Http\Controllers\Admin\CoachController::class, 'update'])->name('admin.coaches.update');
        Route::delete('/admin/coaches/{coach}', [App\Http\Controllers\Admin\CoachController::class, 'destroy'])->name('admin.coaches.destroy');

        Route::get('/admin/fiances', [App\Http\Controllers\Admin\FianceController::class, 'index'])->name('admin.fiances.index');
        Route::get('/admin/fiances/create', [App\Http\Controllers\Admin\FianceController::class, 'create'])->name('admin.fiances.create');
        Route::post('/admin/fiances', [App\Http\Controllers\Admin\FianceController::class, 'store'])->name('admin.fiances.store'); 
        Route::get('/admin/fiances/{fiance}', [App\Http\Controllers\Admin\FianceController::class, 'show'])->name('admin.fiances.show'); 
        Route::get('/admin/fiances/{fiance}/edit', [App\Http\Controllers\Admin\FianceController::class, 'edit'])->name('admin.fiances.edit');
        Route::put('/admin/fiances/{fiance}', [App\Http\Controllers\Admin\FianceController::class, 'update'])->name('admin.fiances.update');
        Route::delete('/admin/fiances/{fiance}', [App\Http\Controllers\Admin\FianceController::class, 'destroy'])->name('admin.fiances.destroy');

        Route::get('/admin/fiancailles', [App\Http\Controllers\Admin\FiancailleController::class, 'index'])->name('admin.fiancailles.index');
        Route::get('/admin/fiancailles/create', [App\Http\Controllers\Admin\FiancailleController::class, 'create'])->name('admin.fiancailles.create');
        Route::post('/admin/fiancailles', [App\Http\Controllers\Admin\FiancailleController::class, 'store'])->name('admin.fiancailles.store');
        Route::get('/admin/fiancailles/{fiancaille}', [App\Http\Controllers\Admin\FiancailleController::class, 'show'])->name('admin.fiancailles.show');
        Route::get('/admin/fiancailles/{fiancaille}/edit', [App\Http\Controllers\Admin\FiancailleController::class, 'edit'])->name('admin.fiancailles.edit');
        Route::put('/admin/fiancailles/{fiancaille}', [App\Http\Controllers\Admin\FiancailleController::class, 'update'])->name('admin.fiancailles.update');
        Route::delete('/admin/fiancailles/{fiancaille}', [App\Http\Controllers\Admin\FiancailleController::class, 'destroy'])->name('admin.fiancailles.destroy');

        Route::get('/admin/couple-coaches', [App\Http\Controllers\Admin\CoupleCoachController::class, 'index'])->name('admin.couple-coaches.index');
        Route::get('/admin/couple-coaches/create', [App\Http\Controllers\Admin\CoupleCoachController::class, 'create'])->name('admin.couple-coaches.create');
        Route::post('/admin/couple-coaches', [App\Http\Controllers\Admin\CoupleCoachController::class, 'store'])->name('admin.couple-coaches.store');
        Route::get('/admin/couple-coaches/{coupleCoach}', [App\Http\Controllers\Admin\CoupleCoachController::class, 'show'])->name('admin.couple-coaches.show');
        Route::get('/admin/couple-coaches/{coupleCoach}/edit', [App\Http\Controllers\Admin\CoupleCoachController::class, 'edit'])->name('admin.couple-coaches.edit');
        Route::put('/admin/couple-coaches/{coupleCoach}', [App\Http\Controllers\Admin\CoupleCoachController::class, 'update'])->name('admin.couple-coaches.update');
        Route::delete('/admin/couple-coaches/{coupleCoach}', [App\Http\Controllers\Admin\CoupleCoachController::class, 'destroy'])->name('admin.couple-coaches.destroy');

        Route::get('/admin/coachings', [App\Http\Controllers\Admin\CoachingController::class, 'index'])->name('admin.coachings.index');
        Route::get('/admin/coachings/create', [App\Http\Controllers\Admin\CoachingController::class, 'create'])->name('admin.coachings.create');
        Route::post('/admin/coachings', [App\Http\Controllers\Admin\CoachingController::class, 'store'])->name('admin.coachings.store');
        Route::get('/admin/coachings/{coaching}', [App\Http\Controllers\Admin\CoachingController::class, 'show'])->name('admin.coachings.show');
        Route::get('/admin/coachings/{coaching}/edit', [App\Http\Controllers\Admin\CoachingController::class, 'edit'])->name('admin.coachings.edit');
        Route::put('/admin/coachings/{coaching}', [App\Http\Controllers\Admin\CoachingController::class, 'update'])->name('admin.coachings.update');
        Route::delete('/admin/coachings/{coaching}', [App\Http\Controllers\Admin\CoachingController::class, 'destroy'])->name('admin.coachings.destroy');

        Route::get('/admin/rapports', [App\Http\Controllers\Admin\RapportController::class, 'index'])->name('admin.rapports.index');
        Route::get('/admin/rapports/{rapport}', [App\Http\Controllers\Admin\RapportController::class, 'show'])->name('admin.rapports.show');

        Route::get('/admin/statistiques', [App\Http\Controllers\Admin\StatsController::class, 'index'])->name('admin.statistiques.index');

    });


    // Routes pour les managers
    Route::middleware(['auth','manager'])->group(function () {
        Route::get('/manager/dashboard', [App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('manager.dashboard');
        
        Route::get('/manager/users', [App\Http\Controllers\Manager\UserController::class, 'index'])->name('manager.users.index');
        Route::put('/manager/users/{user}', [App\Http\Controllers\Manager\UserController::class, 'show'])->name('manager.users.show');

        Route::get('/manager/couple-coaches', [App\Http\Controllers\Manager\CoupleCoachController::class, 'index'])->name('manager.couple-coaches.index');
        Route::get('/manager/couple-coaches/{coupleCoach}', [App\Http\Controllers\Manager\CoupleCoachController::class, 'show'])->name('manager.couple-coaches.show');

        Route::get('/manager/fiances', [App\Http\Controllers\Manager\FianceController::class, 'index'])->name('manager.fiances.index');
        Route::get('/manager/fiances/{fiance}', [App\Http\Controllers\Manager\FianceController::class, 'show'])->name('manager.fiances.show');

        Route::get('/manager/fiancailles', [App\Http\Controllers\Manager\FiancailleController::class, 'index'])->name('manager.fiancailles.index');
        Route::get('/manager/fiancailles/{fiancaille}', [App\Http\Controllers\Manager\FiancailleController::class, 'show'])->name('manager.fiancailles.show');

        Route::get('/manager/coachings', [App\Http\Controllers\Manager\CoachingController::class, 'index'])->name('manager.coachings.index');
        Route::get('/manager/coachings/{coaching}', [App\Http\Controllers\Manager\CoachingController::class, 'show'])->name('manager.coachings.show');  

        Route::get('/manager/rapports', [App\Http\Controllers\Manager\RapportController::class, 'index'])->name('manager.rapports.index');
        Route::get('/manager/rapports/{rapport}', [App\Http\Controllers\Manager\RapportController::class, 'show'])->name('manager.rapports.show');

    });

    // Routes pour les coachs
    Route::middleware(['auth','coach'])->group(function () {
        Route::get('/coach/dashboard', [App\Http\Controllers\Coach\DashboardController::class, 'index'])->name('coach.dashboard');

        Route::get('/coach/profile', [App\Http\Controllers\Coach\ProfileController::class, 'edit'])->name('coach.profile.edit');
        Route::put('/coach/profile', [App\Http\Controllers\Coach\ProfileController::class, 'updateProfile'])->name('coach.profile.update');
        Route::put('/coach/password', [App\Http\Controllers\Coach\ProfileController::class, 'updatePassword'])->name('coach.password.update');

        Route::get('/coach/fiances', [App\Http\Controllers\Coach\FianceController::class, 'index'])->name('coach.fiances.index');
        Route::get('/coach/fiances/{fiance}', [App\Http\Controllers\Coach\FianceController::class, 'show'])->name('coach.fiances.show');

        Route::get('/coach/fiancailles', [App\Http\Controllers\Coach\FiancailleController::class, 'index'])->name('coach.fiancailles.index');
        Route::get('/coach/fiancailles/{fiancaille}', [App\Http\Controllers\Coach\FiancailleController::class, 'show'])->name('coach.fiancailles.show');
        Route::get('/coach/fiancailles/{fiancaille}/edit', [App\Http\Controllers\Coach\FiancailleController::class, 'edit'])->name('coach.fiancailles.edit');
        Route::put('/coach/fiancailles/{fiancaille}', [App\Http\Controllers\Coach\FiancailleController::class, 'update'])->name('coach.fiancailles.update');

        Route::get('/coach/coachings', [App\Http\Controllers\Coach\CoachingController::class, 'index'])->name('coach.coachings.index');
        Route::get('/coach/coachings/{coaching}', [App\Http\Controllers\Coach\CoachingController::class, 'show'])->name('coach.coachings.show');
        Route::get('/coach/coachings/{coaching}/edit', [App\Http\Controllers\Coach\CoachingController::class, 'edit'])->name('coach.coachings.edit');
        Route::put('/coach/coachings/{coaching}', [App\Http\Controllers\Coach\CoachingController::class, 'update'])->name('coach.coachings.update');
        //Route::get('/coach/coachings/{coaching}/create-rapport', [App\Http\Controllers\Coach\RapportController::class, 'create'])->name('coach.rapports.create');
        //Route::post('/coach/coachings/{coaching}/store-rapport', [App\Http\Controllers\Coach\RapportController::class, 'store'])->name('coach.rapports.store');
        //Route::get('/coach/coachings/{coaching}/edit-rapport', [App\Http\Controllers\Coach\RapportController::class, 'edit'])->name('coach.rapports.edit');
        //Route::put('/coach/coachings/{coaching}/update-rapport', [App\Http\Controllers\Coach\RapportController::class, 'update'])->name('coach.rapports.update');
        //Route::delete('/coach/coachings/{coaching}/destroy-rapport', [App\Http\Controllers\Coach\RapportController::class, 'destroy'])->name('coach.rapports.destroy');
        //Route::get('/coach/coachings/{coaching}/download-rapport', [App\Http\Controllers\Coach\RapportController::class, 'download'])->name('coach.rapports.download');
        //Route::get('/coach/coachings/{coaching}/print-rapport', [App\Http\Controllers\Coach\RapportController::class, 'print'])->name('coach.rapports.print');
        //Route::get('/coach/coachings/{coaching}/send-whatsapp-rapport', [App\Http\Controllers\Coach\RapportController::class, 'sendWhatsapp'])->name('coach.rapports.send-whatsapp');
        Route::get('/coach/coachings/{coaching}/rapports', [App\Http\Controllers\Coach\RapportController::class, 'index'])->name('coach.rapports.index');
        Route::get('/coach/coachings/{coaching}/rapports/{rapport}', [App\Http\Controllers\Coach\RapportController::class, 'show'])->name('coach.rapports.show');
        
        Route::get('/coach/rapports', [App\Http\Controllers\Coach\RapportController::class, 'index'])->name('coach.rapports.index');
        Route::get('/coach/rapports/{rapport}', [App\Http\Controllers\Coach\RapportController::class, 'show'])->name('coach.rapports.show');
        Route::get('/coach/rapports/{coaching}/create', [App\Http\Controllers\Coach\RapportController::class, 'create'])->name('coach.rapports.create');
        Route::post('/coach/rapports/{coaching}', [App\Http\Controllers\Coach\RapportController::class, 'store'])->name('coach.rapports.store');
        Route::get('/coach/rapports/{rapport}/edit', [App\Http\Controllers\Coach\RapportController::class, 'edit'])->name('coach.rapports.edit');
        Route::put('/coach/rapports/{rapport}', [App\Http\Controllers\Coach\RapportController::class, 'update'])->name('coach.rapports.update');
        Route::delete('/coach/rapports/{rapport}', [App\Http\Controllers\Coach\RapportController::class, 'destroy'])->name('coach.rapports.destroy');
        Route::get('/coach/rapports/{rapport}/download', [App\Http\Controllers\Coach\RapportController::class, 'download'])->name('coach.rapports.download');
        Route::get('/coach/rapports/{rapport}/print', [App\Http\Controllers\Coach\RapportController::class, 'print'])->name('coach.rapports.print');
        Route::get('/coach/rapports/{rapport}/send-whatsapp', [App\Http\Controllers\Coach\RapportController::class, 'sendWhatsapp'])->name('coach.rapports.send-whatsapp');
    
    });
    

