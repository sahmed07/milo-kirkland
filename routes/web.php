<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Registration Routes..
/*Route::get('/auth/createUser', 'RegistrationController@createUser')->name('auth.createUser');
Route::post('/auth/createUser', 'RegistrationController@postCreateUser')->name('auth.createUser');*/

// Profile Registration Routes..
Route::get('/auth/createProfile', 'RegistrationController@createProfile')->name('auth.createProfile');
Route::post('/auth/createProfile', 'RegistrationController@postCreateProfile')->name('auth.createProfile');

// Pet Registration Routes..
Route::get('/auth/reviewUser', 'RegistrationController@create')->name('auth.reviewUser');
Route::post('/auth/store', 'RegistrationController@store')->name('auth.store');

// After Registration Routes..
Route::view('afterRegister', 'afterRegister')->name('afterRegister');
//Route::view('admin', 'admin.index')->name('admin');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    
    Route::get('/home', 'HomeController@index');
    
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('profiles', 'Admin\ProfilesController');
    Route::post('profiles_mass_destroy', ['uses' => 'Admin\ProfilesController@massDestroy', 'as' => 'profiles.mass_destroy']);
    Route::post('profiles_restore/{id}', ['uses' => 'Admin\ProfilesController@restore', 'as' => 'profiles.restore']);
    Route::delete('profiles_perma_del/{id}', ['uses' => 'Admin\ProfilesController@perma_del', 'as' => 'profiles.perma_del']);
    Route::resource('payments', 'Admin\PaymentsController');
    Route::post('payments_mass_destroy', ['uses' => 'Admin\PaymentsController@massDestroy', 'as' => 'payments.mass_destroy']);
    Route::post('payments_restore/{id}', ['uses' => 'Admin\PaymentsController@restore', 'as' => 'payments.restore']);
    Route::delete('payments_perma_del/{id}', ['uses' => 'Admin\PaymentsController@perma_del', 'as' => 'payments.perma_del']);
    Route::resource('payments_rates', 'Admin\PaymentsRatesController');
    Route::post('payments_rates_mass_destroy', ['uses' => 'Admin\PaymentsRatesController@massDestroy', 'as' => 'payments_rates.mass_destroy']);
    Route::post('payments_rates_restore/{id}', ['uses' => 'Admin\PaymentsRatesController@restore', 'as' => 'payments_rates.restore']);
    Route::delete('payments_rates_perma_del/{id}', ['uses' => 'Admin\PaymentsRatesController@perma_del', 'as' => 'payments_rates.perma_del']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('pets', 'Admin\PetsController');
    Route::post('pets_mass_destroy', ['uses' => 'Admin\PetsController@massDestroy', 'as' => 'pets.mass_destroy']);
    Route::post('pets_restore/{id}', ['uses' => 'Admin\PetsController@restore', 'as' => 'pets.restore']);
    Route::delete('pets_perma_del/{id}', ['uses' => 'Admin\PetsController@perma_del', 'as' => 'pets.perma_del']);
    Route::resource('breeds', 'Admin\BreedsController');
    Route::post('breeds_mass_destroy', ['uses' => 'Admin\BreedsController@massDestroy', 'as' => 'breeds.mass_destroy']);
    Route::post('breeds_restore/{id}', ['uses' => 'Admin\BreedsController@restore', 'as' => 'breeds.restore']);
    Route::delete('breeds_perma_del/{id}', ['uses' => 'Admin\BreedsController@perma_del', 'as' => 'breeds.perma_del']);
    Route::resource('faq_categories', 'Admin\FaqCategoriesController');
    Route::post('faq_categories_mass_destroy', ['uses' => 'Admin\FaqCategoriesController@massDestroy', 'as' => 'faq_categories.mass_destroy']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('faq_questions', 'Admin\FaqQuestionsController');
    Route::post('faq_questions_mass_destroy', ['uses' => 'Admin\FaqQuestionsController@massDestroy', 'as' => 'faq_questions.mass_destroy']);
    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);
    Route::resource('cities', 'Admin\CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'Admin\CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);
    Route::post('cities_restore/{id}', ['uses' => 'Admin\CitiesController@restore', 'as' => 'cities.restore']);
    Route::delete('cities_perma_del/{id}', ['uses' => 'Admin\CitiesController@perma_del', 'as' => 'cities.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
