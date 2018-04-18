<?php
require 'jwt_helper.php';


function authenticate () {
    $secret_key = 'AdityaSapate26';
    $valid_for = '10000';
	
	
      if ($_SERVER['REQUEST_METHOD'] == "POST") 
    
      {
        $usr = $_POST['email'];
        $pw = $_POST['pass'];
            if ($pw == 'admin' && $usr == 'admin') {
            $token = array();
            $token['id'] = $id;
            $token['exp'] = time() + $valid_for;
            $token = array('token' => JWT::encode($token, $secret_key));
            echo json_encode($token);
			} else 
			{
            http_response_code(401);
       
            }
       } 
      else
	   {
        http_response_code(401);
       }
    }
   
  
		 
?>

    
  