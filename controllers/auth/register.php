<?php
session_start();
include __DIR__ .'/../../database/connexion.php';

class Register {
    private $database;

    public function __construct() {
        $db = new Database();
        $this->database = $db->Connection();
    }
    
    public function registration($name, $email, $password, $confirmpassword) {
        if (empty($name) || empty($email) || empty($password) || empty($confirmpassword)) {
            $_SESSION['error']= 'name, email, and password are required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] ='invalid email';
        } else {
            $userExist = "SELECT * FROM `user` WHERE `name`= '$name' OR `email`='$email'";
            $Existresult = mysqli_query($this->database, $userExist);

            if (mysqli_num_rows($Existresult) > 0) {
                $_SESSION['error'] = 'username or email has already been taken';
            } else {
                if ($password == $confirmpassword) {
                    $insertUser = "INSERT INTO `user`(`name`, `email`, `password`) VALUES (?, ?, ?)";
                    $stmt_insert = mysqli_prepare($this->database, $insertUser);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt_insert, "sss", $name, $email, $hashed_password);
                    $insert_result = mysqli_stmt_execute($stmt_insert);
                    return 1; // Enregistrement réussi
                } else {
                    $_SESSION['error'] ='passwords do not match';
                }
            }
        }
    }
}

if (isset($_POST['submit'])) {
    $register = new Register();
    $result = $register->registration($_POST['name'], $_POST['email'], $_POST['password'], $_POST['c_password']);
    
    if ($result === 1) {
        header('Location: ../../views/auth/login.php');
        exit(); 
    } else {
        header('Location: ../../views/auth/register.php');
    }
}
?>
