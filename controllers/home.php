<?php
// $projects = Project::getProjects($_SESSION['user_id']);
$projects = Project::getProjects(1);
// dd($projects);
$users = User::getUsersNotInProject(6);
require "views/home.view.php";
require "views/components/addProjectForm.php";
require "views/components/addMemberForm.php";
