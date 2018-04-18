<?php
Include_once 'dbConnect.php';
require 'jwt_helper.php';
$secret_key = 'AdityaSapate26';


if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $headers = getallheaders();
		//print_r($headers);
        if (array_key_exists('Authorization', $headers)) {
            //echo $headers['Authorization'];
			$jwt = $headers['Authorization'];
            $token = JWT::decode($jwt, $secret_key);
            if ($token->exp >= time()) {
            
$totalItems = 0;
$totalAmt = 0;
$Item = array();
$oDetail = new User();
$item = $oDetail->fetchByFilter($_GET['quantity']);
//echo $oDetail->price('Lays Blue');
$i = 0;
foreach($item as $it)
 {  
$totalItems = $totalItems + $it['quantity'] ;
$totalAmt = $totalAmt + $oDetail->price($it['pName'])['price']*$it['quantity'];     
    $Item[$i]['pName'] = $it['pName'];
    $Item[$i]['quantity'] = $it['quantity'];
    $Item[$i]['price'] = $oDetail->price($it['pName'])['price'];

    $i++;
 }


$order = array(
  
    
      'totalItems' => $totalItems,
      'amt' => $totalAmt,
      "Items" => $Item 
   
);

echo json_encode($order);
http_response_code(200);

}
else {
    http_response_code(401);
  
}
} else {
http_response_code(401);


}



}
else 
{
   http_response_code(405);
}
?>