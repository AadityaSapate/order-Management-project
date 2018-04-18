<?php
class User 
{   
    //database details
	private $dbHost     = "sql12.freemysqlhosting.net";
    private $dbUsername = "sql12228272";
    private $dbPassword = "NPQyH6cGGs";
    private $dbName     = "sql12228272";
    private $userTbl    = 'porder';
    private $userTb2    = 'pdetails';
    private $userTb3    = 'user';
	
	function __construct()
	{
        
		if(!isset($this->db))
		{
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
			if($conn->connect_error)
			{
                die("Failed to connect with MySQL: " . $conn->connect_error);
			}
			else
			{
                $this->db = $conn;
               
            }
        }
	}
    
   
   
    /**
	 * Inserts user entry into user table.
	 *
	 * @param string $name      username
	 * @param string $email     emailid
	 * @param string $password  password
	 *                              
	 */
    
     function signUp($name,$email,$pass)
    {
    
        $query = "INSERT INTO ".$this->userTb3." (`name`,`email`,`pass`) VALUES ('".$name."','".$email."','".$pass."')";
        
        $result = $this->db->query($query);
        
    }
    
    function fetchPass()
	{
     
        $query = "SELECT * FROM ".$this->userTb3." WHERE `email` = `adisaps8@gmail.com` "  ;

	    $result = $this->db->query($query);
       
    
        $row = $result->fetch_all(MYSQLI_ASSOC);

        return $row; 
    }

     /**
	 * Fetches all the user data in the user table 
	 *
	 * 
	 * @param string $email     emailid of the user whose detail is to be fetched 
	 *
     * @return array    returns user detail present in user table
	 *                              
	 */

    function fetchP($email)
	{
     
        $query = "SELECT * FROM ".$this->userTb3." WHERE `email` = '".$email."' " ;

	    $result = $this->db->query($query);
       
    
        $row = $result->fetch_all(MYSQLI_ASSOC);

        return $row; 
    }

 
     
    /**
	 * Fetches all the order details from porder table
	 *
     * @return array    returns order detail present in user table
	 *                              
	 */ 
     
    function fetch()
	{
     
        $query = "SELECT * FROM ".$this->userTbl." WHERE 1 " ;

	    $result = $this->db->query($query);
       
    
        $row = $result->fetch_all(MYSQLI_ASSOC);

        return $row; 
    }

 


       /**
	 * Fetches all the order detail in the porder table whose quantity is >= given quantity 
	 *
	 * 
	 * @param string $quantity  quantity equal to or above which you want to fetch order 
	 *
     * @return array    returns product details                              
	 */


    function fetchByFilter($quantity)
	{
     
        $query = "SELECT * FROM ".$this->userTbl." WHERE `quantity` > ".$quantity   ;

	    $result = $this->db->query($query);
       
    
        $row = $result->fetch_all(MYSQLI_ASSOC);

        return $row; 
    }
   


     /**
	 * Inserts order details into the porder table 
	 *
	 * 
	 * @param array details about the order containing pName and quantity  
	 *                              
	 */

        
	function order($orderData = array())
    {   
       
        $query = "SELECT * FROM ".$this->userTbl." WHERE `pName` = '".$orderData['pName']."' ";
        $result = $this->db->query($query);  
       
        if(mysqli_num_rows($result)>0)
        {
            $row = $result->fetch_assoc();
              
            $quantity = $row['quantity'] + $orderData['quantity'];
            $query ="UPDATE `porder` SET `quantity` = '".$quantity."' WHERE `pName` = '".$orderData['pName']."' ";   
                   
        }
        else
        {
			$query = "INSERT INTO ".$this->userTbl." (`pName`,`quantity`) VALUES ('".$orderData['pName']."','".$orderData['quantity']."')";
        
        }			
        
        $this->db->query($query);
       
       
    }      
    
     /**
	 * Fetches products price from pdetail table
	 *
	 * 
	 * @param string $prname name of the product  
	 *
     * @return array  product price                              
	 */
 

     function price($prName)
      {
        $query = "SELECT `price` FROM ".$this->userTb2." WHERE `pName` = '".$prName."' ";
        $result = $this->db->query($query);
        
        $row = $result->fetch_assoc();

        return $row;
      }
     


       /**
	 * Fetches products position from pdetail table
	 *
	 * 
	 * @param string $prname name of the product  
	 *
     * @return array  product position                              
	 */

      function position($prName)
      {
        $query = "SELECT `position` FROM ".$this->userTb2." WHERE `pName` = '".$prName."' ";
        $result = $this->db->query($query);
        
        $row = $result->fetch_assoc();

        return $row;
      }
       
       /**
	 * Inserts product detail to pdetail table
	 *
	 * 
	 * @param $array product details                              
	 */

       function insertProduct($pDetail = array())
       {
       
        
            $query = "INSERT INTO ".$this->userTb2." (`pName`,`price`,`position`) VALUES ('".$pDetail['pName']."','".$pDetail['price']."','".$pDetail['position']."')";
            $result = $this->db->query($query);
              
            
        
       }
        

        /**
	 * Update Products price in the pdetail table 
	 *
	 * 
	 * @param $array product name and new price   
	 *                              
	 */
       function updatePrice($pDetail = array())
       {

        $query = "SELECT * FROM `pdetail` WHERE `pName` = '".$pDetail['pName']."' ";
        $result = $this->db->query($query);  
       
        if(mysqli_num_rows($result)>0)
        {
         
            $query = "UPDATE `pdetail` SET `price` = '".$pDetail['price']."' WHERE `pName` = '".$pDetail['pName']."' "; 
           
            $result = $this->db->query($query);        
        }

       }
      

           /**
	 * Update Products position in the pdetail table 
	 *
	 * 
	 * @param $array product name and new position   
	 *                              
	 */
       function updatePosition($pDetail = array())
       {

        $query = "SELECT * FROM ".$this->userTb2." WHERE `pName` = '".$pDetail['pName']."' ";
        $result = $this->db->query($query);  
       
        if(mysqli_num_rows($result)>0)
        {
         
            $query = "UPDATE ".$this->userTb2." SET `position` = '".$pDetail['position']."' WHERE `pName` = '".$pDetail['pName']."' "; 
            $result = $this->db->query($query);        
        }

       } 

   
           /**
	 * Delete product entry from pdetail table  
	 *
	 * 
	 * @param $array product name   
	 *                              
	 */

      function delete($pDetail = array())
       {
			$query = "DELETE FROM  ".$this->userTb2." WHERE `pName` = '".$pDetail['pName']."'"; 
		    $this->db->query($query);
       }
	

}

?>