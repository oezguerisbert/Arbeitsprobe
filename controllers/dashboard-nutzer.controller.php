<?php
$page = $_GET['p'] ?? 1;

$users = UserRepository::findAll($page);
var_dump($users);