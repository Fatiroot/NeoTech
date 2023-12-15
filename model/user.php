<?php
// session_start();
include '../../database/connexion.php';
class User {
    protected $database;
    private $name;
    private $email;
    private $password;
    private $role;

    public function __construct($name,$email,$password,$role) {
        $db = new Database();
        $this->database = $db->Connection();
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->role=$role;
    }


       // Setters
       public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    // Getters
    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getUserByEmailName(){
        $select = "SELECT * FROM `user` WHERE `email` = '$this->email' OR `name`='$this->name'";
        $result = mysqli_query($this->database, $select);
        return $result;

    }
    public function insertUser(){
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `user`(`name`, `email`, `password`, `role_id`) VALUES ('$this->name','$this->email','$hashedPassword','2')";
        $result = mysqli_query($this->database, $query);
        return $result;
    }

    public function getUsers(){
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($this->database,  $query);
        $users = array();
        while ($userData = $result->fetch_assoc()) {
            $users[] = new User($userData['name'], $userData['email'], $userData['password'], $userData['role']);
        }
        return $users;

    }
}
?>