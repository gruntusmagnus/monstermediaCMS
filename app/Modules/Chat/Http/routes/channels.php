<?php

use App\Authenticable;

Broadcast::channel('App.Chat.Active', function (Authenticable $user) {
    // todo proverit, ze to opravdu funguje
    $isEmployee = $user->authenticable instanceof \App\Employee;

    return !$isEmployee;
});

Broadcast::channel('App.Chat.{id}', function (Authenticable $user, $id) {
    $isEmployee = $user->authenticable instanceof \App\Employee;

    if ($isEmployee) {
        return true;
    }

    $chat = \App\Modules\Chat\Chat::find($id);

    return true;

    return ($chat->customer_id == $user->authenticable->id);
});