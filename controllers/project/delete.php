<?php
require "../../db/Database.php";
require "../../models/Project.php";

if (isset($_GET['id'])) Project::delete($_GET['id']);
header('Location: /projects');
