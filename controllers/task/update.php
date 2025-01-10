<?php
require "../../db/Database.php";
require "../../models/Task.php";
require "../../helpers/functions.php";

dd($_POST);
$tags_id = isset($_POST['tags']) ? $_POST['tags'] : [];
$collaborators_id = isset($_POST['collaborators']) ? $_POST['collaborators'] : [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $newTask = new Task($_POST['title'], $_POST['description'], $_POST['due_date'], $_POST['status']);
   $newTask->update($_POST['id'], $_POST['category'], $tags_id, $collaborators_id);
}
header('Location: /');
