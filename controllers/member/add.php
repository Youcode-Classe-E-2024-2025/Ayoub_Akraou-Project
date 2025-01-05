<?php
session_start();
require "../../db/Database.php";
require "../../models/Project.php";

if (isset($_POST['user_id'])) {
   Project::addMember($_SESSION['project_id'], htmlspecialchars($_POST['user_id']));
   header('Location: /');
}
