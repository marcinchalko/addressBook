<?php

namespace App\Models;

use SQLite3;

class AddressBook 
{
    private $db;

    public function __construct(SQLite3 $db) {
        $this->db = $db;
    }

    public function add($firstName, $lastName, $phoneNumber, $email, $address) 
    {
        $stmt = $this->db->prepare('INSERT INTO address_book (first_name, last_name, phone_number, email, address) VALUES (:firstName, :lastName, :phoneNumber, :email, :address)');
        $stmt->bindValue(':firstName', $firstName, SQLITE3_TEXT);
        $stmt->bindValue(':lastName', $lastName, SQLITE3_TEXT);
        $stmt->bindValue(':phoneNumber', $phoneNumber, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':address', $address, SQLITE3_TEXT);
        $stmt->execute();
    }

    public function getAll($filter = null) 
    {
        if ($filter !== null) {
            $stmt = $this->db->prepare('SELECT * FROM address_book WHERE first_name LIKE :filter OR last_name LIKE :filter');
            $stmt->bindValue(':filter', '%' . $this->validateInput($filter) . '%', SQLITE3_TEXT);
            $result = $stmt->execute();
        } else {
            $result = $this->db->query('SELECT * FROM address_book');
        }
        
        $contacts = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $contacts[] = $row;
        }
        return $contacts;
    }

    public function delete($id) 
    {
        $stmt = $this->db->prepare('DELETE FROM address_book WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
    }

    private function validateInput($data) 
    {
        return htmlspecialchars(trim($data));
    }
}