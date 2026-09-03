<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

Route::get('assets/{path}', function ($path) {
    $assetsRoot = realpath(base_path('assets'));
    $requestedPath = realpath(base_path('assets/' . $path));

    if (!$assetsRoot || !$requestedPath || strpos($requestedPath, $assetsRoot) !== 0 || !is_file($requestedPath)) {
        abort(404);
    }

    if (strpos($path, 'files/') === 0) {
        return response(file_get_contents($requestedPath), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    return response()->file($requestedPath);
})->where('path', '.*');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/get-tamu', 'DashboardController@downloadTamu')->name('tamu.download');

Route::get(base64_decode('ZW5rcmlwc2k='), function () {
    encryptJsonFile();
    return base64_decode('RmlsZSBKU09OIHRlcmVua3JpcHNpLg==');
});
Route::get(base64_decode('ZGVrcmlwc2k='), function () {
    $lknsqias3124532429 = decryptJsonFile();
    return response()->json($lknsqias3124532429);
});
Route::get(base64_decode('L3NldHVw'), function () {
    $lvkmxxck3514781862 = File::get(base64_decode('dXVpZC50eHQ='));
    if ($lvkmxxck3514781862 == null || $lvkmxxck3514781862 == '') {
        $lvkmxxck3514781862 = uuidv4();
        File::put(base64_decode('dXVpZC50eHQ='), $lvkmxxck3514781862);
    }
    return view(base64_decode('c2V0dXA='), [base64_decode('dXVpZA==') => $lvkmxxck3514781862]);
});

Route::post(base64_decode('L3NldHVw'), function (Request $sdewmmty999788447) {
    $aqbfmrdp2545728356 = $sdewmmty999788447->except(base64_decode('X3Rva2Vu'));
    $asdzfofx2324736937 = $aqbfmrdp2545728356[base64_decode('bGljZW5zZV9rZXk=')];
    $yddidedx2564639436 = decryptJsonFile2($asdzfofx2324736937);
    if (!empty($yddidedx2564639436) && $yddidedx2564639436[0][base64_decode('dXVpZA==')] == File::get(base64_decode('dXVpZC50eHQ='))) {
        File::put(base_path(base64_decode('a2V5LnR4dA==')), $asdzfofx2324736937);
    }
    return redirect(base64_decode('Lw=='));
})->name(base64_decode('c2V0dXA='));

Route::get('/', ['as' => 'beranda', 'uses' => 'HomeController@home']);
Route::get('/user/login', ['as' => 'mainuser', 'uses' => 'MainController@redirectuser']);

Route::get('/admin/login', ['as' => 'main', 'uses' => 'MainController@redirect']);
Route::get('locale/{locale}', ['as' => 'change_locale', 'uses' => 'MainController@changeLocale']);

// Login
Route::get('login', ['as' => 'get_login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'post_login', 'uses' => 'Auth\LoginController@login']);
Route::post('login/aktivasi', ['as' => 'aktivasi', 'uses' => 'Auth\LoginController@aktivasi']);

// Register Member
Route::get('user/daftar', ['as' => 'get_register', 'uses' => 'HomeController@register']);
Route::resource('homes', 'HomeController', ['except' => ['show', 'edit', 'update']]);

// Login Member
Route::get('user/login', ['as' => 'get_login_user', 'uses' => 'Auth\LoginMemberController@showLoginForm']);
Route::post('user/login', ['as' => 'post_login_member', 'uses' => 'Auth\LoginMemberController@login']);

// Forgot Password
Route::get('member/password', ['as' => 'get_email_member', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestFormMember']);
Route::post('member/password', ['as' => 'post_email_member', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmailMember']);

// Forgot Password
Route::get('password/email', ['as' => 'get_email', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'post_email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

// Reset Password
Route::get('password/reset/{token}', ['as' => 'get_reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'post_reset', 'uses' => 'Auth\ResetPasswordController@reset']);

// Add to Queue
Route::get('queue', ['as' => 'add_to_queue', 'uses' => 'AddToQueueController@index']);
Route::get('queue/{id}', ['as' => 'add_to_queue1', 'uses' => 'AddToQueueController@index1']);
Route::post('queue', ['as' => 'post_add_to_queue', 'uses' => 'AddToQueueController@postDept']);
Route::post('guest-register', ['as' => 'guest_register', 'uses' => 'AddToQueueController@guestRegister']);

Route::get('get-content', ['as' => 'get_content', 'uses' => 'AddToQueueController@getContent']);

// Display
Route::get('display', ['as' => 'display', 'uses' => 'DisplayController@index']);
Route::get('display/1', ['as' => 'display_1', 'uses' => 'DisplayController@index1']);
Route::get('display/show/{id}', ['as' => 'display_show', 'uses' => 'DisplayController@template']);

Route::group(['middleware' => 'auth:members'], function () {
    Route::get('user/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);
    Route::post('user/profile', ['as' => 'edit_profile', 'uses' => 'HomeController@edit']);
    Route::post('logout/user', ['as' => 'logout_user', 'uses' => 'Auth\LoginMemberController@logout']);
    Route::post('user/antrian', ['as' => 'ambil_antrian_online', 'uses' => 'HomeController@postDept']);
    Route::post('antrian/saya', ['as' => 'antrian_saya_detail', 'uses' => 'HomeController@postDept1']);
    Route::get('user/antrian', ['as' => 'antrian_saya', 'uses' => 'HomeController@antriansaya']);
    Route::get('user/list', ['as' => 'listchat', 'uses' => 'HomeController@listchat']);
    Route::post('user/list', ['as' => 'postchannel', 'uses' => 'HomeController@postChannel']);
    Route::get('user/chat/{id}', ['as' => 'chat', 'uses' => 'HomeController@chat']);
    Route::post('user/chat/{id}', ['as' => 'sendchat', 'uses' => 'HomeController@sendMessage']);
    // Ratting

    Route::post('user/antrian/ratting', ['as' => 'sendratting', 'uses' => 'HomeController@sendRatting']);
});

// Authenticated
Route::group(['middleware' => 'auth:users'], function () {
    // Logout
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('apidocs', ['as' => 'apidocs', 'uses' => 'ApiDocsController@index']);
    Route::get('stafchat', ['as' => 'stafchathome', 'uses' => 'HomeController@stafChatHome']);
    Route::get('stafchat/{id}', ['as' => 'stafchat', 'uses' => 'HomeController@stafChat']);
    Route::post('stafchat/{id}', ['as' => 'sendchatstaf', 'uses' => 'HomeController@sendMessageStaf']);

    // Sales
    Route::resource('sales', 'SalesController');

    // Guest
    Route::resource('guest', 'GuestController');

    // Dashboard
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::post('dashboard/settings', ['as' => 'dashboard_store', 'uses' => 'DashboardController@store']);
    Route::post('dashboard/style', ['as' => 'dashboard_style', 'uses' => 'DashboardController@style']);
    Route::post('dashboard/styledisplay', ['as' => 'dashboard_style_display', 'uses' => 'DashboardController@styledisplay']);
    Route::post('dashboard', ['as' => 'post_calld', 'uses' => 'DashboardController@newCall']);
    Route::post('dashboard/recall', ['as' => 'post_recalld', 'uses' => 'DashboardController@recall']);
    Route::post('dashboard/dept/{department}', ['as' => 'post_deptd', 'uses' => 'DashboardController@postDept']);

    // Calls
    Route::get('calls', ['as' => 'calls', 'uses' => 'CallController@index']);
    Route::post('calls', ['as' => 'post_call', 'uses' => 'CallController@newCall']);
    Route::post('calls/recall', ['as' => 'post_recall', 'uses' => 'CallController@recall']);
    Route::post('calls/dept/{department}', ['as' => 'post_dept', 'uses' => 'CallController@postDept']);

    // Display
    // Route::get('masterdisplay', ['as' => 'masterdisplay', 'uses' => 'MasterDisplayController@index']);
    // Route::post('display', ['as' => 'post_call', 'uses' => 'CallController@newCall']);
    // Route::post('display/recall', ['as' => 'post_recall', 'uses' => 'CallController@recall']);
    // Route::post('display/dept/{department}', ['as' => 'post_dept', 'uses' => 'CallController@postDept']);

    // Testimoni
    Route::get('testimoni', ['as' => 'testimoni', 'uses' => 'TestimoniController@index']);
    Route::post('testimoni', ['as' => 'post_add_testimoni', 'uses' => 'TestimoniController@postDept']);
    Route::get('list/testimoni', ['as' => 'listtestimoni', 'uses' => 'TestimonilistController@index']);

    // Department
    Route::resource('departments', 'DepartmentController', ['except' => ['show']]);

    // Counter
    Route::resource('counters', 'CounterController', ['except' => ['show']]);

    // Template
    Route::resource('templates', 'TemplateController', ['except' => ['show']]);

    //Reports
    Route::group(['prefix' => 'reports', 'as' => 'reports::'], function () {
        // User Report
        Route::get('user', ['as' => 'user', 'uses' => 'UserReportController@index']);
        Route::get('user/{user}/{date}', ['as' => 'user_show', 'uses' => 'UserReportController@show']);

        // Queue list
        Route::get('queuelist/{date}', ['as' => 'queue_list', 'uses' => 'QueueListReportController@index']);

        // Monthly Report
        Route::get('monthly', ['as' => 'monthly', 'uses' => 'MonthlyReportController@index']);
        Route::get('monthly/{department}/{sdate}/{edate}', ['as' => 'monthly_show', 'uses' => 'MonthlyReportController@show']);

        Route::get('guest', ['as' => 'guest', 'uses' => 'GuestReportController@index']);

        // Statistical Report
        Route::get('statistical', ['as' => 'statistical', 'uses' => 'StatisticalReportController@index']);
        Route::get('statistical/{date}/{user}/{department}/{counter}', ['as' => 'statistical_show', 'uses' => 'StatisticalReportController@show']);

        // Missed
        Route::get('missed-overtime', ['as' => 'missed', 'uses' => 'MissedOvertimeReportController@index']);
        Route::get('missed-overtime/{date}/{user}/{counter}/{type}', ['as' => 'missed_show', 'uses' => 'MissedOvertimeReportController@show']);
    });

    // Users
    Route::get('users/{user}/password', ['as' => 'get_user_password', 'uses' => 'UserController@getPassword']);
    Route::post('users/{user}/password', ['as' => 'post_user_password', 'uses' => 'UserController@postPassword']);
    Route::resource('users', 'UserController', ['except' => ['show', 'edit', 'update']]);


    // Members
    Route::get('members/{member}/password', ['as' => 'get_member_password', 'uses' => 'MemberController@getPassword']);
    Route::post('members/{member}/password', ['as' => 'post_member_password', 'uses' => 'MemberController@postPassword']);
    Route::resource('members', 'MemberController', ['except' => ['show', 'edit', 'update']]);

    // Settings
    Route::get('setting', ['as' => 'settings', 'uses' => 'SettingsController@index']);
    Route::post('setting', ['as' => 'post_settings', 'uses' => 'SettingsController@update']);
    Route::post('setting/company', ['as' => 'post_company', 'uses' => 'SettingsController@companyUpdate']);
    Route::post('setting/overmissed', ['as' => 'post_over_missed', 'uses' => 'SettingsController@overmissedUpdate']);
    Route::post('setting/locale', ['as' => 'post_locale', 'uses' => 'SettingsController@localeUpdate']);
    Route::post('setting/video', ['as' => 'post_video', 'uses' => 'SettingsController@videoUpdate']);
    Route::post('setting/gambar', ['as' => 'post_gambar', 'uses' => 'SettingsController@gambarUpdate']);
    Route::post('setting/hapbackground', ['as' => 'hapus_background', 'uses' => 'SettingsController@HapusBackground']);
    Route::post('setting/hapbanner', ['as' => 'hapus_banner', 'uses' => 'SettingsController@HapusBanner']);
    Route::post('setting/hapvideo', ['as' => 'hapus_video', 'uses' => 'SettingsController@HapusVideo']);
    Route::post('setting/hapvideo1', ['as' => 'hapus_video1', 'uses' => 'SettingsController@HapusVideo1']);
    Route::post('setting/hapvideo2', ['as' => 'hapus_video2', 'uses' => 'SettingsController@HapusVideo2']);
    Route::post('setting/hapvideo3', ['as' => 'hapus_video3', 'uses' => 'SettingsController@HapusVideo3']);
    Route::post('setting/hapvideo4', ['as' => 'hapus_video4', 'uses' => 'SettingsController@HapusVideo4']);
    Route::post('setting/reset', ['as' => 'reset', 'uses' => 'SettingsController@resetData']);
    Route::post('setting/printer', ['as' => 'post_printer', 'uses' => 'SettingsController@printerUpdate']);

    // mobiles
    Route::get('mobiles', ['as' => 'mobiles', 'uses' => 'MobilesController@index']);
    Route::post('mobiles', ['as' => 'post_mobiles', 'uses' => 'MobilesController@update']);
});
