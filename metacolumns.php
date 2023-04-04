<?php

    function CreateConnection($host, $dbname, $user, $password)
    {
        $dbConnection = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, 
        $user,        $password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    
    function getMetaData($table, $database, $type)
	{
		
		
		//retrieve the productID from the URL
		$connection = CreateConnection("localhost", "framework", "root", "");
       // $columns = $connection->query('')->fetchAll();  

        if($type){
		$mysql = "SELECT * FROM metacolumns WHERE databaseName = '$database' AND tableName = '$table' AND Type = '$type'";	
        } else{
        $mysql = "SELECT * FROM metacolumns WHERE databaseName = '$database' AND tableName = '$table'";	    
        }
        
        echo "<br>" .  $mysql . " <br>"; 
        
        		//$sql = 'SELECT * FROM employees';
        //        echo $mysql  . "<p>";
		$statement = $connection->prepare($mysql);
         //Execute the prepared statement
		$result = $statement->execute();
        $result = $statement->fetchAll();
        //echo "<p>" . $sql;
        //use a prepared statement to enhance security
		//$statement = $connection->prepare($sql);
		
        //$statement->bindValue(':tableName', $table);
        //$statement->bindValue(':databaseName', $database);
		//$result = $statement->execute();
		//use the fetch() method to retrieve a single row
		//$result = $statement->fetchAll();
        //Close SQL statement Connection to the server & free up the connection
		$statement->closeCursor();
        
        //echo $result[0][1];
        //echo " AWESOME";
		return $result;
	}


?>