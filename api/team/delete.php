<?php

// This files defines the operations used to delete a manager tuple from the table

// Include the dataset and object files so that the objects they define can be used
include_once '../config/database.php';
include_once '../objects/team.php';

// Create new database object
$database = new Database();
// Get handle to connection with this database
$db = $database->getConnection();

// Create new manager object using the ds connection handle to establish 
// connection between database and this object
$team = new Team($db);

// Get the id of the manager tuple to delete
$team->team_name = $_POST['team_name'];

// Remove the corresponding manager tuple
// If remove successful create a (status, message) pair describing
// deletion success
if($team->delete()){
    $team_arr = array(
        "status" => true,
        "message" => "Successfully removed!"
    );
}
// Otherwise if failure to delete, create corresponding (status, message) pair
else {
    $team_arr = array(
        "status" => false,
<<<<<<< Updated upstream
        "message" => "Team cannot be deleted"
=======
        "message" => "Team cannot be deleted."
>>>>>>> Stashed changes
    );
}

// Print the json encoded result of the deletion attempt to browser
print_r(json_encode($team_arr));
?>


