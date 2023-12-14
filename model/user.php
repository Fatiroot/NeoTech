<?php
// session_start();
include '../../database/connexion.php';
class User {
    protected $database;
    protected $name;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($name,$email,$password,$role) {
        $db = new Database();
        $this->database = $db->Connection();
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->role=$role;
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
        $select = "SELECT * FROM `user`";
        $result = mysqli_query($this->database, $select);
        return $result;

    }
}
?>