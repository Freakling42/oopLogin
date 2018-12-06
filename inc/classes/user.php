<?php
include 'inc/database.php';

class User {
    private $conn;

    // Get database access
    public function __construct(\PDO $pdo) 
    {
        $this->conn = $pdo;
    }
    
    // Check if the user is already logged in
    public function is_logged_in() 
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        }
    } 
    
    // Get current user info
    public function getCurrentUserInfo()
    {
        $returned_row = '';
    
        if (isset($_SESSION['user_session'])) {
            // Define current user id
            $userID = $_SESSION['user_session'];
            
            try {            
                // Define query
                $sql = "SELECT * FROM pg_users WHERE user_id=:user_id";
                $query = $this->conn->prepare($sql);

                // Bind parameters
                $query->bindParam(":user_id", $userID);

                // Execute the query
                $query->execute();

                // Return row as an array indexed by both column name
                $returned_row = $query->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log($e->getMessage());
            }            
        } 
        return $returned_row;        
    }
    
    // Check if username or email is allready in use
    public function validateUsernameEmail($user_username, $user_email)
    {
        $returnvalue = '';
        
        try {
            // Define query to select matching values
            $sql = "SELECT user_username, user_email FROM pg_users WHERE user_username=:user_username OR user_email=:user_email";

            // Prepare the statement
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(':user_username', $user_username);
            $query->bindParam(':user_email', $user_email);

            // Execute the query
            $query->execute();

            // Return clashes row as an array indexed by both column name
            $returned_clashes_row = $query->fetch(PDO::FETCH_ASSOC);

            // Check for usernames or e-mail addresses that have already been used
            if ($returned_clashes_row['user_username'] == $user_username) {
                $returnvalue = '1'; // usernames have already been used
            } elseif ($returned_clashes_row['user_email'] == $user_email) {
                $returnvalue = '2'; // e-mail have already been used
            } else {
                $returnvalue = '3'; // username and e-mail have not been used
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $returnvalue;
    }
    
    // Register new users
    public function registerUser($user_username, $user_email, $user_password, $user_firstname, $user_lastname, $user_adress, $user_postal, $user_city)
    {
        try {
            // Hash password
            $user_hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            // Define query to insert values into the users table
            $sql = "INSERT INTO pg_users(user_username, user_email, user_pass, user_firstname, user_lastname, user_adress, user_postalcode, user_city) VALUES(:user_username, :user_email, :user_password, :user_firstname, :user_lastname, :user_adress, :user_postal, :user_city)";

            // Prepare the statement
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(":user_username", $user_username);
            $query->bindParam(":user_email", $user_email);
            $query->bindParam(":user_password", $user_hashed_password);
            $query->bindParam(":user_firstname", $user_firstname);
            $query->bindParam(":user_lastname", $user_lastname);
            $query->bindParam(":user_adress", $user_adress);
            $query->bindParam(":user_postal", $user_postal);
            $query->bindParam(":user_city", $user_city);

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

    // Edit user password
    public function editPass($user_password)
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
    
    // Edit user information
    public function editUser($user_firstname, $user_lastname, $user_adress, $user_postalcode, $user_city)
    {
        try {            
            //user id
            $user_id = $_SESSION['user_session'];

            // Define query to update user values
            $sql = "UPDATE pg_users SET user_firstname=:user_firstname, user_lastname=:user_lastname, user_adress=:user_adress, user_postalcode=:user_postalcode, user_city=:user_city WHERE user_id=:user_id";
            $query = $this->conn->prepare($sql);

            // Bind parameters
            $query->bindParam(":user_firstname", $user_firstname);
            $query->bindParam(":user_lastname", $user_lastname);
            $query->bindParam(":user_adress", $user_adress);
            $query->bindParam(":user_postalcode", $user_postalcode);
            $query->bindParam(":user_city", $user_city);
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