<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\StudentResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// AUTH
Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'checkLogin'])->name('checklogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'checkRegister'])->name('checkRegister');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
//VERIFY EMAIL
Route::middleware(['auth'])->controller(AuthController::class)->name('verification.')->group( function () {

    Route::get('/email/verify', 'show')->name('notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verify')->middleware(['signed']);
    Route::post('/email/resend', 'resend')->name('resend')->middleware('throttle:6,1');
});

//CLASSROOM
Route::middleware(['localization', 'auth'])->controller(ClassroomController::class)->prefix('/classroom')->name('classroom.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/show/{classroom}', 'show')->name('show');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');

});
Route::post('/insert-update-many-classrooms', [TestController::class, 'insertOrUpdateManyClassrooms'])->name('insertOrUpdateManyClassrooms');

Route::post('/change-lang', function (Request $request) {
    App::setLocale($request->lang);
    session()->put('lang', $request->lang);
    return redirect(route('classroom.index'));
})->name('change_lang');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/process-order', [TestController::class, 'processOrder'])->name('processOrder');
Route::post('/store-img', [TestController::class, 'storeImg'])->name('storeImg');

Route::resource('student', StudentController::class);
Route::get('/student/get-soft-delete', [StudentController::class, 'getSoftDelete'])->name('student.getSoftDelete');

// social
Route::get('login/{social}', [SocialAuthController::class, 'redirectToProvider'])->name('login.redirectToProvider');
Route::get('login/{social}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('login.handleProviderCallback');

// API RESOURCE
Route::get('/classroom/json', function () {
    return ClassroomResource::collection(Classroom::paginate(10));
});
Route::get('/students/json', function () {
    return StudentResource::collection(Student::all()->keyBy->id);
});

Route::get('/send-promotion', [TestController::class, 'sendMailPromotion'])->name('sendPromotion');

Route::get('/chunk-data', [TestController::class, 'chunkD\ata']);

Route::apiResource('photos', PhotoController::class);

Route::get('/send-noti', [TestController::class, 'sendNotification'])->name('sendNotification');

// TEST
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/test-session', [TestController::class, 'testSession'])->name('test-session')->block($lockSeconds = 1, $waitSeconds = 1);

// NOTIFICATION
Route::get('/read-noti/{id}', [TestController::class, 'readNotification'])->name('readNotification');
Route::get('/delete-noti/{id}', [TestController::class, 'deleteNotification'])->name('deleteNotification');

// PUSHER
Route::get('/chat', [PusherController::class, 'index'])->name('chat');
Route::post('/chat/broadcast', [PusherController::class, 'broadcast'])->name('broadcast');
Route::post('/chat/receive', [PusherController::class, 'receive'])->name('receive');


Route::get('/test-pusher', [TestController::class, 'testPusher'])->name('testPusher');  

Route::get('/', function () {
    return view('welcome');
});
// FALLBACK
Route::fallback(function () {
    return view('404-page.404_page');
});
