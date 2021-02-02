<?php
session_start();
session_destroy();
require_once __DIR__ . '/incs/requirements.func.inc.php';

DB::reset();
$migrationLockFile = __DIR__ . "/./migration.lock";
if (file_exists($migrationLockFile)) {
    unlink($migrationLockFile);
}
require_once __DIR__ . "/./config.php";
