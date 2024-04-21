<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\AddressBookController;

$db = new SQLite3(__DIR__ . '/db/test.db');

$addressBookController = new AddressBookController($db);

switch (isset($_GET['action']) ? $_GET['action'] : 'index') {
    case 'add':
        $addressBookController->add();
        break;
    case 'delete':
        $addressBookController->delete();
        break;
    default:
        $addressBookController->index();
        break;
}

$db->close();