<?php

class User
{
   // Attributes
   protected string $name;
   protected string $email;
   protected string $password;

   // Database connection
   protected Database $db;

   // Constructor to initialize database connection
   public function __construct($name = '', $email = '', $password = '')
   {
      $this->name = $name;
      $this->email = $email;
      $this->password = $password;
      $this->db = new Database();
   }

   // Method to register a user

   public function register()
   {
      $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
      $result = $this->db->query($query, [
         ':name' => $this->name,
         ':email' => $this->email,
         ':password' => password_hash($this->password, PASSWORD_DEFAULT)
      ]);
      return $result->columnCount() > 0;
   }

   // Method to update user profile
   public function updateProfile($id): bool
   {
      $query = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
      $result = $this->db->query($query, [
         ':name' => $this->name,
         ':email' => $this->email,
         ':password' => password_hash($this->password, PASSWORD_DEFAULT),
         ':id' => $id
      ]);
      return $result->fetch();
   }

   // Method to login a user
   public static function login(string $email, string $password): array
   {
      $db = new Database();
      $query = "SELECT id, email, role, password FROM users WHERE email = :email";
      $stmt = $db->query($query, [':email' => $email]);
      $user = $stmt->fetch();

      if (! $user) {
         return [
            'success' => false,
            'message' => 'can\'t found email address!'
         ];
      }
      if (! Validator::verifyPassword($password, $user['password'])) {
         return [
            'success' => false,
            'message' => 'password incorrect!'
         ];
      }

      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      if ($user['role'] === 'manager') $_SESSION['manager_id'] = $user['id'];

      return [
         'success' => true,
         'message' => 'connected successfully!'
      ];
   }


   // Method to check if a user is logged in
   public static function isLoggedIn(): bool
   {
      return isset($_SESSION['user_id']);
   }

   // Method to log out the user
   public static function logout(): void
   {
      unset($_SESSION['user_id']);
      session_destroy();
   }
   public static function getUsers()
   {
      $query = "SELECT * FROM users";
      $db = new Database();
      $result = $db->query($query);
      return $result;
   }

   // Method to get user details
   public static function getUserDetails(int $id): array
   {
      $db = new Database();
      $query = "SELECT * FROM users WHERE id = :id";
      $stmt = $db->query($query, [':id' => $id]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if (! $user) {
         return [
            'success' => false,
            'message' => 'No user found!'
         ];
      }

      return [
         'success' => true,
         'body' => $user
      ];
   }
   public static function getRole($user_id)
   {
      return self::getUserDetails($user_id)['body']['role'];
   }

   public static function delete($id)
   {
      $db = new Database();
      $query = "DELETE FROM users WHERE id = :id";

      $stmt = $db->query($query, ['id' => $id]);
      return $stmt->rowCount() > 0;
   }
}
