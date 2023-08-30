<?php

class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'users';
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function execute($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }

    // CRUD operations for users
    public function createUser($username, $email, $role) {
        $sql = "INSERT INTO users (username, email, role) VALUES (?, ?, ?)";
        $this->execute($sql, [$username, $email, $role]);
    }
     // Read user information by providing the user's id
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user information
    public function updateUser($id, $username, $email, $role) {
        $sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        return $this->execute($sql, [$username, $email, $role, $id]);
    }

    // Delete a user by providing the user's id
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}
   

?>
  