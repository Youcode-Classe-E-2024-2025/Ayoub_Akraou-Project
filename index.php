
<?php
session_start();
require "db/Database.php";
// initialisation de la base de données si il n'y a pas une. 
require "db/db_init.php";
// mettre toutes les classes accessibles dans toute l'application
require "models/models.php";
// helpers
require "helpers/functions.php";
require "helpers/Validator.php";
// le system de routage
require "router.php";

// $newUser = new User('ayoub', 'ayoubakraou@gmail.com', 'abcd1234');
// $newUser->register();

// $newUser = new User('ayoub akraou', 'ayoubakraou@gmail.com', 'abcd1234');
// $newUser->updateProfile(6);

// dd(User::login('ayoubakraou@gmail.com', 'abcd1234'));

// echo json_encode(User::isLoggedIn());
// dd(User::getUserDetails(6));

// $admin = new ProjectManager('akram', 'akram@gmail.com', "123123123");
// dd($admin->register());
// Manager::assignTask(1, 7);

// Member::changeTaskStatus(1, 'todo');
// Member::getTasks(3);

// $newProject = new Project('Taskflow', 'gerer les taches', '2024-06-18', 'public');
// $newProject->createProject(1);
// $newProject->updateProject(2);
// Project::deleteProject(1);
// dd(Project::getProjectDetails(2));
// Project::addMember(2, 2);
// Project::addMember(2, 3);
// Project::removeMember(2, 2);
// dd(Project::getMembers(2));
// dd(Project::getProgress(2));

// $newTask = new Task('update task', 'description here!', '2024-02-09', 'done');
// $newTask->createTask(1, 1, [1, 3]);
// $newTask->updateTask(9, 2, [1, 2, 3]);
// dd(Task::getTaskDetails(9));
// Task::deleteTask(9);

// $c = new Category('web services');
// $c->updateCategory(1);
// Category::deleteCategory(8);
// dd(Category::getCategories());

// Tag::deleteTag(1);
// $tag = new Tag("aws");
// $tag->updateTag(4);
// dd(Tag::getTags());
// dd(User::isLoggedIn());

// dd($_SESSION);
