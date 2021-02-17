<?php
session_start();
session_destroy();
require_once __DIR__ . '/incs/requirements.func.inc.php';
$migrationLockFile = __DIR__ . "/./migration.lock";
if (file_exists($migrationLockFile)) {
    unlink($migrationLockFile);
}
$resetResult = DB::reset();

if(isset($resetResult['error'])){
    die($resetResult['error']);
}
require_once __DIR__ . "/./config.php";
