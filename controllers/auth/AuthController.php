<?php
session_start();
include __DIR__ . '/../../model/User.php';

class AuthController {
    
    public function register($name, $email, $password, $confirmPassword) {
        $error = '';
        
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            $error = 'Name, email, and password are required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email';
        } else {
            $user = new User($name, $email, $hashedPassword, 2);
            $check = $user->getUserByEmailName();
            if ($check->num_rows > 0) {
                $error = 'Username or email has already been taken';
            } elseif ($password !== $confirmPassword) {
                $_SESSION['error'] = 'Passwords do not match';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user->insertUser();
                header("Location: ../../views/auth/login.php");
                exit();
            }
        }
        
        $_SESSION['error'] = $error;
        header("Location: ../../views/auth/register.php");
        exit();
    }
    
    public function login($email, $password) {
        $error = '';
        $user = new User(null, $email, null, null);
        $result = $user->getUserByEmailName();
        
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if (password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id']; 
                $_SESSION['role'] = $userData['role_id'];
                if ($_SESSION['role'] == 1) {
                    header("Location: ../../views/admin/dashboard.php");
                    exit();
                } else {
                    header('Location: ../../views/user/dashboard.php');
                    exit();
                }
            } else {
                $error = 'Incorrect password';
            }
        } else {
            $error = 'User not found';
        }
        $_SESSION['error'] = $error;
        header("Location: ../../views/auth/login.php");
        exit();
    }
    
     public function logout() { 
            session_destroy(); 
            header("Location: ../../views/auth/login.php");
            exit();
        }
    
    
}

if (isset($_POST['register'])) {
    $register = new AuthController();
    $register->register($_POST['name'], $_POST['email'], $_POST['password'], $_POST['c_password']);
}

if (isset($_POST['login'])) {
    $loginController = new AuthController();
    $loginController->login($_POST['email'], $_POST['password']);
}

$authController = new AuthController();
$authController->logout();
?>
