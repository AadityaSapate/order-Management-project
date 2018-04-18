<?php

Include_once 'dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  
     $signUp = new User();

     $signUp->signUp($_POST['name'],$_POST['email'],$_POST['pass']);
     
}







?>