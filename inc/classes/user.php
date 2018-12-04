<?php
include 'inc/database.php';

class User {
    private $conn;

    /* Get database access */
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    /* List all users */
    public function get_users() {
        return $this->conn->query("SELECT user_email, user_username FROM pg_users")->fetchAll();
    }
}