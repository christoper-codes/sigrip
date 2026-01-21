<?php

use App\Http\Controllers\GoogleController;
use App\Http\Middleware\AlertMiddleware;
use App\Http\Middleware\AnalysisMiddleware;
use App\Http\Middleware\ApplicationMiddleware;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\DepartmentMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\IndexApplicationMiddleware;
use App\Http\Middleware\QuestionnaireMiddleware;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

Route::get('auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'callback']);
/*
* App Dashboard Routes
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'pages.app.dashboard')->name('dashboard');

    Route::view('company', 'pages.app.company.index')
            ->middleware(CompanyMiddleware::class)
            ->name('company.index');

    Route::view('departments', 'pages.app.department.index')
            ->middleware(DepartmentMiddleware::class)
            ->name('department.index');

    Route::view('employees', 'pages.app.employee.index')
            ->middleware(EmployeeMiddleware::class)
            ->name('employee.index');

    Route::view('notifications', 'pages.app.notification.index')->name('notification.index');

    Route::view('applications', 'pages.app.application.index')
        ->name('application.index');

    Route::view('questionnaires', 'pages.app.questionnaire.index')
        ->middleware(QuestionnaireMiddleware::class)
        ->name('questionnaire.index');

    Route::view('analysis', 'pages.app.analysis.index')
        ->middleware(AnalysisMiddleware::class)
        ->name('analysis.index');

    Route::view('alerts', 'pages.app.alert.index')
        ->middleware(AlertMiddleware::class)
        ->name('alert.index');

    Route::view('tickets', 'pages.app.ticket.index')->name('ticket.index');
});

Route::view('applications/inactive', 'pages.app.application.inactive')->name('application.inactive');
Route::view('applications/answered', 'pages.app.application.answered')->name('application.answered');
Route::view('applications/thanks', 'pages.app.application.thanks')->name('application.thanks');

Route::middleware(ApplicationMiddleware::class)->group(function () {
    Route::get('applications/{slug}', function (Request $request) {
        $application = $request->attributes->get('application');
        $is_visitor = $request->attributes->get('is_visitor');

        return view('pages.app.application.show', compact('application', 'is_visitor'));
    })->name('application.show');
});

/*
* User Settings Routes
*/
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
