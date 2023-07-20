<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
// use App\Http\Controllers\User\PackageController;
use App\Http\Controllers\User\SocialLoginController;
use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PocController;
use App\Http\Controllers\User\BackgroundController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\SceneController;
use App\Http\Controllers\User\SceneInvitationController;
use App\Http\Controllers\User\SubscriptionPlanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Route::redirect('/', '/login');

// Route::get('/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });

// Pages
Route::get('/', 'HomeController@index')->name('home');
// Terms and Conditions page route
Route::get('/terms-and-conditions', [PagesController::class, 'terms'])->name('terms');

// Privacy Policy page route
Route::get('/privacy-policy', [PagesController::class, 'privacy'])->name('privacy');


Auth::routes(['register' => false, 'verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['admin', 'auth']], function () {

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Package
    Route::delete('packages/destroy', 'PackageController@massDestroy')->name('packages.massDestroy');
    Route::post('packages/media', 'PackageController@storeMedia')->name('packages.storeMedia');
    Route::post('packages/ckmedia', 'PackageController@storeCKEditorImages')->name('packages.storeCKEditorImages');
    Route::resource('packages', 'PackageController');
});
// TODO: admin profile seperate
Route::group(['prefix' => 'profile', 'as' => 'user.profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

// Route::group(['middleware' => ['auth', 'verified']], function () {

// Host 
Route::group(['middleware' => ['auth', '2fa']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name("user.dashboard");
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('profile/ajax/user/detail', [ProfileController::class, 'ajaxGetUserDetail'])->name('profile.ajax.user.detail');


    //Scene Management
    Route::get('scenes', [SceneController::class, 'index'])->name('scenes.index');
    Route::get('scene/create', [SceneController::class, 'create'])->name('scene.create');
    Route::post('scene/store', [SceneController::class, 'store'])->name('scene.store');
    Route::get('scene/artboard/{scene}', [SceneController::class, 'artBoard'])->name('scene.artboard');
    Route::delete('scene/delete/{id}', [SceneController::class, 'delete'])->name('scene.delete');
    Route::put('/scene/artboard/{uuid}', [SceneController::class, 'update'])->name('scene.update');
    Route::get('scene/invitation/{id}', [SceneController::class, 'invitation'])->name('scene.invitation');
    Route::get('scene/pdf/{id}', [SceneController::class, 'generatePDFScene'])->name('scene.generate.pdf');


    //Scene Thread
    Route::get('scene/item/thread/ajax', [SceneController::class, 'ajaxItemThread'])->name('scene.ajax.item.thread');
    Route::post('scene/item/thread/ajax/update', [SceneController::class, 'ajaxItemThreadUpdate'])->name('scene.ajax.item.thread.update');
    Route::post('scene/item/thread/ajax/delete', [SceneController::class, 'ajaxItemThreadDelete'])->name('scene.ajax.item.thread.delete');
    Route::post('item/item/thread/exists/ajax', [SceneController::class, 'ajaxCheckThreadExists'])->name('scene.ajax.item.thread.exists');
    Route::get('scene/item/thread/generate/pdf', [SceneController::class, 'generatePDFItemPlace'])->name('scene.item.thread.generate.pdf');
    Route::get('scene/item/thread/ajax/filter', [SceneController::class, 'ajaxItemFilterThread'])->name('scene.item.thread.ajax.filter');

    // Route
    Route::post('scene/item/thread/save-caption', [SceneController::class, 'saveCaption'])->name('save.item.thread.caption');
    // Scenes Invite
    Route::get('invite/{scene}', [SceneInvitationController::class, 'invite'])->name('invite');
    Route::post('invite/process', [SceneInvitationController::class, 'process'])->name('invite.process');
    Route::get('search-user', [SceneInvitationController::class, 'searchUser'])->name('search-user');

    //Item Management

    Route::post('item/store', [ItemController::class, 'store'])->name('item.store');
    Route::post('item/addPhotoBank', [ItemController::class, 'addPhotoBank'])->name('item.add.photo.bank');
    Route::post('item/deleteItem', [ItemController::class, 'delete'])->name('item.delete');
    Route::get('item/search', [ItemController::class, 'search'])->name('item.search');
    Route::get('item/index', [ItemController::class, 'index'])->name('item.index');
    Route::delete('item/delete/photobank/index/{id}', [ItemController::class, 'deletePhotoBankIndex'])->name('item.delete.photobank.index');

    //Background Management

    Route::post('background/store', [BackgroundController::class, 'store'])->name('background.store');
    Route::post('background/delete', [BackgroundController::class, 'delete'])->name('background.delete');
    Route::get('background/search', [BackgroundController::class, 'search'])->name('background.search');
    Route::get('background/index', [BackgroundController::class, 'index'])->name('background.index');
    Route::delete('background/delete/index/{id}', [BackgroundController::class, 'deleteBackgroundIndex'])->name('background.delete.index');


    //Subscription

    Route::get('plans', [SubscriptionPlanController::class, 'index'])->name("plans.index");
    Route::get('plans/{package}', [SubscriptionPlanController::class, 'show'])->name("plans.show");
    Route::post('subscription', [SubscriptionPlanController::class, 'createOrUpdate'])->name("subscription.create");
    Route::get('cancel', [SubscriptionPlanController::class, 'cancel'])->name("subscription.cancel");

    //Gallery Management
    Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
    Route::get('gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::get('gallery/show/{id}', [GalleryController::class, 'show'])->name('gallery.show');

    //Notifications
    Route::get('notifications/index', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/mark-as-all-read',  [NotificationController::class, 'markAsAllRead'])->name('notifications.markAsAllRead');
    Route::get('notifications/mark-as-read',  [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

// TODO:Remove when html finalize
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');

Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name("user.signup");
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('accept/{token}', [SceneInvitationController::class, 'accept'])->name('accept');

// Social Login

Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback',  [SocialLoginController::class, 'handleProviderCallback']);

Route::middleware('auth')->group(function () {
    // This code is two Factor Authentication but over requirement we are using only one time verifaction code
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('verification', [TwoFactorController::class, 'show'])->name('twoFactor.show');
        Route::post('two-factor', [TwoFactorController::class, 'check'])->middleware(['throttle:10,1,verify-2fa-code-web'])->name('twoFactor.check');
        Route::get('two-factor/resend', [TwoFactorController::class, 'resend'])->middleware(['throttle:10,1,resend-2fa-code-web'])->name('twoFactor.resend');
    }
});

Route::stripeWebhooks('stripe-webhook');

// TODO:POC route will be remover when scene task done
Route::get('pocr', [PocController::class, 'index']);


Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {

    $invoice = $request->user()->findInvoice($invoiceId);
    $logoPath = public_path('images/logo.png');
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor' => 'Efanfare',
        'logo' => $logoPath,
    ]);
});
