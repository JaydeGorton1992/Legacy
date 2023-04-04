<?php
    require('metacolumns.php');
    /*
    function CreateConnection($host, $dbname, $user, $password)
{
    $dbConnection = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, 
    $user,        $password);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}
    */

    
    
    function get_describe_row($table, $database)
    {//SHOW COLUMNS FROM login FROM framework;
    
         $connection = CreateConnection("localhost", $database, "root", "");
        $sql = 'SHOW COLUMNS FROM ' . $table . " FROM " . $database ;		
		$statement = $connection->prepare($sql);
		
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
        
        $associated = ""; 
        $max = 0;
        foreach ($result as $key => $value) {
           echo $value[0] . " " . $value[1] . "<br>";
           $associated[$value[0]] = $value[1];
           $explode = explode("(", $value[1]);
           $explode = explode(")", $explode[1]);
           echo "$explode[0] <p>";
           $associated[$value[0]] = $explode[0];
           $max = ($max > $explode[0] ? $max : $explode[0]);
           //echo $associated[$value[0]][2] . " associated <p>";
           echo $associated[$value[0]] . " Example Size " . $value[0];
        }
        
                $percent = count($result) - 1;
                echo " <p>" . $percent . "# of elements % <p> " ;
                foreach ($result as $key => $value) 
        {
                $percent =  (($associated[$value[0]] / $max) * 100);
                echo  "Row " . $value[0] .  " % is " . (($associated[$value[0]] / $max) * 100) . "%<br>"; 
        if($percent >= 75 and $percent >= 50)
        {
            $associated[$value[0]] = "large " . $percent;
        }
        if($percent >= 50 and $percent <= 75)
        {
            $associated[$value[0]] = "medium " . $percent;
        }else
        {
            
        }
                
        }
        echo " <p> MAX POWER " . $max;
        return $associated;
    }
    function get_meta_rows($table, $database)
    {
        
        //echo "ITEMS <br>";
        $columns = getMetaData($table, $database, false);
        $items = '';
        $rowdata = get_describe_row($table, $database);
        for ($i=0; $i <= count($columns) - 1; $i++) {
            
            if($i >= count($columns) - 1)
            {
                
                $items .= " " . $columns[$i]['columnName'] . "";
            } else
            {
            
                $items .= "     " . $columns[$i]['columnName'] . " , ";
            }
        }
       // //echo $items . " before trail<br>";
       
        //echo $items . " after trail <br>";
        
       
        
       

        
        $connection = CreateConnection("localhost", $database, "root", "");
        $sql = "SELECT $items FROM " . $table;
  
  
        $mysql = "SELECT $items FROM metacolumns WHERE databaseName = '$database' AND tableName = '$table'";	    
        //echo $mysql;
        //echo $sql;
        $statement = $connection->prepare($sql);
		 $statement->execute();
		  $result = $statement->fetchAll();
		 $statement->closeCursor();
         //echo count($result) . "<br>";
         echo "<div class=table>";
        for ($j=0; $j <= count($result) - 1;$j++) {
           echo "<div class=row>";
           echo "<input type=submit name='button' " . $j .  ">";
           for ($i=0; $i <= count($result[$j]) / 2 - 1; $i++) 
           {
               ;
           echo "<span class='col " . $columns[$i]['columnName'] . " " .  $rowdata[$columns[$i]['columnName']] . "'>" . $result[$j][$i] . "</span>";
           }
           echo "</div>";
        } 
        echo "</div>";
    }
    
    function get_table_rows($table, $database)
    {      
		$sql = 'SELECT * FROM ' . $table;		
		$statement = $connection->prepare($sql);
		$statement->bindValue(':' . $primary, $rowID);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();

		return $result;  
    }
    
    function get_table_row($table, $database, $rowID)
	{
		
		
		//retrieve the productID from the URL
		$connection = CreateConnection("localhost", $database, "root", "");
        $columns = $connection->query('SHOW COLUMNS FROM ' . $table)->fetchAll();  
        $primary = ""; 
        foreach ($columns as $key => $row) 
        {
            
            ////echo "<p>" .  $row[0] . "<p>";
            
            if(in_array('PRI', $columns[$key]))
            {
                $primary = $row[0];
                break;
            }
        }
        
        if(!strcmp($primary,""))
        {
            //echo "ERROR NO PRIMARY KEY FOUND";
            return false;
        }
        
       // //echo $primary;
        //exit();
		//query the database to select all data from the product table
		$sql = 'SELECT * FROM ' . $table . ' WHERE ' . $primary . ' = :' . $primary;		
		////echo "<p>" . $sql;
        //use a prepared statement to enhance security
		$statement = $connection->prepare($sql);
		$statement->bindValue(':' . $primary, $rowID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetchAll();
        //Close SQL statement Connection to the server & free up the connection
		$statement->closeCursor();
        
        ////echo $result[0][1];
        ////echo " AWESOME";
		return $result;
	}

//delete_table_row("employees", "elogger", 13);

get_meta_rows("metacolumns", "framework");

function generate_css()
{
        
}

echo $xml;
?>
<style>
    
    .row 
    {
        background-color: black;
        margin: auto auto;
        display: inline-block;
        width:100%;
         float: left;
    }
    
    .table{
      
        background: grey;
        background-color: grey;
        display: inline-block;
        width:350px;
        display: block;
         float: left;
              object-fit: cover; 
    }
    
    .row > .large
    {
        display:inline-block !important;
   width: calc(3.125vw + 1.5vh) !important;
          font-size: calc(1vh);
    }
    
     .row > .medium
    {
        display:inline-block !important;
       
        width: calc(5.5vw + 1.5vh) !important;
          font-size: calc(1vh);
    }
    .large 
    {
        width:25% !important;
        color:white;
          display:block;
    }
    
    .medium
    {
        width: 25%  !important;
         color: grey;
         display:block;
    }
    
    .tiny
    {
        width:5%  !important;
         color:green;
    }
    
    .table .col
    {
        display:inline-block;
      width: 100%;
              
    }
    
    .row .col
    {
        display:inline-block;    
    }
    
    .col
    {
        display:inline-block;
        width: auto !important; 
    }
 
    .databaseName
    {
        background: red;
     
      
    }
    
        .tableName
    {
        background: orange;
        
    }
    
        .columnName
    {
        background: green;
      
    }
    
        .Type
    {
        background: blue;

    }
</style>