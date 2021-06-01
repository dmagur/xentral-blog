#!/usr/bin/env php
<?php

set_time_limit(0);
require dirname(__DIR__).'/vendor/autoload.php';

use Blog\Entity\User;
use Blog\Repository\UserRepository;

if (count($argv) < 5) {
    print "Not enough parameters. Command usage: add_user.php _email_ _password_ _firstName_ _lastName_\n";
    exit();
}

$email = $argv[1];
$password = $argv[2];
$firstName = $argv[3];
$lastName = $argv[4];

$user = new User();
$user->setEmail($email);
$user->setPassword(password_hash($password, PASSWORD_BCRYPT));
$user->setFirstName($firstName);
$user->setLastName($lastName);

$dbconfig = new \Blog\Core\Config('database');
$dbconnection = new \Blog\Core\MySqlDatabase($dbconfig);
$userRepository = new UserRepository($dbconnection);

try {
    $userRepository->insert($user);
    print "User created successfully\n";
} catch (\Throwable $exception) {
    print $exception->getMessage() . "\n";
}

