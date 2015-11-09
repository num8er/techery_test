<?php
/**
 * Created by PhpStorm.
 * User: num8er
 * Date: 11/9/15
 * Time: 12:29 PM
 */

namespace App\Controllers;

use App\Models\Friend;

class FriendsController
{
    public function __construct()
    {
        header('Content-type: application/json; charset=utf-8');
    }

    public function get()
    {
        $user_id = isset($_GET['user_id'])? (int)$_GET['user_id'] : 0;
        if($user_id == 0) {
            echo json_encode([]);
            return;
        }

        $Friends = Friend::whereUserId($user_id)->get();
        echo json_encode($Friends->toArray());
    }

    public function delete($friend_id)
    {
        $user_id = $this->request->get('user_id');
        if(Friend::whereIn('user_id', [$user_id, $friend_id])->whereIn('friend_id', [$user_id, $friend_id])->delete()) {
            echo json_encode(['success' => true]);
            return;
        }

        echo json_encode(['success' => false]);
    }
}