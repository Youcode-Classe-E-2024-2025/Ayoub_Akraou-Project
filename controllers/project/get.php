<?php
session_start();
require "../../db/Database.php";
require "../../models/Project.php";
header('Content-Type: application/json');
// echo json_encode($_GET['id']);
if (isset($_GET['id'])) {
   echo json_encode(Project::getDetails($_GET['id']));
   exit;
}
