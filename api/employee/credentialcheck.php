<?php 

// This file defines the operations used to create new manager tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/employee.php';
include_once '../objects/department.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new employee object using the db connection handle to establish 
// the connection between this object and the db

// Set attribute values of employee object using information retrieved from
// user input thorugh POST request

if(isset($_POST["action"]))
{

    if($_POST["action"] == "credential_check")
    {
        // Store credentials
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check credentials.
        if ($username == "hacker" and $password == "password") {
            $credentialsMatched = true;
        }
        else {$credentialsMatched = false;}
        print_r(json_encode($credentialsMatched));

    }
    
}
?>