<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/classroom', [ClassroomController::class, 'index'])->name('classroom.index');
// Route::get('/classroom/create', [ClassroomController::class, 'create'])->name('classroom.create');
// Route::post('/classroom/store', [ClassroomController::class, 'store'])->name('classroom.store');
// Route::get('/classroom/edit/{id}', [ClassroomController::class, 'edit'])->name('classroom.edit');
// Route::put('/classroom/update/{id}', [ClassroomController::class, 'update'])->name('classroom.update');
// Route::delete('/classroom/delete/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');

Route::group(['prefix'=>'/auth', 'as'=>'auth.'], function() {
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::get('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/login',[AuthController::class, 'checkLogin'])->name('checklogin');
    Route::post('/register',[AuthController::class, 'checkRegister'])->name('checkRegister');
    Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
});


// Route::group(['middleware'=>'auth.checklogin','prefix'=> '/classroom', 'as'=>'classroom.'], function() {
//     Route::get('', [ClassroomController::class, 'index'])->name('index');
//     Route::get('/create', [ClassroomController::class, 'create'])->name('create');
//     Route::post('/store', [ClassroomController::class, 'store'])->name('store');
//     Route::get('/edit/{id}', [ClassroomController::class, 'edit'])->name('edit');
//     Route::put('/update/{id}', [ClassroomController::class, 'update'])->name('update');
//     Route::delete('/delete/{id}', [ClassroomController::class, 'destroy'])->name('destroy');
// });
Route::group(['middleware'=>['localization', 'auth'],'prefix'=> '/classroom', 'as'=>'classroom.'], function() {
    Route::get('', [ClassroomController::class, 'index'])->name('index');
    Route::get('/create', [ClassroomController::class, 'create'])->name('create');
    Route::post('/store', [ClassroomController::class, 'store'])->name('store');
    Route::get('/show/{id}', [ClassroomController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [ClassroomController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ClassroomController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ClassroomController::class, 'destroy'])->name('destroy');
});

// Route::get('/test', function() {
//     return response('hello world',200)->header('Content-Type', 'text/plain');
// });
Route::fallback(function () {
    return view('404-page.404_page');
});
Route::get('/test', [TestController::class, 'index'])->name('test');
Route::get('/test-session', [TestController::class, 'testSession'])->name('test-session')->block($lockSeconds = 1, $waitSeconds = 1);
// Route::resource('classroom', ClassroomController::class);
Route::post('/change-lang', function(Request $request){
    App::setLocale($request->lang);
    session()->put('lang', $request->lang);
    return redirect(route('classroom.index'));
})->name('change_lang');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::post('/process-order', [TestController::class, 'processOrder'])->name('processOrder');
Route::post('/store-img', [TestController::class, 'storeImg'])->name('storeImg');

Route::resource('student', StudentController::class);
Route::get('/student/get-soft-delete', [StudentController::class, 'getSoftDelete'])->name('student.getSoftDelete');