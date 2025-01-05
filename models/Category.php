<?php
class Category
{
   private $name;

   public function __construct($name)
   {
      $this->name = $name;
   }

   public function createCategory()
   {
      $db = new Database();
      $sql = "INSERT INTO categories (name) VALUES (:name)";
      $params = [':name' => $this->name];

      $db->query($sql, $params);
   }

   public function updateCategory($categoryId)
   {
      $db = new Database();
      $sql = "UPDATE categories SET name = :name WHERE id = :id";
      $params = [
         ':name' => $this->name,
         ':id' => $categoryId
      ];

      return $db->query($sql, $params);
   }

   public static function deleteCategory(int $categoryId)
   {
      $db = new Database();
      $sql = "DELETE FROM categories WHERE id = :id";
      $params = [':id' => $categoryId];

      return $db->query($sql, $params);
   }

   public static function getCategories()
   {
      $db = new Database();
      $sql = "SELECT * FROM categories";

      $stmt = $db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
