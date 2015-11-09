<?php

use App\Models\User;

class UsersSeed {

    function run()
    {
        User::truncate();
        foreach(range(1, 30) AS $n) {
            $User = new User;
            $User->id = $n;
            $User->email = 'user'.$n.'@test.com';
            $User->password = '123456';
            $User->save();
        }
    }
}