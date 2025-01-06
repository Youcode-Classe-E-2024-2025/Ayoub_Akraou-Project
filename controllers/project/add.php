<?php
require '../../helpers/functions.php';
require '../../db/Database.php';
require '../../models/Project.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $name = htmlspecialchars($_POST['name']);
   $description = htmlspecialchars($_POST['description']);
   $visibility = htmlspecialchars($_POST['visibility']);
   $due_date = htmlspecialchars($_POST['due_date']);

   $newProject = new Project($name, $description, $due_date, $visibility);
   $success = $newProject->create($_SESSION['manager_id']);
   // dd($_SESSION);
   if ($success) header('Location: /');
}
