<?php
/**
 * Created by PhpStorm.
 * User: num8er
 * Date: 11/9/15
 * Time: 12:29 PM
 */

namespace App\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;

class FriendRequestsController
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

        $Requests = FriendRequest::whereRecipientId($user_id)->get();
        echo json_encode($Requests->toArray());
    }

}