<?php

use app\MigrationManager;

require_once 'App/MigrationManager.php';

$manager = new MigrationManager();
$manager->migrate();

echo "Migrations executed successfully.\n";
