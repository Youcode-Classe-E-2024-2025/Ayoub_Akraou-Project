<?php
class Member extends User
{
   private $role = 'regular';
   private $tasks;
   public function __construct($name = '', $email = '', $password = '')
   {
      parent::__construct($name, $email, $password);
   }
}
