<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SiteMapController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BreakingNewsController;

Auth::routes(['register' => false,'verify' => false]);


Route::redirect('/admin', '/admin/dashboard')->middleware('backend_permission');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', [LoginController::class,'showLoginForm']);
});
Route::get('sitemap.xml',[SiteMapController::class,'index'])->name('sitemap');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'backend_permission'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('delete-old-post', [DashboardController::class,'deleteOldPost'])->name('delete-old-post');
    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::put('profile/update/{profile}', [ProfileController::class,'update'])->name('profile.update');
    Route::put('profile/change', [ProfileController::class,'change'])->name('profile.change');
    Route::resource('adminusers', AdminUserController::class);
    Route::get('get-adminusers', [AdminUserController::class,'getAdminUsers'])->name('adminusers.get-adminusers');
    Route::resource('role', RoleController::class);
    Route::post('role/save-permission/{id}', [RoleController::class,'savePermission'])->name('role.save-permission');
    //Category
    Route::resource('category', CategoryController::class);
    Route::get('get-category', [CategoryController::class,'getCategory'])->name('category.get-category');
     //Tag
     Route::resource('tag', TagController::class);
     Route::get('get-tag', [TagController::class,'getTag'])->name('tag.get-tag');
    //post
    Route::resource('post', PostController::class);
    Route::get('get-post', [PostController::class,'getpost'])->name('post.get-post');
    //post

    //blog
    Route::resource('blog', BlogController::class);
    Route::get('get-blog', [BlogController::class,'getblog'])->name('blog.get-blog');
    //blog

    Route::resource('breakingnews', BreakingNewsController::class);
    Route::get('get-breakingnews', [BreakingNewsController::class,'getBreakingNews'])->name('breakingnews.get-breakingnews');
    //language
    Route::resource('language', LanguageController::class);
    Route::get('get-language', [LanguageController::class,'getLanguage'])->name('language.get-language');
    Route::get('language/change-status/{id}/{status}', [LanguageController::class,'changeStatus'])->name('language.change-status');
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('sitemap.xml',[SiteMapController::class,'index'])->name('sitemap');
        Route::get('/', [SettingController::class,'index'])->name('index');
        Route::post('/', [SettingController::class,'siteSettingUpdate'])->name('site-update');
        Route::get('sms', [SettingController::class,'smsSetting'])->name('sms');
        Route::post('sms', [SettingController::class,'smsSettingUpdate'])->name('sms-update');
        Route::get('email', [SettingController::class,'emailSetting'])->name('email');
        Route::post('email', [SettingController::class,'emailSettingUpdate'])->name('email-update');
        Route::get('notification', [SettingController::class,'notificationSetting'])->name('notification');
        Route::post('notification', [SettingController::class,'notificationSettingUpdate'])->name('notification-update');
        Route::get('emailtemplate', [SettingController::class,'emailTemplateSetting'])->name('email-template');
        Route::post('emailtemplate', [SettingController::class,'mailTemplateSettingUpdate'])->name('email-template-update');
        Route::get('homepage', [SettingController::class,'homepageSetting'])->name('homepage');
        Route::post('homepage', [SettingController::class,'homepageSettingUpdate'])->name('homepage-update');
        Route::get('social', [SettingController::class,'socialSetting'])->name('social');
        Route::post('social', [SettingController::class,'socialSettingUpdate'])->name('social-update');
        Route::get('editor', [SettingController::class,'editorSetting'])->name('editor');
        Route::post('editor', [SettingController::class,'editorSettingUpdate'])->name('editor-update');
        Route::get('meta', [SettingController::class,'metaSetting'])->name('meta');
        Route::post('meta', [SettingController::class,'metaSettingUpdate'])->name('meta-update');
    });
});



Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/', [HomeController::class,'index'])->name('/');
Route::view('/privacy-policy', 'frontend.privacyPolicy')->name('privacyPolicy');
Route::view('/terms-condition', 'frontend.termsCondition')->name('termsCondition');
Route::view('/contact', 'frontend.contact')->name('contact');
Route::post('/search', [HomeController::class,'search'])->name('search');
Route::get('blogs/', [HomeController::class,'all_blogs'])->name('all-blogs');
Route::get('blog/{slug}', [HomeController::class,'blog_details'])->name('blog-details');
Route::get('category/{slug}', [HomeController::class,'blog_by_category'])->name('blog-by-category');
Route::get('posts/', [HomeController::class,'all_posts'])->name('all-posts');
Route::get('post/{slug}', [HomeController::class,'post_details'])->name('post-details');
Route::get('posts/category/{slug}', [HomeController::class,'post_by_category'])->name('post-by-category');
Route::get('govt-jobs', [HomeController::class,'govtJobs'])->name('govt-jobs');
Route::get('internships', [HomeController::class,'internships'])->name('internships');
Route::get('projects', [HomeController::class,'projects'])->name('projects');
Route::get('remote-jobs', [HomeController::class,'remoteJobs'])->name('remote-jobs');


