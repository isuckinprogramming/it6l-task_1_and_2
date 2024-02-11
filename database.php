<?php
  /**
   * @var $connection can be a bool(false) if connection to db failed
   * or an instance of a mysqli connection 
  */
  $connection;

    try {
      $connection = new mysqli("localhost", "root", "", "IT6LDB");
    } catch (Exception $e) {

    $connection = false;
      echo "mysqli connection invalid. something went wrong";
    }

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

    function convertDataToOption($result)
    {

      $rowdata = mysqli_fetch_row($result);
      
      while(  $rowdata !== null ){
        foreach ($rowdata as $key => $value) {
          echo "<option value=$value>$value</option>";
        }
        $rowdata = mysqli_fetch_row($result);
      }
    }
        
