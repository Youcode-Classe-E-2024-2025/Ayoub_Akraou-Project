<?php
class Project
{
   private  string $name;
   private  string $description;
   private  string $due_date;
   private  string $visibility;
   private  Database $db;

   public function __construct($name, $description, $due_date, $visibility)
   {
      $this->name = $name;
      $this->description = $description;
      $this->due_date = $due_date;
      $this->visibility = $visibility;
      $this->db = new Database();
   }
   public function create($manager_id)
   {
      // creer le projet par un manager
      $query = "INSERT INTO projects (name, description, due_date, visibility, manager_id)
               VALUES (:name, :description, :due_date, :visibility, :manager_id)";
      $params = [
         'name' => $this->name,
         'description' => $this->description,
         'due_date' => $this->due_date,
         'visibility' => $this->visibility,
         'manager_id' => $manager_id,
      ];
      $stmt = $this->db->query($query, $params);
      $project_id = $this->db->getLastInsertId();

      // ajouter le manager comme un membre dans ce projet
      $query = "INSERT INTO project_users (project_id, user_id) VALUES (:project_id, :user_id)";
      $params = ['project_id' => $project_id, 'user_id' => $manager_id];
      $stmt = $this->db->query($query, $params);

      return $stmt->rowCount() > 0;
   }
   public function update($projectId)
   {
      $query = "UPDATE projects
               SET name = :name,
                   description = :description,
                   due_date = :due_date,
                   visibility = :visibility
               WHERE id = :id";
      $params = [
         'name' => $this->name,
         'description' => $this->description,
         'due_date' => $this->due_date,
         'visibility' => $this->visibility,
         'id' => $projectId,
      ];
      $stmt = $this->db->query($query, $params);
   }
   public static function delete($projectId)
   {
      $query = "DELETE FROM projects WHERE id = :id";
      $params = [':id' => $projectId];
      $db = new Database();
      $stmt = $db->query($query, $params);
   }
   public static function getProjects($user_id)
   {
      $query = "
               SELECT 
                  p.id,
                  p.name,
                  p.description,
                  p.visibility,
                  p.due_date,
                  p.manager_id
               FROM 
                  projects p
               JOIN 
                  project_users pu ON p.id = pu.project_id
               WHERE 
                  pu.user_id = :user_id
      ";
      $params = ['user_id' => $user_id];

      $db = new Database();
      $stmt = $db->query($query, $params);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public static function getDetails($projectId)
   {
      $query = "SELECT * FROM projects WHERE id = :id";
      $params = ['id' => $projectId];
      $db = new Database();
      $stmt = $db->query($query, $params);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
   public static function addMember($project_id, $user_id)
   {
      $query = "INSERT INTO project_users (project_id, user_id) VALUES (:project_id, :user_id)";
      $params = ['project_id' => $project_id, 'user_id' => $user_id];
      $db = new Database();
      $db->query($query, $params);
   }
   public static function getMembers($projectId, $without_managers = false)
   {
      $db = new Database();
      $condition = $without_managers ? 'pu.project_id = :project_id AND u.role != "manager"' : 'pu.project_id = :project_id';
      $query = "SELECT u.id, u.name, u.email
               FROM users u
               JOIN project_users pu ON u.id = pu.user_id
               WHERE $condition";
      $params = ['project_id' => $projectId];
      $stmt = $db->query($query, $params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public static function getUsersNotInProject($project_id)
   {
      $query = "
         SELECT DISTINCT u.id, u.name, u.email, u.role
         FROM users u
         LEFT JOIN project_users pu ON u.id = pu.user_id AND pu.project_id = :project_id
         WHERE pu.project_id IS NULL
       ";

      $params = ['project_id' => $project_id];
      $db = new Database();
      $stmt = $db->query($query, $params);

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public static function removeMember($project_id, $user_id)
   {
      $query = "DELETE FROM project_users WHERE project_id = :project_id AND user_id = :user_id";
      $params = ['user_id' => $user_id, 'project_id' => $project_id];
      $db = new Database();
      $db->query($query, $params);
   }
   public static function getProgress($project_id)
   {
      $query = "SELECT COUNT(*) AS task_count FROM tasks WHERE project_id = :project_id";
      $params = ['project_id' => $project_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $total = $stmt->fetch()['task_count'];
      $total = $total === 0 ? 1 : $total;
      $query = "SELECT COUNT(*) AS task_count FROM tasks WHERE project_id = :project_id AND status = 'done'";
      $params = ['project_id' => $project_id];
      $db = new Database();
      $stmt = $db->query($query, $params);
      $done = $stmt->fetch()['task_count'];
      return round($done / $total * 100, 2);
   }
}
