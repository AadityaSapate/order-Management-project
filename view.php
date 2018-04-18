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
// array storing order details
$Item = array();

$oDetail = new User();
//fetch order details from porder table 
$item = $oDetail->fetch();


$i = 0;
foreach($item as $it)
 {  
 //calculate totla items    
$totalItems = $totalItems + $it['quantity'] ;
 //calculate total amount
$totalAmt = $totalAmt + $oDetail->price($it['pName'])['price']*$it['quantity'];     
    $Item[$i]['pName'] = $it['pName'];
    $Item[$i]['quantity'] = $it['quantity'];
    $Item[$i]['price'] = $oDetail->price($it['pName'])['price'];
    $Item[$i]['position'] = $oDetail->position($it['pName'])['position'];
    $i++;
 }

$order = array(
  
    
      'totalItems' => $totalItems,
      'amt' => $totalAmt,
      "Items" => $Item 
   
);


echo json_encode($order);

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