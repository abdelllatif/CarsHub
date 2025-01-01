<?php
require_once 'connectiondatabase.php';  

class User extends Data {
    protected $lastName;
    protected $firstName;
    protected $email;
    protected $password;
    public $role;
    public $createdAt;
    public $phone;
    public $pdo;

    public function __construct($lastName, $firstName, $email, $password, $phone) {
        $this->pdo = $this->connextion();  

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $this->sanitizeEmail($email);  
        $this->password = $this->hashPassword($password);  
        $this->phone = $phone;
        $this->role = "user"; 
        $this->createdAt = date("Y-m-d H:i:s"); 
    }

    private function sanitizeEmail($email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function register() {
        try {
            $query = "INSERT INTO users (lastName, firstName, email, password, role, createdAt, phone)
                      VALUES (:lastName, :firstName, :email, :password, :role, :createdAt, :phone)";
            $stmt = $this->pdo->prepare($query);  
            $stmt->bindParam(":lastName", $this->lastName);
            $stmt->bindParam(":firstName", $this->firstName);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":createdAt", $this->createdAt);
            $stmt->bindParam(":phone", $this->phone);

            if ($stmt->execute()) {
                echo "Data sent successfully";
                header('Location: signin.php');
                exit();
            } else {
                $errormessage = $stmt->errorInfo();
                echo "Error: " . $errormessage[2];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    //  login
    public function login($email2, $password2) {
        $query = "SELECT * FROM users WHERE email = :email2";
        $stmt = $this->pdo->prepare($query);  
        $stmt->bindParam(":email2", $email2);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo "This user not found";
            exit();
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password2, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            echo "Login successful";
            header('Location: index.php');
            exit();
        } else {
            echo "Invalid password";
        }
    }

    //  logout
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        echo "Logged out successfully";
        header('Location: signin.php');
        exit();
    }

    // Get user info
    public function getProfile($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo "No profile found";
            exit();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
?>
