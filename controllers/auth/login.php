<?php
session_start();
include __DIR__ . '/../../database/connexion.php';

class Login {
    private $database;

    public function __construct(){
        $db = new Database();
        $this->database = $db->connection();
    }

    public function signIn($email, $password){
        if(empty($email) || empty($password)){
            $_SESSION['error'] = 'Email and password are required';   
        } else {
            $email = mysqli_real_escape_string($this->database, $email);
            $query = "SELECT * FROM `user` WHERE `email`='$email'";
            $result = mysqli_query($this->database, $query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                if(password_verify($password, $row['password'])){
                    $_SESSION['id'] = $row['id']; 
                    $_SESSION['role'] = $row['role_id']; 
                    if($_SESSION['role'] == 1){
                        header('Location: ../../views/admin/dashboard.php');
                        exit();
                    } else {
                        header('Location: ../../views/user/dashboard.php');
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Password is wrong';
                }
            } else {
                $_SESSION['error'] = 'User not registered';
            }
        }
        header('Location: ../../views/auth/login.php');
        exit();
    }
}

if (isset($_POST['submit'])) {
    $login = new Login();
    $login->signIn($_POST['email'], $_POST['password']);
}
?>
