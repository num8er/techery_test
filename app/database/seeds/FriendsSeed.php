<?php

use App\Models\Friend;

class FriendsSeed {

    function run()
    {
        Friend::truncate();

        $Friend = new Friend();
        $Friend->user_id = 1;
        $Friend->friend_id = 2;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 2;
        $Friend->friend_id= 1;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 1;
        $Friend->friend_id = 3;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 3;
        $Friend->friend_id= 1;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 1;
        $Friend->friend_id= 4;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 4;
        $Friend->friend_id= 1;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 2;
        $Friend->friend_id= 3;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 3;
        $Friend->friend_id= 2;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 3;
        $Friend->friend_id= 4;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = 4;
        $Friend->friend_id= 3;
        $Friend->save();
    }
}