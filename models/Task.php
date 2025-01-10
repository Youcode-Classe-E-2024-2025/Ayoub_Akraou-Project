<?php
class Task
{
   private $title;
   private $description;
   private $due_date;
   private $status;
   private $db;
   public function __construct($title, $description, $due_date, $status)
   {
      $this->db = new Database(); // Instance de la base de données
      $this->title = $title;
      $this->description = $description;
      $this->due_date = $due_date;
      $this->status = $status;
   }

   public function create($project_id, $category_id,  $tags_id, $collaborators_id)
   {
      $sql = "INSERT INTO tasks (title, description, due_date, status, project_id, category_id) 
              VALUES (:title, :description, :due_date, :status, :project_id, :category_id)";
      $params = [
         ':title' => $this->title,
         ':description' => $this->description,
         ':due_date' => $this->due_date,
         ':status' => $this->status,
         ':project_id' => $project_id,
         ':category_id' => $category_id
      ];

      $stmt = $this->db->query($sql, $params);
      $task_id = $this->db->getLastInsertId();

      foreach ($tags_id as $tag_id) {
         $sql = "INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)";
         $params = [
            ':task_id' => $task_id,
            ':tag_id' => $tag_id
         ];
         $this->db->query($sql, $params);
      }

      foreach ($collaborators_id as $collaborator_id) {
         $this->assignTo($task_id, $collaborator_id);
      }

      return $task_id;
   }

   public function update($task_id, $category_id, $tags_id, $collaborators_id)
   {
      $sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date, 
              status = :status, category_id = :category_id WHERE id = :task_id";
      $params = [
         ':title' => $this->title,
         ':description' => $this->description,
         ':due_date' => $this->due_date,
         ':status' => $this->status,
         ':category_id' => $category_id,
         ':task_id' => $task_id
      ];
      $this->db->query($sql, $params);

      // Supprimer les anciennes associations de tags
      $sql = "DELETE FROM task_tags WHERE task_id = :task_id";
      $this->db->query($sql, [':task_id' => $task_id]);

      // Lier les nouveaux tags à la tâche
      foreach ($tags_id as $tag_id) {
         $sql = "INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)";
         $params = [
            ':task_id' => $task_id,
            ':tag_id' => $tag_id
         ];
         $this->db->query($sql, $params);
      }

      // Supprimer les anciennes associations de users
      $sql = "DELETE FROM task_users WHERE task_id = :task_id";
      $this->db->query($sql, [':task_id' => $task_id]);

      // Lier les nouveaux collaborateurs à la tâche
      foreach ($collaborators_id as $collaborator_id) {
         $this->assignTo($task_id, $collaborator_id);
      }
   }

   public static function getTaskDetails($task_id)
   {
      $query = "SELECT
                  tasks.id,
                  tasks.title,
                  tasks.description,
                  tasks.status,
                  tasks.due_date,
                  categories.id AS category_id,
                  categories.name AS category_name,
                  tags.id AS tag_id,
                  tags.name AS tag_name,
                  tags.color AS tag_color,
                  users.id AS collaborator_id,
                  users.name AS collaborator_name
               FROM
                  tasks
               LEFT JOIN categories ON tasks.category_id = categories.id
               LEFT JOIN task_tags ON tasks.id = task_tags.task_id
               LEFT JOIN tags ON task_tags.tag_id = tags.id
               LEFT JOIN task_users ON tasks.id = task_users.task_id
               LEFT JOIN users ON task_users.user_id = users.id
               WHERE
                  tasks.id = :task_id";

      $params = ['task_id' => $task_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Organize the results to group tags and collaborators by task
      $tasks = [];
      foreach ($results as $row) {
         $taskId = $row['id'];

         // Initialize the task entry if it doesn't exist
         if (!isset($tasks[$taskId])) {
            $tasks[$taskId] = [
               'id' => $row['id'],
               'title' => $row['title'],
               'description' => $row['description'],
               'status' => $row['status'],
               'due_date' => $row['due_date'],
               'category' => $row['category_id'],
               'tags' => [],
               'collaborators' => []
            ];
         }

         // Add tag if it exists and is not already added
         if ($row['tag_id'] !== null) {
            if (!in_array($row['tag_id'], $tasks[$taskId]['tags'])) {
               $tasks[$taskId]['tags'][] = $row['tag_id'];
            }
         }

         // Add collaborator if it exists and is not already added
         if ($row['collaborator_id'] !== null) {
            if (!in_array($row['collaborator_id'], $tasks[$taskId]['collaborators'])) {
               $tasks[$taskId]['collaborators'][] = $row['collaborator_id'];
            }
         }
      }

      // Convert the associative array to an indexed array
      return array_values($tasks);
   }

   public static function delete($task_id)
   {
      $db = new Database();
      $sql = "DELETE FROM tasks WHERE id = :id";
      $params = [':id' => $task_id];

      $db->query($sql, $params);
   }

   public static function assignTo($taskId, $userId)
   {
      $query = 'INSERT INTO task_users (task_id, user_id) VALUES (:task_id, :user_id)';
      $params = [
         'task_id' => $taskId,
         'user_id' => $userId
      ];
      $db = new Database();
      $db->query($query, $params);
   }
   public static function changeStatus($taskId, $newStatus)
   {
      $query = "UPDATE tasks SET status = :newStatus WHERE id = :taskId";
      $params = ['newStatus' => $newStatus, 'taskId' => $taskId];
      $db = new Database();
      $db->query($query, $params);
   }
   public static function getTasksByUser($user_id, $project_id)
   {
      $query = "SELECT
                  tasks.id,
                  tasks.title,
                  tasks.description,
                  tasks.status,
                  tasks.due_date,
                  categories.name AS category,
                  GROUP_CONCAT(tags.name) AS tags
               FROM
                  tasks
               JOIN task_users ON tasks.id = task_users.task_id
               JOIN project_users ON task_users.user_id = project_users.user_id
               LEFT JOIN categories ON tasks.category_id = categories.id
               LEFT JOIN task_tags ON tasks.id = task_tags.task_id
               LEFT JOIN tags ON task_tags.tag_id = tags.id
               WHERE
                  task_users.user_id = :user_id AND project_users.project_id = :project_id
               GROUP BY
                  tasks.id";
      $params = ['user_id' => $user_id, 'project_id' => $project_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tasks;
   }
   public static function getTasksByProject($project_id)
   {
      $query = "SELECT
                tasks.id,
                tasks.title,
                tasks.description,
                tasks.status,
                tasks.due_date,
                categories.name AS category,
                tags.name AS tag_name,
                tags.color AS tag_color
              FROM
                tasks
              LEFT JOIN categories ON tasks.category_id = categories.id
              LEFT JOIN task_tags ON tasks.id = task_tags.task_id
              LEFT JOIN tags ON task_tags.tag_id = tags.id
              WHERE
                tasks.project_id = :project_id";

      $params = ['project_id' => $project_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Organiser les résultats pour regrouper les tags par tâche
      $tasks = [];
      foreach ($results as $row) {
         $taskId = $row['id'];
         if (!isset($tasks[$taskId])) {
            $tasks[$taskId] = [
               'id' => $row['id'],
               'title' => $row['title'],
               'description' => $row['description'],
               'status' => $row['status'],
               'due_date' => $row['due_date'],
               'category' => $row['category'],
               'tags' => []
            ];
         }
         if ($row['tag_name'] !== null) {
            $tasks[$taskId]['tags'][] = [
               'name' => $row['tag_name'],
               'color' => $row['tag_color']
            ];
         }
      }

      // Convertir le tableau associatif en liste indexée
      return array_values($tasks);
   }
   public static function getUnassignedUsersForTask($project_id, $task_id)
   {
      $query = 'SELECT u.id, u.name, u.email, u.role
               FROM users u
               JOIN project_users pu ON u.id = pu.user_id
               LEFT JOIN task_users tu ON u.id = tu.user_id AND tu.task_id = :task_id
               WHERE pu.project_id = :project_id 
               AND tu.user_id IS NULL';
      $params = ['project_id' => $project_id, 'task_id' => $task_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $users;
   }
}
