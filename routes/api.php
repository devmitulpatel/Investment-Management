<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Kisan Vikar Patra For Users
    Route::apiResource('kisan-vikar-patra-for-users', 'KisanVikarPatraForUserApiController');

    // Policy For Users
    Route::apiResource('policy-for-users', 'PolicyForUserApiController');

    // Fd For Users
    Route::apiResource('fd-for-users', 'FdForUserApiController');

    // Bank Accounts
    Route::apiResource('bank-accounts', 'BankAccountsApiController');

    // Bank For Admins
    Route::apiResource('bank-for-admins', 'BankForAdminApiController');

    // Branch Of Banks For Admins
    Route::apiResource('branch-of-banks-for-admins', 'BranchOfBanksForAdminApiController');

    // Holders For Admins
    Route::apiResource('holders-for-admins', 'HoldersForAdminApiController');

    // Nsc For Users
    Route::apiResource('nsc-for-users', 'NscForUserApiController');

    // Nominees For Admins
    Route::apiResource('nominees-for-admins', 'NomineesForAdminApiController');

    // Insurance For Users
    Route::apiResource('insurance-for-users', 'InsuranceForUserApiController');

    // Fd Recurring For Users
    Route::apiResource('fd-recurring-for-users', 'FdRecurringForUserApiController');
});
