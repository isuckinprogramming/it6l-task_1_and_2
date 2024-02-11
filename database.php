<?php
// $server ="localhost";
// $username = "root";
// $password = "";
// $database = "IT6LDB"; //change this with your db name
// require('mysqli');
$connection = new mysqli("localhost", "root", "", "IT6LDB");

if($connection->connect_error) die("Cant connect to database!");
else echo "Database connected!";

// DEMO MYSQL COMMANDS 
$sql_getAllDataFromManagerView = "SELECT * FROM view_manager";

    function runQueryAndDisplayTables()
    {
      global $connection,$sql_getAllDataFromManagerView;
        
      $result = $connection->query($sql_getAllDataFromManagerView);

      displayTable($result);
    }    



    function displayTable( $selectStatement ) {

    global $connection;
    $result = $connection->query($selectStatement);

    if (!$result) {
      echo "<h3>No result from table</h3>";
      return;   
    }

    $rowdata = mysqli_fetch_row($result);
    // as long as there is a row data the loop continues
    echo "
    <table>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>short description</th>
        <th>full description</th>
        <th>price</th>
        <th>created at</th>
        <th>updated at</th>
      </tr>";
    while(  $rowdata !== null ){
      
      echo "<tr>";

      // $valCount = count($rowdata);
      // for( $i = 0; $valCount < $i; $i++ ){
      // echo "<td>$rowdata[$i]</td>" ;
      // } 

      foreach( $rowdata as $key => $value ){
          echo "<td>$value</td>" ;
      } 

      echo "</tr>" ;
      $rowdata = mysqli_fetch_row($result);
    }

    echo "</table>";
    }
