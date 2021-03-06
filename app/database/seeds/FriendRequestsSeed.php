<?php

use App\Models\FriendRequest;

class FriendRequestsSeed {

    function run()
    {
        FriendRequest::truncate();

        $Request = new FriendRequest();
        $Request->sender_id = 11;
        $Request->recipient_id = 1;
        $Request->save();

        $Request = new FriendRequest();
        $Request->sender_id = 12;
        $Request->recipient_id = 2;
        $Request->save();
    }
}