<?php

use App\Http\Controllers\Admin\Auth\AdminAvatarController;
use App\Http\Controllers\Admin\Functions\AdminNoticeController;
use App\Http\Controllers\Admin\Functions\HouseController as AdminHouseController;
use App\Http\Controllers\Admin\Functions\NewsController;
use App\Http\Controllers\Admin\Functions\ReplyController as AdminReplyController;
use App\Http\Controllers\Admin\Functions\UserController;
use App\Http\Controllers\Admin\Functions\MessageController as AdminMessageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\Auth\UserAvatarController;
use App\Http\Controllers\User\Functions\UserNoticeController;
use App\Http\Controllers\User\Manage\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\Auth\ProfileController;
use App\Http\Controllers\User\Functions\HouseImageController;
use App\Http\Controllers\User\NewsController as UserNewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin/auth/login');
});

Route::prefix('admin')->group(function () {
    Route::match (['get', 'post'], '/login', [AdminLoginController::class, 'login'])->name('admin.login');

    Route::get('/register', [AdminRegisterController::class, 'register'])->name('admin.register');

    Route::post('/register', [AdminRegisterController::class, 'store'])->name('admin.register');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

        Route::put('/block/{id}', [UserController::class, 'block'])->name('block');
        Route::put('/unlock{id}', [UserController::class, 'unblock'])->name('unblock');

        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::match (['get', 'put'], '/about', [AdminLoginController::class, 'edit_profile'])->name('admin.edit_profile');

        Route::get('/news', [NewsController::class, 'index'])->name('admin.news');
        Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
        Route::post('/news/create', [NewsController::class, 'store'])->name('admin.news.create');

        Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
        Route::post('/news/edit/{id}', [NewsController::class, 'update'])->name('admin.news.edit');

        Route::delete('/news/delete/{id}', [NewsController::class, 'destroy'])->name('admin.news.delete');
        Route::get('/news/show/{id}', [NewsController::class, 'show'])->name('admin.news.show');

        Route::get('/messages', [AdminMessageController::class, 'index'])->name('admin.message.index');
        Route::post('/message/slove/{id}', [AdminMessageController::class, 'solve'])->name('admin.message.slove');
        Route::get('/message/show/{id}', [AdminMessageController::class, 'show'])->name('admin.message.show');
        Route::get('/message/count', [AdminMessageController::class, 'count'])->name('admin.message.count');

        Route::post('/reply/store', [AdminReplyController::class, 'store'])->name('admin.reply.store');

        Route::get('/houses', [AdminHouseController::class, 'index'])->name('admin.house.index');
        Route::post('/house/approve/{id}', [AdminHouseController::class, 'update'])->name('admin.house.approve');

        Route::get('/notices', [AdminNoticeController::class, 'index'])->name('admin.notices.index');
        Route::get('/notice/store/{request}', [AdminNoticeController::class, 'store'])->name('admin.notices.store');
        Route::get('/notice/count', [AdminNoticeController::class, 'count'])->name('admin.notices.count');
        Route::get('/notice/update/{id}', [AdminNoticeController::class, 'update'])->name('admin.notices.update');
    }
    );
});

Route::prefix('user')->group(function () {
    Route::match (['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    Route::get('/bookmak/create/{id}', [BookmarkController::class, 'create'])->name("bookmark.create");

    Route::prefix('post')->group(function(){

        Route::get('/', [PostController::class, 'main'])->name('main');
        Route::get('news', [UserNewsController::class, 'newsList'])->name('newsList');
        Route::get('news/{id}', [UserNewsController::class, 'newsDetail'])->name('newsDetail');
        Route::get('news-search', [UserNewsController::class, 'newsSearch'])->name('newsSearch');
        Route::match(['get', 'post'],'sale-search/', [PostController::class, 'saleSearch'])->name('saleSearch');
        Route::get('rent-search/', [PostController::class, 'rentSearch'])->name('rentSearch');
        Route::get('search/', [PostController::class, 'search'])->name('postSearch');


    });

    Route::match (['get', 'post'],'/manage/post/detail/{id}', [PostController::class, 'detail'])->name('manage.post.detail');

    Route::middleware('auth')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::match (['get', 'put'], '/about', [LoginController::class, 'edit_profile'])->name('edit_profile');

        Route::get('/message', [MessageController::class, 'index'])->name('message');

        Route::delete('/message/delete/{id}', [MessageController::class, 'destroy'])->name('delete_message');
        Route::get('/message/create', [MessageController::class, 'create'])->name('user.message.create');
        Route::get('/message_detail/{id}', [MessageController::class, 'detail'])->name('mess_detail');
        Route::get('/message/show/{id}', [MessageController::class, 'show'])->name('user.message.show');
        Route::post('/message/store', [MessageController::class, 'store'])->name('user.message.store');

        Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark');
        Route::delete('/bookmark/delete/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.delete');

        Route::get('/manage/post', [PostController::class, 'index'])->name('manage.post');
        Route::get('/manage/post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/manage/post/create', [PostController::class, 'store'])->name('post.create');
        Route::delete('/manage/post/delete/{id}', [PostController::class, 'destroy'])->name('manage.post.delete');
        Route::post('/manage/post/edit/{id}', [PostController::class, 'update'])->name('manage.post.edit');
        Route::get('/manage/post/edit/{id}', [PostController::class, 'edit'])->name('manage.post.edit');

        Route::match (['get', 'put'], '/manage/profile', [ProfileController::class, 'edit'])->name('manage.profile');
        // Route::post('/manage/profile/{id}',[ProfileController::class,'update']) ->name('manage.profile');
        // Route::get('/manage/profile', [ProfileController::class, 'edit'])->name('manage.profile');
        Route::delete('/manage/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('manage.profile.delete');

        Route::get('/notices', [UserNoticeController::class, 'index'])->name('user.notices.index');
        Route::get('/notice/store/{request}', [UserNoticeController::class, 'store'])->name('user.notices.store');
        Route::get('/notice/count', [UserNoticeController::class, 'count'])->name('user.notices.count');
        Route::get('/notice/update/{id}', [UserNoticeController::class, 'update'])->name('user.notices.update');
    }
    );

});



Route::get('image/{id}', [ImageController::class, 'destroy'])->name('image.destroy');
Route::get('admin/avatar/{id}', [AdminAvatarController::class, 'destroy'])->name('admin.avatar.destroy');
Route::get('user/avatar/{id}', [UserAvatarController::class, 'destroy'])->name('user.avatar.destroy');
Route::get('house/image/delete/{id}', [HouseImageController::class, 'destroy'])->name('user.house.images.delete');
