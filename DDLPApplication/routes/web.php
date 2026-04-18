<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| Routes publiques (accessibles sans connexion)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/accueil', [UserController::class, 'showAssociations'])->name('accueil');

Route::get('/association-et-ong', [UserController::class, 'indexe'])->name('association-et-ong');

Route::get('/apropos', function () {
    return view('apropos');
})->name('apropos');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/association/{id}', [UserController::class, 'showDetails'])->name('association.details');

// Connexion utilisateur
Route::get('/connexion', [UserController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [UserController::class, 'authenticate'])->name('user.login');

// Inscription utilisateur (multi-étapes)
Route::get('/user/createForme1', function () {
    return view('con1');
})->name('user.createForme1');

Route::get('/user/createForme2', function () {
    return view('con2');
})->name('user.createForme2');

Route::get('/user/createForme3', function () {
    return view('con3');
})->name('user.createForme3');

Route::post('/user/createUserPartie1', [AccountController::class, 'createUserPartie1'])->name('user.createUserPartie1');
Route::post('/user/createUserPartie2', [AccountController::class, 'createUserPartie2'])->name('user.createUserPartie2');
Route::post('/user/createUserPartie3', [AccountController::class, 'createUserPartie3'])->name('user.createUserPartie3');

Route::get('/connexion/createForm3', function () {
    session(['origin' => 'connexion']);
    return view('crea2');
})->name('connexion.createForm3');

// Mot de passe oublié
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Connexion administrateur
Route::get('/conAdmin', [AdminController::class, 'showLoginForm'])->name('conAdmin');
Route::post('/conAdmin', [AdminController::class, 'authenticate'])->name('admin.login');

/*
|--------------------------------------------------------------------------
| Routes user authentifié
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/user/{id}', [UserController::class, 'shows'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/modifier-infos/{id}', [UserController::class, 'updateInfos'])->name('user.updateInfos');

    Route::get('/check-request-status', [AccountController::class, 'checkRequestStatus'])->name('check.request.status');

    Route::post('/activites/store', [ActivityController::class, 'store'])->name('activites.store');
    Route::delete('/activites/{id}', [ActivityController::class, 'destroy'])->name('activites.destroy');
    Route::put('/activites/{id}', [ActivityController::class, 'update'])->name('activites.update');

    Route::get('/request-form/{id}', function($id) {
        return view('user.show', compact('id'));
    })->name('request.form');

    Route::post('/generer-courrier', [RequestController::class, 'store'])->name('courrier.generate');
    Route::post('/request', [RequestController::class, 'handleRequest'])->name('request');

    // Logout user
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/connexion');
    })->name('user.logout');

});

/*
|--------------------------------------------------------------------------
| Routes admin authentifié
|--------------------------------------------------------------------------
*/

Route::middleware('auth:admin')->group(function () {

    Route::get('/admin', [StatistiqueController::class, 'getStats'])->name('admin');

    Route::get('/pdf/{id}', [StatistiqueController::class, 'download'])->name('pdf.download');
    Route::get('/statistiques/data', [StatistiqueController::class, 'getStats'])->name('statistiques.data');

    Route::get('/account/{id}', [AccountController::class, 'showPage'])->name('account.show');
    Route::get('/admin/edit/{id}', [AccountController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AccountController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [AccountController::class, 'delete'])->name('admin.delete');

    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

    Route::post('/admin/approve/{id}', [AccountController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AccountController::class, 'reject'])->name('admin.reject');

    Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');

    Route::post('/activites/{id}/validate', [ActivityController::class, 'validatActivity'])->name('activites.validate');
    Route::post('/activites/{id}/warn', [ActivityController::class, 'sendWarning'])->name('activites.warn');

    // Inscription admin (protégée — seul un admin connecté peut créer un autre admin)
    Route::get('/admin/createForme', function () {
        return view('conA');
    })->name('admin.createForme');

    Route::post('/admin/createAdmin', [AdminController::class, 'createAdmin'])->name('admin.createAdmin');

    Route::get('/admin/createForm1', function () {
        return view('crea');
    })->name('admin.createForm1');

    Route::get('/admin/createForm2', function () {
        return view('crea1');
    })->name('admin.createForm2');

    Route::get('/admin/createForm3', function () {
        session(['origin' => 'admin']);
        return view('crea2');
    })->name('admin.createForm3');

    Route::post('/admin/createUserType1', [AccountController::class, 'createUserType1'])->name('admin.createUserType1');
    Route::post('/admin/createUserType2', [AccountController::class, 'createUserType2'])->name('admin.createUserType2');
    Route::post('/admin/createUserType3', [AccountController::class, 'createUserType3'])->name('admin.createUserType3');

    Route::get('/admin/activities/create', [ActivityController::class, 'createAdmin'])->name('admin.activities.create');
    Route::post('/admin/activities/store', [ActivityController::class, 'storeAdmin'])->name('admin.activities.store');

    Route::get('/requests/{id}', [RequestController::class, 'show'])->name('requests.show');

    Route::get('/admin/export/domaine', [AdminController::class, 'exportByDomaine'])->name('pdf.exportByDomaine');
    Route::post('/admin/stats/pdf', [AdminController::class, 'exportStatsPdf'])->name('admin.stats.pdf');

    // Logout admin
    Route::post('/admin/logout', function (Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/conAdmin');
    })->name('admin.logout');

});
