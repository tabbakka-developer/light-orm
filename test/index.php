<?php

require 'vendor/autoload.php';

require 'UserRepository.php';
require 'UserMapper.php';
require 'User.php';

$userRepository = new UserRepository();

//$user = $userRepository->findOneById(12);

$user = $userRepository->create([
    'email' => 'vladpopov90@gmail.com',
    'password' => password_hash('qwerty764', null),
    'usename' => 'chlen666cm'
]);

var_dump($user);