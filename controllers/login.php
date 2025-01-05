<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $result = User::login($email, $password);
   if ($result['success']) header('location: /');
   else {
      $error = $result['message'];
   }
}
require "views/login.view.php";
