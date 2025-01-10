<?php
require "../../helpers/functions.php";
require "../../models/Task.php";
require "../../db/Database.php";
session_start();
$role = $_SESSION['role'];
if ($role === "manager") Task::delete($_GET['id']);
header('Location: /');
