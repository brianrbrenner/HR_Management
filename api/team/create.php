<?php 

// This file defines the operations used to create new manager tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/team.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new manager object using the db connection handle to establish 
// the connection between this object and the db
$team = new Team($db);

// Set attribute values of manager object using information retrieved from
// user input thorugh POST request
<<<<<<< Updated upstream
$team->name= $_POST['team_name'];
$team->manager_id= $_POST['manager_id'];
$manager->total_members= $_POST['total_members'];
=======
$team->team_name= $_POST['team_name'];
$team->manager_id = $_POST['manager_id'];
$team->total_members = $_POST['total_members'];
>>>>>>> Stashed changes


// Now that all (except id which is automatically assigned) attributes are
// assigned, create manager object
if ($team->create()){
    // If creation successful, create an array storing the attributes and a
    // status and message describing the fate of the creation
    $team_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "team_name" => $team->team_name,
        "manager_id" => $team->manager_id,
        "total_members" => $team->total_members,
     );
}
// Otherwise, if the manager tuple can not be added (in which case a tuple with
// that email already exists), created an array with a failure status and message
else {
    $team_arr=array(
        "status" => false,
<<<<<<< Updated upstream
        "message"=> "Team with that name already exists!"
=======
        "message"=> "Team already exists!"
>>>>>>> Stashed changes

    );
}

// Print the array to manager array to screen in json format
print_r(json_encode($team_arr));

?>