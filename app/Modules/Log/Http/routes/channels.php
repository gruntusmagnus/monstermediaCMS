<?php

use App\Authenticable;

Broadcast::channel('App.Log', function (Authenticable $user) {
    // todo toto doresit, hazi 403
    return true;

    $isEmployee = $user->authenticable instanceof \App\Employee;

    return !$isEmployee;
});
