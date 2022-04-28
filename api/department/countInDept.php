<?php

// This file defines the operations used to display all employee tuples onto the browser 

// Include the database and object fiels
include_once '../config/database.php';
include_once '../objects/employee.php';



// Create connection with database
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new employee object using the ds connection handle to establish
// a connection with the database
$employee = new employee($db);
// Retrieve the select all employee within the given department

if(isset($_POST["action"]))
{

    if($_POST["action"] == "findEmployeesinDept")
    {
        // Store department name
        $department_name = $_POST['department_name'];

        // Execute SQL with department name
        $num= $employee->count_emp_in_dept($department_name);

        //$num = $stmt;
        //echo json_encode($num);
         
        $response=array(
            "status" => true,
            "message" => "Successfully Invoked Function",
            "num" => $num
        );

        print_r(json_encode($response));
       
        
    }
    
}

?>