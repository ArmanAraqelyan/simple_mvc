<?php

require_once '../autoload.php';

use App\Controllers\FormController;
use App\Database\DB;
use App\Models\DataService;
use App\Services\EmailSender;
use App\Services\SMSSender;

$connection = DB::getInstance();
$dataService = new DataService($connection);
$emailSender = new EmailSender();
$smsSender = new SMSSender();

$controller = new FormController($dataService, $emailSender, $smsSender);

//TODO Route part can be modified in the future
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleRequest();
} else {
    $controller->index();
}