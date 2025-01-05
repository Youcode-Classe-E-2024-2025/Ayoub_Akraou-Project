<?php
// $projects = Project::getProjects($_SESSION['user_id']);
$projects = Project::getProjects(1);
// dd($projects);
$users = Project::getUsersNotInProject($_SESSION['project_id']);
require "views/home.view.php";
require "views/components/addProjectForm.php";
require "views/components/addMemberForm.php";
require "views/components/addTaskForm.php";
