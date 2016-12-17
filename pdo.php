<?php

class dbConn{

 protected static $db;


  private function __construct() {

   try {
   // assign PDO object to db variable
   self::$db = new PDO( 'mysql:host=sql2.njit.edu;dbname=jg439', 'jg439', 'Q1jq01Pv' );
   self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
   }
   catch (PDOException $e) {
   //Output error - would normally log this to error file rather than output to user.
   echo "Connection Error: " . $e->getMessage();
   }

    }

     // get connection function. Static method - accessible without instantiation
     public static function getConnection() {

      //Guarantees single instance, if no connection object exists then create one.
      if (!self::$db) {
      //new connection object.
      new dbConn();
      }

       //return connection.
       return self::$db;
       }
}
$db = dbConn::getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $db->prepare('SELECT * FROM customers LIMIT 5');
$statement->execute();
while($result = $statement->fetch(PDO::FETCH_OBJ)) {
    $results[] = $result;
}
print_r($results);
?>
