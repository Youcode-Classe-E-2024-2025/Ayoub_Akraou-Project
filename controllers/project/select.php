<?php
session_start();
if (isset($_GET['project_id'])) {
   $_SESSION['project_id'] = $_GET['project_id'];
}
header('Location: /');
