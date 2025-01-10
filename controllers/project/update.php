<?php
require '../../helpers/functions.php';
require '../../db/Database.php';
require '../../models/Project.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $id = htmlspecialchars($_POST['id']);
   $name = htmlspecialchars($_POST['name']);
   $description = htmlspecialchars($_POST['description']);
   $visibility = htmlspecialchars($_POST['visibility']);
   $due_date = htmlspecialchars($_POST['due_date']);

   $newProject = new Project($name, $description, $due_date, $visibility);
   $newProject->update($id);
   header('Location: /projects');
}
