<?php

require_once __DIR__ . '/vendor/autoload.php';

// Połączenie z bazą danych SQLite
$db = new SQLite3(__DIR__ . '/db/test.db');

$query = 'DROP TABLE IF EXISTS address_book';
$db->exec($query);

// Tworzenie tabeli, jeśli nie istnieje
$query = 'CREATE TABLE IF NOT EXISTS address_book (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    phone_number TEXT NOT NULL,
    email TEXT NOT NULL,
    address TEXT NOT NULL
)';
$db->exec($query);

// Zamknięcie połączenia z bazą danych
$db->close();

echo "Tabela address_book została utworzona lub już istnieje.";