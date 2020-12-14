<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Kisan Vikar Patra For Users
    Route::delete('kisan-vikar-patra-for-users/destroy', 'KisanVikarPatraForUserController@massDestroy')->name('kisan-vikar-patra-for-users.massDestroy');
    Route::resource('kisan-vikar-patra-for-users', 'KisanVikarPatraForUserController');

    // Policy For Users
    Route::delete('policy-for-users/destroy', 'PolicyForUserController@massDestroy')->name('policy-for-users.massDestroy');
    Route::resource('policy-for-users', 'PolicyForUserController');

    // Fd For Users
    Route::delete('fd-for-users/destroy', 'FdForUserController@massDestroy')->name('fd-for-users.massDestroy');
    Route::resource('fd-for-users', 'FdForUserController');

    // Bank Accounts
    Route::delete('bank-accounts/destroy', 'BankAccountsController@massDestroy')->name('bank-accounts.massDestroy');
    Route::resource('bank-accounts', 'BankAccountsController');

    // Bank For Admins
    Route::delete('bank-for-admins/destroy', 'BankForAdminController@massDestroy')->name('bank-for-admins.massDestroy');
    Route::resource('bank-for-admins', 'BankForAdminController');

    // Branch Of Banks For Admins
    Route::delete('branch-of-banks-for-admins/destroy', 'BranchOfBanksForAdminController@massDestroy')->name('branch-of-banks-for-admins.massDestroy');
    Route::resource('branch-of-banks-for-admins', 'BranchOfBanksForAdminController');

    // Holders For Admins
    Route::delete('holders-for-admins/destroy', 'HoldersForAdminController@massDestroy')->name('holders-for-admins.massDestroy');
    Route::resource('holders-for-admins', 'HoldersForAdminController');

    // Nsc For Users
    Route::delete('nsc-for-users/destroy', 'NscForUserController@massDestroy')->name('nsc-for-users.massDestroy');
    Route::resource('nsc-for-users', 'NscForUserController');

    // Nominees For Admins
    Route::delete('nominees-for-admins/destroy', 'NomineesForAdminController@massDestroy')->name('nominees-for-admins.massDestroy');
    Route::resource('nominees-for-admins', 'NomineesForAdminController');

    // Insurance For Users
    Route::delete('insurance-for-users/destroy', 'InsuranceForUserController@massDestroy')->name('insurance-for-users.massDestroy');
    Route::resource('insurance-for-users', 'InsuranceForUserController');

    // Fd Recurring For Users
    Route::delete('fd-recurring-for-users/destroy', 'FdRecurringForUserController@massDestroy')->name('fd-recurring-for-users.massDestroy');
    Route::resource('fd-recurring-for-users', 'FdRecurringForUserController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
