<?php

use App\Class\User;
use App\Class\Post;
use App\Class\Client;

$user = new User('asd', 'asd', 'asd');

$client = new Client('http://127.0.0.1:8000');

$client->uloadFile($user);
