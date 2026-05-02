<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\RequestManagementController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AssociationRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIQUES (sans authentification)
|--------------------------------------------------------------------------
*/

Route::get('/', [UserController::class, 'showAssociations']);

Route::get('/accueil', [UserController::class, 'showAssociations'])->name('accueil');
Route::get('/association-et-ong', [UserController::class, 'indexe'])->name('association-et-ong');

Route::get('/apropos', function () { return view('pages.apropos'); })->name('apropos');
Route::get('/faq', function () { return view('pages.faq'); })->name('faq');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
Route::get('/api/associations/{id}/activities', [ReviewController::class, 'getActivitiesForAssociation'])->name('api.activities');
Route::post('/reviews/store-from-home', [ReviewController::class, 'storeFromHome'])->name('reviews.storeFromHome');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/association/{id}', [UserController::class, 'showDetails'])->name('association.details');
Route::post('/association/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// --- Auth User ---
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('connexion');
Route::post('/connexion', [LoginController::class, 'authenticate'])->name('user.login');

// --- Inscription User (3 étapes) ---
Route::get('/user/createForme1', fn() => view('auth.register-step1'))->name('user.createForme1');
Route::get('/user/createForme2', fn() => view('auth.register-step2'))->name('user.createForme2');
Route::get('/user/createForme3', fn() => view('auth.register-step3'))->name('user.createForme3');
Route::post('/user/createUserPartie1', [RegisterController::class, 'createUserPartie1'])->name('user.createUserPartie1');
Route::post('/user/createUserPartie2', [RegisterController::class, 'createUserPartie2'])->name('user.createUserPartie2');
Route::post('/user/createUserPartie3', [RegisterController::class, 'createUserPartie3'])->name('user.createUserPartie3');

// --- Auth Admin ---
Route::get('/conAdmin', [AdminLoginController::class, 'showLoginForm'])->name('conAdmin');
Route::post('/conAdmin', [AdminLoginController::class, 'authenticate'])->name('admin.login');
Route::get('/admin/createForme', fn() => view('auth.admin-login'))->name('admin.createForme');
Route::post('/admin/createAdmin', [AdminLoginController::class, 'createAdmin'])->name('admin.createAdmin');

// --- Mot de passe oublié ---
Route::get('/password/reset', fn() => view('auth.passwords.email'))->name('password.request');
Route::post('/password/email', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| ROUTES USER AUTHENTIFIÉ (middleware auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/user/{id}', [UserController::class, 'shows'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/modifier-infos/{id}', [UserController::class, 'updateInfos'])->name('user.updateInfos');

    Route::post('/activites/store', [ActivityController::class, 'store'])->name('activites.store');
    Route::put('/activites/{id}', [ActivityController::class, 'update'])->name('activites.update');

    Route::post('/generer-courrier', [AssociationRequestController::class, 'store'])->name('courrier.generate');
    Route::post('/request', [AssociationRequestController::class, 'handleRequest'])->name('request');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('connexion');
    })->name('user.logout');
});

/*
|--------------------------------------------------------------------------
| ROUTES ADMIN AUTHENTIFIÉ (middleware auth:admin)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Associations
    Route::get('/admin/associations', [AssociationController::class, 'index'])->name('admin.associations.index');
    Route::get('/account/{id}', [AssociationController::class, 'showPage'])->name('account.show');
    Route::get('/admin/edit/{id}', [AssociationController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AssociationController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [AssociationController::class, 'delete'])->name('admin.delete');

    // Inscription par admin (3 étapes)
    Route::get('/admin/createForm1', fn() => view('admin.associations.create-step1'))->name('admin.createForm1');
    Route::get('/admin/createForm2', fn() => view('admin.associations.create-step2'))->name('admin.createForm2');
    Route::get('/admin/createForm3', function () {
        session(['origin' => 'admin']);
        return view('admin.associations.create-step3');
    })->name('admin.createForm3');
    Route::post('/admin/createUserType1', [AssociationController::class, 'createUserType1'])->name('admin.createUserType1');
    Route::post('/admin/createUserType2', [AssociationController::class, 'createUserType2'])->name('admin.createUserType2');
    Route::post('/admin/createUserType3', [AssociationController::class, 'createUserType3'])->name('admin.createUserType3');

    // Demandes
    Route::get('/admin/requests', [RequestManagementController::class, 'index'])->name('admin.requests.index');
    Route::get('/requests/{id}', [AssociationRequestController::class, 'show'])->name('requests.show');
    Route::post('/admin/approve/{id}', [RequestManagementController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [RequestManagementController::class, 'reject'])->name('admin.reject');

    // Activités admin
    Route::get('/admin/activities', [AdminActivityController::class, 'index'])->name('admin.activities.index');
    Route::get('/admin/activities/create', [AdminActivityController::class, 'createAdmin'])->name('admin.activities.create');
    Route::post('/admin/activities/store', [AdminActivityController::class, 'storeAdmin'])->name('admin.activities.store');
    Route::post('/activites/{id}/publish', [AdminActivityController::class, 'publish'])->name('activites.publish');
    Route::post('/activites/{id}/validate', [AdminActivityController::class, 'validatActivity'])->name('activites.validate');
    Route::delete('/activites/{id}', [AdminActivityController::class, 'destroy'])->name('activites.destroy');
    Route::post('/activites/{id}/warn', [AdminActivityController::class, 'sendWarning'])->name('activites.warn');

    // Avis admin (Modération)
    Route::get('/admin/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::post('/admin/reviews/{id}/approve', [\App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::delete('/admin/reviews/{id}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // Notifications
    Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');

    // Exports PDF
    Route::get('/pdf/{id}', [ExportController::class, 'downloadAssociationPdf'])->name('pdf.download');
    Route::get('/admin/export/domaine', [ExportController::class, 'exportByDomaine'])->name('pdf.exportByDomaine');
    Route::post('/admin/stats/pdf', [ExportController::class, 'exportStatsPdf'])->name('admin.stats.pdf');

    // Logout admin
    Route::post('/admin/logout', function (Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('conAdmin');
    })->name('admin.logout');
});
