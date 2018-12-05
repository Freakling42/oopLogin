<?php
include 'inc/database.php';

class User {
    private $conn;

    // Get database access
    public function __construct(\PDO $pdo) 
    {
        $this->conn = $pdo;
    }

    // List all users
    public function get_users() 
    {
        return $this->conn->query("SELECT * FROM pg_users")->fetchAll();
    }
    
    // Check if the user is already logged in
    public function is_logged_in() 
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    } 
    
    public function getCurrentUserInfo()
    {
        $returned_row = '';
    
        if (isset($_SESSION['user_session'])) {
            // Define current user id
            $userID = $_SESSION['user_session'];
            
            // Define query
            $sql = "SELECT user_username FROM pg_users WHERE user_id=:user_id";
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(":user_id", $userID);

            // Execute the query
            $query->execute();

            // Return row as an array indexed by both column name
            $returned_row = $query->fetch(PDO::FETCH_ASSOC);
            
        } 
        return $returned_row;        
    }
    
    // Log in registered users with either their username or email and their password
    public function login($user_name, $user_email, $user_password)
    {
        try {
            // Define query
            $sql = "SELECT * FROM pg_users WHERE user_username =:user_name OR user_email=:user_email LIMIT 1";
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(":user_name", $user_name);
            $query->bindParam(":user_email", $user_email);

            // Execute the query
            $query->execute();

            // Return row as an array indexed by both column name
            $returned_row = $query->fetch(PDO::FETCH_ASSOC);
            // Check if row is actually returned
            if ($query->rowCount() > 0) {            
                // Verify hashed password against entered password
                if (password_verify($user_password, $returned_row['user_pass'])) {                
                    // Define session on successful login
                    $_SESSION['user_session'] = $returned_row['user_id'];
                    return true;
                } else {                
                    // Define failure
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    
    // Log out user
    public function log_out() 
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }  

    // Edit user
    public function edit($user_password)
    {
        try {
            // Hash password
            $user_hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
            
            //user id
            $user_id = $_SESSION['user_session'];

            // Define query to update user values
            $sql = "UPDATE pg_users SET user_pass=:user_password WHERE user_id=:user_id";
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(":user_password", $user_hashed_password);
            $query->bindParam(":user_id", $user_id);

            // Execute the query
            $query->execute();
           
            // Check if row is actually returned
            if ($query->rowCount() > 0) {                   
                // Define success
                return true;
            } else {
                // Define failure
                return false;                
            }                                   
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    } 
  
}