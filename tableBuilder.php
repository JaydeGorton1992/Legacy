<Style>
  .table {
       display: block;
       background: grey;
       padding: 10 10;  
}  
    
.col {
  display:inline;
 
  width: 125px;
}   

.password, .username
{
 
}   

.row{
  display:inline;
  padding: 10;
  background: red;
}  

.row:nth-child(2n)
{
    background: green;
}

.row:after{

}

.row .password:before {
    content: 'password : ';
}

.row .username:before {
    content: 'username : ';
}


.row .password:after {
    content: '   ';
}

.row .username:after {
    content: '   ';
}
</Style>
<?php
require('metacolumns.php');
/*
class FormHelper
{

    $FormElements = array();
    function create($model, $table, $Type)
    {
        echo '<form id="' . $table . $Type  . 'form" action="action_page.php" method="post">'  
        foreach ($FormElements as $key => $Value) 
        {
                
        }
    }
    
    function end()
    {
        foreach ($FormElements as $key => $Value) 
        {
            echo "<input Type=hidden columnName=" . $Value['columnName'] . " Value=" . $Value['Value'] . ">"
        }
    
        
        echo "</form>"    
    }
    
INSERT INTO `metacolumns`(`databasecolumnName`, `tablecolumnName`, `columncolumnName`, `Type`, `Attribute`, `Value`) 
ValueS ('framework','login','usercolumnName','input','Type','text')
}*/

    $table = "metacolumns";
    $database = "framework";
    $type = false;
    $GValue = getMetaData($table, $database, $type); 
    $Styling = getMetaData($table, $database, 'css'); 
   // echo $Styling[0]['columnName'];
    //$GValue = array(array("Type"=> 'text','columnName'=>"usercolumnName",'Value'=>""), 
   // array("Type"=> 'password', 'columnName'=>"password",'Value'=>""), array("Type"=> 'date', 'columnName'=>"dateTimea",'Value'=>"dateTima"));
    $count = 0;
    
    
    
    $run = true;
    function getElement()
    {
        Global $GValue;
        Global $count;
        Global $Styling;
        Global $run;
        if($count < count($GValue))
        {
 
           echo switchElements($GValue[$count], $Styling);
          
            $count += 1;
        } else {
            $run = false;   
        }
    }
    
    function switchElements($Item, $Style)
    {
        //https://css-tricks.com/almanac/selectors/e/empty/
        
     //   echo $Item['Type'] . " " ;
        $Item['Class'] = (isset($Item['Class']) ? $Item['Class'] : "ItemClass HTMLSTUFF Woah");
        $Item['Type'] = (isset($Item['Type']) ? $Item['Type'] : "");
  
        
        echo "<span class='" . "row" ." " .  $Item['columnName']. "'>". CreateDataRow($Item) . "</span>";
    }
    
    function CreateDataRow($Item)
    {
        return "<div class=col><label class='" . $Item['Type'] . " " . $Item['columnName']. " " . $Item['Type'] . "-" . $Item['columnName'] . "'>" . $Item['Type'] . "</label></div>";  
    }

function startForm()
{
    global $table;
    echo "<div class='table" . " " . $table . "'>"; 
}

function endForm()
{
    echo "</div>";
}

?>
<!-- This form will be replaced with 
formBuilder->createForm("Login", "Framework", "input")
<!php formBuilder->startForm(); !>
    <div id=wrapper>
        <!php formBuilder->createElements(); !>
    </div>
<!php formBuilder->endForm(); !>
--> 

<?php 

startForm();
while ($run) :
?>
<?php
    getElement();
    
?>
<?php
endwhile;
endForm(); 
    
    
    
    
    
    
    
    
    
    
    
    
    
