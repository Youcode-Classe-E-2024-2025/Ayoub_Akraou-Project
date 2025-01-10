<?php
// if (! User::isLoggedIn()) header('Location: /login');
// dd($_SESSION['user_id']);
$projects = Project::getProjects($_SESSION['user_id']);
// selecter le premier projet si on a aucun projet selectionné:
if (! isset($_SESSION['project_id'])) $_SESSION['project_id'] =  $projects[0]['id'];
$selectedProject = $_SESSION['project_id'];

$categories = Category::getCategories();
$db = new Database();
$next_task_id = $db->lastId('tasks');

$user_role = $_SESSION['role'];
$tasks = $user_role === 'manager' ? Task::getTasksByProject($selectedProject) : Task::getTasksByUser($_SESSION['user_id'], $selectedProject);

$tasks_todo = array_filter($tasks, fn($task) => $task['status'] === 'todo');
$tasks_doing = array_filter($tasks, fn($task) => $task['status'] === 'doing');
$tasks_done = array_filter($tasks, fn($task) => $task['status'] === 'done');

$progress = Project::getProgress($selectedProject);

require "views/home.view.php";
require "views/components/forms/addProjectForm.php";
require "views/components/forms/addMemberForm.php";
require "views/components/forms/addTaskForm.php";
require "views/components/forms/updateTaskForm.php";
