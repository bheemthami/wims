<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

/** website route  ---START--- **/
Route::group(['namespace' => 'Frontend'], function () {
	Route::get('/', 'FrontendController@index')->name('index');
	Route::get('/contact-us', 'FrontendController@contact_us')->name('contact-us');
	Route::get('/collect-visitor_queries', 'VisitorQueryController@collectQueries')->name('visitor-queries.collect');
	Route::get('/about-us', 'FrontendController@about_us')->name('about-us');

	Route::get('/page', 'FrontendController@pageBySlug')->name('frontend.page');

	Route::get('/post-details/{post}', 'FrontendController@publishedPostBySlug')->name('post-details');
	Route::get('/all-published-post', 'FrontendController@allPublishedPosts')->name('all-posts');

	Route::get('/event-details/{event}', 'FrontendController@publishedEventBySlug')->name('event-details');
	Route::get('/all-published-events', 'FrontendController@allPublishedEvents')->name('all-events');

	Route::get('/program/{program}', 'FrontendController@publishedProgramBySlug')->name('program-details');

	Route::get('/training/{training}', 'FrontendController@publishedTrainingBySlug')->name('training-details');

	Route::get('/photo-gallery', 'FrontendController@publishedPhotos')->name('photo-gallery');

	Route::get('/photo-gallery/{slug}', 'FrontendController@publishedGalleryBySlug')->name('photo-gallery-details');

	Route::get('/video-gallery', 'FrontendController@publishedVideos')->name('video-gallery');

	Route::get('/publications', 'FrontendController@publishedPublications')->name('publications');
	Route::get('/programs', 'FrontendController@publishedPrograms')->name('programs');
	Route::get('/trainings', 'FrontendController@publishedTrainings')->name('trainings');
	Route::get('/faculties', 'FrontendController@publishedFaculties')->name('faculties');
	Route::get('/facilities', 'FrontendController@publishedFacilities')->name('facilities');
	Route::get('/download/{file}', 'FrontendController@download')->name('downlaod');
	Route::get('/download-posts/{file}', 'FrontendController@downloadPosts')->name('posts.downlaod');
});

/** website route  ---END--- **/

Route::group(['prefix' => 'admin', 'middleware' => ['sauth']], function () {
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');

	Route::resource('/academic-years', 'Admin\AcademicYearController');
	Route::resource('/users', 'Admin\UserController');
	Route::resource('/roles', 'Admin\RoleController');
	Route::resource('/settings', 'Admin\SettingController');

	Route::resource('designations', 'Admin\DesignationController');

	Route::get('database-backup-list', 'Backup\BackupController@index');

	Route::get('database-backup', 'Backup\BackupController@databaseBackup');
});


Route::group(['prefix' => 'admin', 'middleware' => ['sauth'], 'namespace' => 'Admin'], function () {

	// user permissions
	Route::get('users/{user}/permissions_create', 'PermissionController@createUserPermissions')->name('create.user.permissions');

	Route::post('users/{user}/permissions', 'PermissionController@storeUserPermissions')->name('store.user.permissions');

	Route::get('users/{user}/permissions_edit', 'PermissionController@editUserPermissions')->name('edit.user.permissions');

	Route::patch('users/{user}/permissions_update', 'PermissionController@updateUserPermissions')->name('update.user.permissions');

	Route::get('user_permissions/{user}', 'PermissionController@showUserPermissions')->name('show.user.permissions');

	Route::delete('roles/{role}/permissions', 'PermissionController@destroy')->name('destroy.role.permissions');


	// role permissions
	Route::get('role_permissions/{role}/create', 'PermissionController@createRolePermissions')->name('create.role.permissions');

	Route::post('roles/{role}/permissions', 'PermissionController@storeRolePermissions')->name('store.role.permissions');

	Route::get('role_permissions/{role}/edit', 'PermissionController@editRolePermissions')->name('edit.role.permissions');

	Route::patch('role_permissions/{role}/update', 'PermissionController@updateRolePermissions')->name('update.role.permissions');

	Route::get('role_permissions/{role}', 'PermissionController@showRolePermissions')->name('show.role.permissions');

	Route::delete('roles/{role}/permissions', 'PermissionController@destroy')->name('destroy.role.permissions');

	Route::get('modules', 'ModuleController@index')->name('modules.index');
});

/*User's profile route ---- START ------*/
Route::group(['prefix' => 'user', 'middleware' => ['sauth'], 'namespace' => 'Admin'], function () {
	Route::get('profile', 'ProfileController@index')->name('profile.index');
	Route::get('profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
	Route::patch('profile/{user}/update', 'ProfileController@update')->name('profile.update');
});

Route::group(['prefix' => 'user', 'middleware' => ['sauth'], 'namespace' => 'Auth'], function () {
	Route::get('/change-password', 'ChangePasswordController@changePasswordForm')->name('change_password.create');
	Route::post('/change-password', 'ChangePasswordController@changePassword')->name('change_password.store');
	Route::get('users/{user}/restore-default-password', 'UserController@restoreDefaultPassword')->name('users.restore-default-password');
});
/*User's profile route ---- END ------*/

/*Frontend module route ---- START ------*/
Route::group(['prefix' => 'admin', 'middleware' => ['sauth'], 'namespace' => 'Frontend'], function () {

	Route::post('/upload', 'PageController@uploadimage')->name('ckeditor.upload');
	Route::resource('pages', 'PageController');
	Route::resource('visitor_queries', 'VisitorQueryController');
	Route::resource('post-categories', 'PostCategoryController');
	Route::resource('posts', 'PostController');
	Route::resource('events', 'EventController');
	Route::resource('banners', 'BannerController');
	Route::resource('document-types', 'DocumentTypeController');
	Route::resource('documents', 'DocumentController');
	Route::resource('galleries', 'GalleryController');

	Route::delete('image-galleries/{image}', 'GalleryController@destroyImage')->name('image-galleries.destroy');
	Route::resource('training-categories', 'TrainingCategoryController');
	Route::resource('training-types', 'TrainingTypeController');
	Route::resource('trainings', 'TrainingController');
	Route::resource('programs', 'ProgramController');
	Route::resource('facilities', 'FacilityController');
	Route::resource('testimonials', 'TestimonialController');
	Route::resource('quick-links', 'QuickLinkController');
	Route::resource('departments', 'DepartmentController');
	Route::resource('officials', 'OfficialController');
	Route::resource('embeddings', 'EmbedController');
});
/*Frontend module route ---- END ------*/

/*Developer route ---- START ------*/
Route::get('/migrate-9843191193', 'Dev\DevController@migrate');
Route::get('/clear-9843191193', 'Dev\DevController@clear');
Route::get('/seed-9843191193', 'Dev\DevController@seed');
/*Developer route ---- END ------*/
