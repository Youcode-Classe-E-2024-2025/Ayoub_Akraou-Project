<?php
$projects = Project::getProjects($_SESSION['manager_id']);
// dd($projects);
require "views/projects.view.php";
require "views/components/forms/updateProjectForm.php";
