<?php
class Tag
{
   private $name;
   private $color;

   public function __construct($name, $color)
   {
      $this->name = $name;
      $this->color = $color;
   }

   public function create()
   {
      $db = new Database();
      $sql = "INSERT INTO tags (name, color) VALUES (:name, :color)";
      $params = [':name' => $this->name, ':color' => $this->color];

      $stmt = $db->query($sql, $params);
      return $stmt->rowCount() > 0;
   }

   public function update($tag_id)
   {
      $db = new Database();
      $sql = "UPDATE tags SET name = :name, color = :color WHERE id = :id";
      $params = [
         ':name' => $this->name,
         ':color' => $this->color,
         ':id' => $tag_id
      ];

      $stmt = $db->query($sql, $params);
      return $stmt->rowCount() > 0;
   }

   public static function delete(int $id): bool
   {
      $db = new Database();
      $sql = "DELETE FROM tags WHERE id = :id";
      $params = [':id' => $id];

      $stmt = $db->query($sql, $params);
      return $stmt->rowCount() > 0;
   }

   public static function getTags()
   {
      $db = new Database();
      $sql = "SELECT * FROM tags";

      $stmt = $db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
