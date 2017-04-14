<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['uid'])) {
    header('Location: /');
  }
?>  
