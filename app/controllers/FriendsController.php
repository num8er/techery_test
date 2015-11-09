<?php
/**
 * Created by PhpStorm.
 * User: num8er
 * Date: 11/9/15
 * Time: 12:29 PM
 */

namespace App\Controllers;

use Illuminate\Database\Capsule\Manager as DB;
use App\Models\Friend;
use App\Models\User;

class FriendsController
{
    public function __construct()
    {
        header('Content-type: application/json; charset=utf-8');
    }

    public function get()
    {
        $user_id = isset($_GET['user_id'])? (int)$_GET['user_id'] : 0;
        $depth = isset($_GET['depth'])? (int)$_GET['depth'] : 1;

        if($user_id == 0 OR $depth == 0) {
            echo json_encode([]);
            return;
        }

        $fields = [
            'level1.user_id AS user',
            'level1.friend_id AS friend'
        ];
        $joins = [];

        if($depth>1) {
            foreach (range(2, $depth) AS $l) {
                $fields[] = 'level'.$l.'.friend_id AS mutual'.($l-1);
                $joins[] = 'LEFT JOIN friends level'.$l.' ON (level'.($l-1).'.`friend_id` = level'.$l.'.`user_id` AND level'.$l.'.`friend_id` != level'.($l-1).'.`user_id`)';
            }
        }

        $query =  'SELECT ';
        $query .= implode(',', $fields);
        $query .= ' FROM friends level1 ';
        $query .= implode(' ', $joins);
        $query .= ' WHERE level1.user_id = '.$user_id;

        $user_ids = [];
        $records = json_decode(json_encode(DB::select($query)), true);
        foreach($records AS $r => $record) {
            foreach($record AS $key => $id) {
                $id = (int)$id;
                if(!($id > 0)) {
                    unset($records[$r][$key]);
                    continue;
                }
                if(in_array($id, $user_ids)) continue;
                $user_ids[] = $id;
            }
        }

        $Users = User::whereIn('id', $user_ids)->get();
        $users = [];
        foreach($Users AS $User) {
            $users[$User->id] = $User->toArray();
        }

        foreach($records AS $r => $record) {
            foreach ($record AS $key => $id) {
                $id = (int)$id;
                if(!($id > 0)) continue;
                $records[$r][$key] = $users[$id];
            }
        }

        echo json_encode($records);
    }

    public function delete($friend_id)
    {
        $user_id = $this->request->get('user_id');
        $result = Friend::whereIn('user_id', [$user_id, $friend_id])->whereIn('friend_id', [$user_id, $friend_id])->delete();

        echo json_encode(['success' => (bool)$result]);
    }
}