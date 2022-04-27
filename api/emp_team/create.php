<?php 

// This file defines the operations used to create new emp_team tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/emp_team.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new emp_team object using the db connection handle to establish 
// the connection between this object and the db
$emp_team = new Emp_Team($db);

// Set attribute values of emp_team object using information retrieved from
// user input through POST request
$emp_team->emp_id= $_POST['name'];
$manager->phone = $_POST['phone'];
$manager->email = $_POST['email'];



if ($manager->create()){
    // If creation successful, create an array storing the attributes and a
    // status and message describing the fate of the creation
    $manager_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "manager_id" => $manager->manager_id,
        "name" => $manager->name,
        "phone" => $manager->phone,
        "email" => $manager->email
     );
}
// Otherwise, if the manager tuple can not be added (in which case a tuple with
// that email already exists), created an array with a failure status and message
else {
    $manager_arr=array(
        "status" => false,
        "message"=> "Manager with that email already exists!"

    );
}

// Print the array to manager array to screen in json format
print_r(json_encode($manager_arr));

?>