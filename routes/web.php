<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Event\SentMessageEvent;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-event', function () {
    broadcast(new MessageSent("Hello tout le monde depuis laravel"));
    return "Evénement envoyé";
});
