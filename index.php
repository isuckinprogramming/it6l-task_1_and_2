<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Week 4 Task 4
  </title>
  <link rel="stylesheet" href="style.css">
</head>
<body>  

  <form action="index.php" method="post" id="myform">
    <h4>Employee Credentials</h4>
    <h6>First name</h6>
    <input type="text" name="employee_firstname">
    <h6>Last name</h6>
    <input type="text" name="employee_lastname">
    <h6>Manager Id</h6>
    <select name="manager_id">
      <?php
        require("database.php");

        $query = "SELECT employee_id FROM employees;";
        $result = $connection->query($query);

        convertDataToOption($result);
      ?>
    </select>
    <h6>Department Id</h6>
    <select name="department_id">
      <?php
        $query = "SELECT department_id FROM departments;";
        $result = $connection->query($query);

        convertDataToOption($result);
      ?>
    </select>
    <br>
    <input type="submit">
  </form>

  <?php 
    
    runQueryAndDisplayTables();
    // Warning messages cannot be caught by try-catch, so error handler will be set to a 
    // Blank function to prevent anything from being loaded
    set_error_handler(function() { /* ignore errors */ });

    try{
        $fname = $_POST['employee_firstname'];
        $lname = $_POST['employee_lastname'];
        $manager_id = $_POST['manager_id'];
        $department_id = $_POST['department_id'];

        $sql_dummyEmployeeInsert = 
        "INSERT INTO 
          employees(first_name, last_name,manager_id, department_id)
        VALUES( 
          '$fname',
          '$lname',
          $manager_id,
          $department_id
        ); ";

        // I don't know how a debugger works in php so this is how I will try 
        // to debug errors and monitor variable status during runtime  
        // echo $sql_dummyEmployeeInsert;
  


        try {
          $queryResult = $connection->query($sql_dummyEmployeeInsert);

          // Important to only reload if query is successful to avoid infinite reload
          if ($queryResult) {
            // Will redirect the page through js cause I don't know how to 
            // implement the functionality using php, the url may break if the file 
            // name is renamed
            echo '
              <script>
                window.location.href = "index.php";
              </script>'; 
          }
        }
        catch(Exception $e){
          echo "something went wrong";
        }

      // restore error handler after ignoring the warning message trigger
      restore_error_handler();
    }
    catch(Exception $e){
      // No code here, don't display anything yet
      echo $e;
    }
  ?>
</body>
</html>