<?php
class Validator
{

   public static function notEmpty($value)
   {
      return !empty(trim($value));
   }

   public static function minLength($value, $min)
   {
      return strlen($value) >= $min;
   }

   public static function maxLength($value, $max)
   {
      return strlen($value) <= $max;
   }

   public static function fullname($fullname)
   {
      // Regex pour valider "nom prenom" en majuscules ou minuscules
      $regex = "/^[a-zA-Z]+ [a-zA-Z]+$/";
      return preg_match($regex, $fullname) === 1;
   }

   public static function email($value)
   {
      $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
      return preg_match($pattern, $value) === 1;
   }

   public static function strongPassword($value)
   {
      // Vérifie au moins une lettre, un chiffre et une longueur de 8 caractères
      return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $value) === 1;
   }

   public static function regex($value, $pattern)
   {
      return preg_match($pattern, $value);
   }

   public static function verifyPassword($password, $hashedPassword)
   {
      return password_verify($password, $hashedPassword);
   }
}
