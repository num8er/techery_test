Нужно реализовать простое REST API которое позволяет сделать следующие вещи:

- добавить пользователя в друзья (отправить запрос)  => POST /friend/requests
- просмотреть список запросов на добавление в друзья => GET /friend/requests
- подтвердить запрос на добавление в друзья          => PUT /friend/requests/:id/approve
- отклонить запрос на добавления в друзья            => PUT /friend/requests/:id/decline
- просмотреть список своих друзей                    => GET /friends?user_id=:user_id
- просмотреть список всех друзей своих друзей на N-уровней вложенности  => GET /friends?user_id=:user_id&depth=:depth

Выбор технологий - фреймворков, библиотек, БД  и т.п. за тобой. 
Использование TDD приветствуется. Ограничение по БД - можно использовать любую NoSQL БД
Реализация должна обеспечить хорошую производительность при выборке друзей друзей друзей ... и т.д до N уровня вложенности

Результат выполнения задания должен быть представлен в виде github репозитория.


Requirements:

- install packages via: composer install
- do migrate: php cli.php migrate --seed


$app->get('/friends', 'App\Controllers\FriendsController:get');  // list of friends
$app->delete('/friends/:friend_id', 'App\Controllers\FriendsController:delete');  // unfriend

$app->get('/friend/requests', 'App\Controllers\FriendRequestsController:get'); // list requests
$app->post('/friend/requests', 'App\Controllers\FriendRequestsController:create'); // send request
$app->put('/friend/requests/:id/approve', 'App\Controllers\FriendRequestsController:approve'); // approve request
$app->put('/friend/requests/:id/decline', 'App\Controllers\FriendRequestsController:decline'); // decline request
$app->delete('/friend/requests/:id', 'App\Controllers\FriendRequestsController:delete'); // cancel request