<?php
Include_once 'dbConnect.php';
require 'jwt_helper.php';
$secret_key = 'AdityaSapate26';

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //check for header
    $headers = getallheaders();

    //check wether the token exists 
    if (array_key_exists('Authorization', $headers))
    {
       
        $jwt = $headers['Authorization'];
        $token = JWT::decode($jwt, $secret_key);
        //check wether the token is expired or not
        if ($token->exp >= time())
        {

    $obj = json_decode(file_get_contents('php://input'), true);
    
    $product = new User();
    //place orders
    foreach($obj as $ob)
    {
    
        $product->insertProduct($ob);
    }

}
else 
{
   
    http_response_code(401);
    
}

} 
else 
{
http_response_code(401);


}
}

else 
{
   http_response_code(405);
}




?>