<?php

namespace App\Controllers;

use App\Models\AddressBook;
use SQLite3;

class AddressBookController 
{
    private $addressBookModel;

    const PATH = __DIR__. '/../';

    public function __construct(SQLite3 $db) 
    {
        $this->addressBookModel = new AddressBook($db);
    }

    public function index() 
    {
        $contacts = $this->addressBookModel->getAll($_GET['filter'] ?? '');
        require(self::PATH . 'views/index.php');
    }

    public function add() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phoneNumber = $_POST['phoneNumber'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            if (empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($email)) {
                echo "Niektóre pola są puste.";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Nieprawidłowy adres e-mail.";
                return;
            }

            if (!preg_match('/^\d{9}$/', $phoneNumber)) {
                echo "Nieprawidłowy numer telefonu.";
                return;
            }

            $this->addressBookModel->add($firstName, $lastName, $phoneNumber, $email, $address);
            header('Location: index.php');
        }
    }

    public function delete() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $this->addressBookModel->delete($id);
            header('Location: index.php');
        }
    }
}