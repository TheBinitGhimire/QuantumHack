<?php
/* Medical Response System for Smart City */
$mysqli = new mysqli("34.229.136.128","root","p4ssw0rd","system");

if ($mysqli -> connect_error) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
} 
