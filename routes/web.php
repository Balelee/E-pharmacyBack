<?php

use App\Events\CommandeStatut;
use App\Events\MessageSent;
use App\Http\Resources\OrderPharmacyResource;
use App\Models\OrderPharmacy;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\New_;
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

Route::get('/test-order/{orderId}', function ($orderId) {
    $event = new CommandeStatut($orderId);

    return response()->json($event->broadcastWith());
});

