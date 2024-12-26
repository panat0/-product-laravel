<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
/*
การทำงาน:
เรนเดอร์หน้า Welcome โดยใช้ Inertia.js
ส่งข้อมูลต่าง ๆ ไปยังหน้า Welcome เช่น:
canLogin: ตรวจสอบว่ามีเส้นทางล็อกอินหรือไม่ (Route::has('login'))
canRegister: ตรวจสอบว่ามีเส้นทางลงทะเบียนหรือไม่ (Route::has('register'))
laravelVersion: เวอร์ชันของ Laravel
phpVersion: เวอร์ชันของ PHP ที่ใช้งาน
*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
    //กำหนดเส้นทางของการทำงาน chirps
    /*
    เส้นทาง /chirps (GET)
    เรียกใช้เมธอด index ใน ChirpController
    ใช้สำหรับแสดงรายการ Chirps ทั้งหมด
    Route Name: chirps.index

    เส้นทาง /chirps (POST)
    เรียกใช้เมธอด store ใน ChirpController
    ใช้สำหรับบันทึกข้อความที่ผู้ใช้ส่งจากฟอร์ม
    Route Name: chirps.store
    */

    //Route::get('/greeting', function () {
    //    return 'Hello World';
    //});

Route::get('/user', [UserController::class, 'index']);

Route::get('/user/{id}', function (string $id){
    return 'User'.$id;
});

Route::get('/products', [ProductController::class, 'index']) //ใช้กำหนดเส้นทาง get ไปที่ product และเรียกใช้งานเมธอด
    ->name('products.index') //ใช้กำหนดชื่อ
    ->middleware(['auth', 'verified']); //ตรวจสอบ user login

Route::get('/products/{id}', [ProductController::class, 'show']) //ใช้กดหนดเส้นทาง product ไป show ผ่าน id ใน db
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
