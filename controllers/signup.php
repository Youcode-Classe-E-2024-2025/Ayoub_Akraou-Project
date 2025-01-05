<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $fullname = htmlspecialchars($_POST['fullname']);
   $email = htmlspecialchars($_POST['email']);
   $password = htmlspecialchars($_POST['password']);
   $confirm_password = htmlspecialchars($_POST['confirm-password']);

   if (! Validator::fullname($fullname)) $error = 'Enter a valid name!';
   elseif (! Validator::email($email)) $error = 'Enter a valid email!';
   elseif ($password !== $confirm_password) $error = 'Passwords are not identical!';
   elseif (! Validator::strongPassword($password)) $error = 'Weak password!';
   else {
      $newUser = new User($fullname, $email, $password);
      $result = $newUser->register();
      header('location: /login');
   }
}

require "views/signup.view.php";
