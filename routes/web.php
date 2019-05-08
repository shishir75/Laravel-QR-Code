<?php

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
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});



// simple QR code
Route::get('qr-code', function () {
    return QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)->margin(1)
        ->size(150)->generate('Welcome to Laravel.com!');
});


Route::get('qr-img', function () {
    $pngImage = QrCode::format('png')->merge('laravel.png', 0.3, true)
        ->size(300)->errorCorrection('H')->margin(1)
        ->generate('Welcome to Laravel.com!');

    return response($pngImage)->header('Content-type','image/png');
});

// qr email
Route::get('email', function (){
    return QrCode::size(300)->email('sapnesh@kerneldev.com', 'Thank you for the QR code tutorial.', 'This was awesome!.');
});

// qr phone number
Route::get('phone', function (){
    return QrCode::size(300)->phoneNumber('01723795085');
});

// qr sms
Route::get('sms', function (){
    return QrCode::size(300)->SMS('+880-1723-795085', 'This is the body of the message');
});

// qr geo location
Route::get('geo', function (){
    return QrCode::size(300)->geo(27.8788027, 95.2644429);
});