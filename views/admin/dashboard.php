<?php

session_start();


// include __DIR__ .'/../../database/connexion.php';
include __DIR__ . '/../../model/User.php';
$name = "";
$email = "";
$password = "";
$role = "";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Affichage User</title>
</head>
<body>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $user = new user($name,$email,$password,$role);
     $all = $user->getUsers();
    if ($all) {
        while ($row = mysqli_fetch_assoc($all)) {
            ?>
    <tr>
    <td>
          <?= $row['name'] ?>
      </td>
      <td>
          <?= $row['email'] ?>
      </td>
      <td>
          <?= $row['role_id'] ?>
      </td>
      <td>
        <div>
        <a href=""><i class="fa-solid fa-pen"></i></a>
        <a href=""><i class="fa-solid fa-trash"></i></a>
        </div>
      </td>
    </tr>
    <?php
        }
        }
       ?>
  </tbody>
</table>
<a href="../../controllers/auth/AuthController.php">Déconnexion</a>

</body>
</html>                                                                                                                                                                                                                                                                             `