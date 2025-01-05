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

   public function createTask($project_id, $category_id,  $tags_id)
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
      $task_id = $this->db->getLastInsertId(); // Récupère l'ID de la tâche insérée

      // Lier les tags à la tâche
      foreach ($tags_id as $tag_id) {
         $sql = "INSERT INTO task_tags (task_id, tag_id) VALUES (:task_id, :tag_id)";
         $params = [
            ':task_id' => $task_id,
            ':tag_id' => $tag_id
         ];
         $this->db->query($sql, $params);
      }

      return $task_id;
   }

   public function updateTask($task_id, $category_id,  $tags_id)
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
   }

   public static function getTaskDetails($task_id)
   {
      $db = new Database();

      $sql = "
            SELECT 
               tasks.id,
               tasks.title,
               tasks.description,
               tasks.due_date,
               tasks.status,
               categories.name AS category,
               GROUP_CONCAT(tags.name) AS tags
            FROM tasks
            LEFT JOIN categories ON tasks.category_id = categories.id
            LEFT JOIN task_tags ON tasks.id = task_tags.task_id
            LEFT JOIN tags ON task_tags.tag_id = tags.id
            WHERE tasks.id = :task_id
            GROUP BY tasks.id";

      $params = [':task_id' => $task_id];
      $stmt = $db->query($sql, $params);

      return $stmt->fetch();
   }


   public static function deleteTask($task_id)
   {
      $db = new Database();
      $sql = "DELETE FROM tasks WHERE id = :id";
      $params = [':id' => $task_id];

      $db->query($sql, $params);
   }
}
