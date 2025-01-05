<?php
class Member extends User
{
   private $role = 'regular';
   private $tasks;
   public function __construct($name = '', $email = '', $password = '')
   {
      parent::__construct($name, $email, $password);
   }

   public static function changeTaskStatus($taskId, $newStatus)
   {
      $query = "UPDATE tasks SET status = :newStatus WHERE id = :taskId";
      $params = ['newStatus' => $newStatus, 'taskId' => $taskId];
      $db = new Database();
      $db->query($query, $params);
   }
   public static function getTasks($userId)
   {
      $query = "SELECT 
                  tasks.id ,
                  tasks.title,
                  tasks.description,
                  tasks.status,
                  tasks.due_date,
                  categories.name AS category,
                  GROUP_CONCAT(tags.name) AS tags
               FROM 
                  tasks
               JOIN 
                  task_users ON tasks.id = task_users.task_id
               LEFT JOIN 
                  categories ON tasks.category_id = categories.id
               LEFT JOIN 
                  task_tags ON tasks.id = task_tags.task_id
               LEFT JOIN 
                  tags ON task_tags.tag_id = tags.id
               WHERE 
                  task_users.user_id = :userId
               GROUP BY 
                  tasks.id;
";
      $params = ['userId' => $userId];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return [
         'success' => true,
         'body' => $tasks
      ];
   }
}
