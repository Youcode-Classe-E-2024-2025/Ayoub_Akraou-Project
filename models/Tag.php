<?php
class Tag
{
   private $name;

   public function __construct($name)
   {
      $this->name = $name;
   }

   public function createTag()
   {
      $db = new Database();
      $sql = "INSERT INTO tags (name) VALUES (:name)";
      $params = [':name' => $this->name];

      $stmt = $db->query($sql, $params);
      return $stmt->rowCount() > 0;
   }

   public function updateTag($tag_id)
   {
      $db = new Database();
      $sql = "UPDATE tags SET name = :name WHERE id = :id";
      $params = [
         ':name' => $this->name,
         ':id' => $tag_id
      ];

      $stmt = $db->query($sql, $params);
      return $stmt->rowCount() > 0;
   }

   public static function deleteTag(int $id): bool
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
      return $stmt->fetchAll();
   }
}
