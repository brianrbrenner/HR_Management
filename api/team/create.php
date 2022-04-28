<?php 

// This file defines the operations used to create new manager tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/team.php';

if(isset($_POST["action"]))
{
    $database = new Database();
    $db = $database->getConnection();
    if($_POST["action"] == "getTeam")
    {
        
        $employee = new employee($db);
        $stmt = $employee->read();
        $num = $stmt->rowCount();
        // check if more than 0 record found
        if($num>0){
         
            // employee array
            $dept_arr=array();
            $dept_arr['dept']=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $dept_item=array(
                    "dept_name" => $dept_name,
                );
                array_push($dept_arr["dept"], $dept_item);
            }
            echo json_encode($dept_arr["dept"]);
        }
        else{
            echo json_encode(array());
        }

    }
}

if(!isset($_POST['action']))return;
else
{
    if($_POST['action'] == 'create')
    {
        $database = new Database();
        $db = $database->getConnection(); 
        $team = new team($db);
        $team->manager_id = $_POST['manager_id'];
        $team->team_name = $_POST['team_name'];
        
        
        
        if($team->create()){
            $team_arr = array(
                "status" => true,
                "message" => "Successfully removed!"
            );
        }
        // Otherwise if failure to delete, create corresponding (status, message) pair
        else {
            $team_arr = array(
                "status" => false,
                "message" => "Manager cannot be deleted; Maybe they are assigned to a patient!"
            );
        }
        print_r(json_encode($team_arr));
    }
    else if($_POST['action'] == 'addEmpToTeam')
    {
        $database = new Database();
        $db = $database->getConnection(); 
        $team = new team($db);
        if($team->addEmployeeListToTeam($_POST['team_name'],$_POST['emp_id_arr'])){
            $team_arr = array(
                "status" => true,
                "message" => "Successfully removed!"
            );
        }
        // Otherwise if failure to delete, create corresponding (status, message) pair
        else {
            $team_arr = array(
                "status" => false,
                "message" => "Manager cannot be deleted; Maybe they are assigned to a patient!"
            );
        }
        print_r(json_encode($team_arr));
    }
}

?>