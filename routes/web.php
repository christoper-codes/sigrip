<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

/*
* App Dashboard Routes
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'pages.app.dashboard')->name('dashboard');
    Route::view('company', 'pages.app.company.index')->name('company.index');
    Route::view('departments', 'pages.app.department.index')->name('department.index');
    Route::view('employees', 'pages.app.employee.index')->name('employee.index');
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
