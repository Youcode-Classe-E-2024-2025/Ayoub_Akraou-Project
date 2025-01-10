<?php
class Database
{
   public $connection;

   public function __construct($host = 'localhost', $dbname = 'project_management', $username = 'root', $password = '')
   {
      $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
      $this->connection = new PDO($dsn, $username, $password, [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_PERSISTENT => true
      ]);
   }

   public function query($sql, $params = [])
   {
      try {
         $stmt = $this->connection->prepare($sql);
         $stmt->execute($params);
         return $stmt;
      } catch (\Throwable $th) {
         throw new Exception($th->getMessage());
      }
   }

   public function getLastInsertId()
   {
      return $this->connection->lastInsertId();
   }
   public function lastId($table)
   {
      $stmt = $this->query("SHOW TABLE STATUS LIKE :table", ['table' => $table]);
      $lastId = $stmt->fetch(PDO::FETCH_ASSOC)['Auto_increment'];
      return $lastId;
   }
}
