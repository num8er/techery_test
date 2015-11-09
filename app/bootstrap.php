<?php

require '../vendor/autoload.php';

$app = new \RKA\Slim();

$app->get('/', function () {
    echo "Welcome to Techery PHP Test API";
});

$app->get('/friends', 'App\Controllers\FriendsController:get');  // list of friends
$app->delete('/friends/:friend_id', 'App\Controllers\FriendsController:delete');  // unfriend

$app->get('/friend/requests', 'App\Controllers\FriendRequestsController:get'); // list requests
$app->post('/friend/requests', 'App\Controllers\FriendRequestsController:create'); // send request
$app->put('/friend/requests/:id', 'App\Controllers\FriendRequestsController:approve'); // approve request
$app->delete('/friend/requests/:id', 'App\Controllers\FriendRequestsController:decline'); // decline request

$app->run();
