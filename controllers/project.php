<?php

if (!isset($_GET['id'])) header("Location: /projects");
$project_id = $_GET['id'];
$project = Project::getDetails($project_id);
$members = Project::getMembers($project_id, true);
if (isset($_GET['member_id'])) {
   Project::removeMember($project_id, $_GET['member_id']);
   header("Location: /project?id=" . $project_id);
   exit();
}
require "views/project.view.php";
