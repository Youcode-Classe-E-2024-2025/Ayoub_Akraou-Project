<?php
class Manager extends User
{
   private $role = 'manager';
   private $projects;
   public function __construct($name = '', $email = '', $password = '')
   {
      parent::__construct($name, $email, $password);
   }

   public static function assignTask($taskId, $userId)
   {
      $query = 'INSERT INTO task_users (task_id, user_id) VALUES (:task_id, :user_id)';
      $params = [
         'task_id' => $taskId,
         'user_id' => $userId
      ];
      $db = new Database();
      $db->query($query, $params);
   }
}
