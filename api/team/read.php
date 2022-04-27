<?php

// This file defines the operations used to display all manager tuples onto the browser 

// Include the database and object fiels
include_once '../config/database.php';
include_once '../objects/team.php';
include_once '../objects/employee.php';



// Create connection with database


// Create new manager object using the ds connection handle to establish
// a connection with the database


if(!isset($_POST['action']))
{
    return;
}

if($_POST['action'] == "readTeam")
{
    $database = new Database();
    $db = $database->getConnection();
    $team = new Team($db);

    // Retrieve the select all manager statement by calling read() behavior
    $stmt = $team->read();
    
    $num= $stmt->rowCount();
    
    
    // If the number of manager tuples within the table is not zero, print the
    // tuples
    if ($num > 0) {
        // Push all manager tuples into this array
        // Keep fetching rows until there is no rows left to fetch within the table
        // produced by stmt
    
        // Create a manager array to store all attributes of all managers in table
        $team_arr = array();
        $team_arr["team"]=array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row); // take row from table within stmt so that its attributes
                        // can be stored in manager_item
            $team_item = array(
                "team_name" => $team_name,
                "manager_id" => $manager_id,
                "total_members" => $total_members,
            );
            // Add each manageritem to the manager array
            array_push($team_arr["team"], $team_item);
        }
    
        // Print the json encoded version of each row to the browser
        echo json_encode($team_arr["team"]);
    }
    // Otherwise, if no managers tuples in table, print the empty array
    else {
        // Consider adding message along the lines "No tuples to print"
        echo json_encode(array());
    }
}
else if($_POST['action'] == "readEmpByTeamName")
{
    $database = new Database();
    $db = $database->getConnection();
    $employee = new employee($db);
    // Retrieve the select all manager statement by calling read() behavior
    $stmt = $employee->read_by_team_name($_POST['team_name']);
    $num = $stmt->rowCount();
        // check if more than 0 record found
        if($num>0){
         
            // employee array
            $employee_arr=array();
            $employee_arr['employee']=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $employee_item=array(
                    "emp_id" => $emp_id,
                    "name" => $name,
                    "dept_name" => $dept_name,
                    "phone" => $phone,
                    "email" => $email,
                    "salary" => $salary,
                    "start_date" => $start_date,
                );
                array_push($employee_arr["employee"], $employee_item);
            }
            echo json_encode($employee_arr["employee"]);
        }
        else{
            echo json_encode(array());
        }
}



?>




