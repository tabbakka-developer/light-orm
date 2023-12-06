<?php

require 'vendor/autoload.php';

require 'User.php';
require 'UserMapper.php';
require 'UserRepository.php';

$userRepository = new UserRepository();

$user = $userRepository->findOneById(12);

var_dump($user);