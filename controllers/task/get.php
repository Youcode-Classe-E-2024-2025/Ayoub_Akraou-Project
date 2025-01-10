<?php
require "../../db/Database.php";
require "../../models/Task.php";
require "../../helpers/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $id = $_GET['id'];
   $task = Task::getTaskDetails($id);
   echo json_encode($task);
   exit;
}
