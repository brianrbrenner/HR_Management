<?php

// This file defines the operations used to update the attributes of a doctor
// tuple

// Include the database and object files so that the manager and database objects
// defined within those files can be referenced here
include_once '../config/database.php';
include_once '../objects/team.php';

// Create a database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object, using ds handle to create connection with database
$team = new Team($db);

// Get the new values of this manager's attributes
$team->team_name= $_POST['team_name'];
$team->manager_id= $_POST['manager_id'];
$team->total_members = $_POST['total_members'];

// Update the manager object with the specified values
// If update succeeds, give successful (status, message)
if ($team->update()){
    $team_arr = array(
        "status" => true,
        "message" => "Successfully updated!"
    );
}
// Otherwise, fi update fails, give failure (status, message)
else {
    $team_arr = array(
        "status" => false,
        "message" => "Team name already exists!"
    );
}

// Print the json encoded status, message to browser
print_r(json_encode($team_arr));
?>

