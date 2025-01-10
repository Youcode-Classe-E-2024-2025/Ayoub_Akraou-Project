<?php
session_start();
require "../../helpers/functions.php";
require "../../db/Database.php";
require "../../models/Task.php";

dd($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $title = htmlspecialchars($_POST["title"]);
   $description = htmlspecialchars($_POST["description"]);
   $due_date = htmlspecialchars($_POST["due_date"]);
   $status = htmlspecialchars($_POST["status"]);
   $category_id = htmlspecialchars($_POST["category"]);
   $tags = array_map(fn($el) => htmlspecialchars($el), isset($_POST["tags"]) ? $_POST["tags"] : []);
   $collaborators = isset($_POST["collaborators"]) ? array_map(fn($el) => htmlspecialchars($el), $_POST["collaborators"]) : [];
   dd($_SESSION);
   $newTask = new Task($title, $description, $due_date, $status);
   $newTask->create($_SESSION['project_id'], $category_id, $tags, $collaborators);
   header('Location: /');
}
