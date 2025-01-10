<?php
class Manager extends User
{
   private $role = 'manager';
   private $projects;
   public function __construct($name = '', $email = '', $password = '')
   {
      parent::__construct($name, $email, $password);
   }
}
