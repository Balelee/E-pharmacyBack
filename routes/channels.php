<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('chat', function ($message) {
    return true;
});

Broadcast::channel('pharmacy.{id}', function ($user, $id) {
    // Autorise uniquement si l'utilisateur appartient à la pharmacie demandée
    return (int) $user->pharmacie->id === (int) $id;
});
