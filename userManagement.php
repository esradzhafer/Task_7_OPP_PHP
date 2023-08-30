<?php

require_once 'User.php';
require_once 'Database.php';

class UserManagement {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function createUser($username, $email, $role) {
        $this->database->createUser($username, $email, $role);
    }

    public function getUserById($id) {
        return $this->database->getUserById($id);
    }

    public function updateUser($id, $username, $email, $role) {
        return $this->database->updateUser($id, $username, $email, $role);
    }

    public function deleteUser($id) {
        return $this->database->deleteUser($id);
    }
}

?>
