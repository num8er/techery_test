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

    public function create()
    {
        $sender_id = isset($_GET['sender_id']) ? (int)$_GET['sender_id'] : 0;
        $recipient_id = isset($_GET['recipient_id']) ? (int)$_GET['recipient_id'] : 0;
        if ($sender_id == 0 OR $recipient_id == 0) {
            echo json_encode(['success' => false]);
            return;
        }

        $Request = new FriendRequest();
        $Request->sender_id = $sender_id;
        $Request->recipient_id = $recipient_id;
        $result = $Request->save();

        echo json_encode(['success' => (bool)$result]);
    }

    public function get()
    {
        $user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
        if ($user_id == 0) {
            echo json_encode([]);
            return;
        }

        $Requests = FriendRequest::with(['sender', 'recipient'])->whereRecipientId($user_id)->get();
        echo json_encode($Requests->toArray());
    }

    public function approve($id)
    {
        $Request = FriendRequest::find($id);
        if(!$Request) {
            echo json_encode(['success' => false]);
            return;
        }

        $Friend = new Friend();
        $Friend->friend_id = $Request->sender_id;
        $Friend->user_id = $Request->recipient_id;
        $Friend->save();

        $Friend = new Friend();
        $Friend->user_id = $Request->sender_id;
        $Friend->friend_id = $Request->recipient_id;
        $Friend->save();

        $result = $Request->delete();

        echo json_encode(['success' => (bool)$result]);
    }

    public function decline($id)
    {
        $Request = FriendRequest::find($id);
        if(!$Request) {
            echo json_encode(['success' => false]);
            return;
        }

        $result = $Request->delete();

        echo json_encode(['success' => (bool)$result]);
    }
}