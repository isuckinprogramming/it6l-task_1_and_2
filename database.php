<?php
// $server ="localhost";
// $username = "root";
// $password = "";
// $database = "IT6LDB"; //change this with your db name
// require('mysqli');
$connection = new mysqli("localhost", "root", "", "IT6LDB");

if($connection->connect_error) die("Cant connect to database!");
else echo "Database connected!";


    function runQueryAndDisplayTables()
    {
      global $connection;
      $sql_getAllDataFromManagerView = "SELECT * FROM view_manager";

      $result = $connection->query($sql_getAllDataFromManagerView);

      displayTable($result);
    }    



    function displayTable($result) {

    if (!$result) {
      echo "<h3>No result from table</h3>";
      return;   
    }

    $rowdata = mysqli_fetch_row($result);
    // as long as there is a row data the loop continues
    echo "
    <table>
      <tr>
        <th>Employee</th>
        <th>Employee Department</th>
        <th>Manager</th>
        <th>Manager Department</th>
      </tr>";
    while(  $rowdata !== null ){
      
      echo "<tr>";

      foreach( $rowdata as $key => $value ){
          echo "<td>$value</td>" ;
      } 

      echo "</tr>" ;
      $rowdata = mysqli_fetch_row($result);
    }

    echo "</table>";
    }
