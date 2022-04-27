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
    else if($_POST["action"] == "create")
    {
        $employee = new Employee($db);
        $employee->name = $_POST['name'];
        $employee->department = $_POST['department'];
        $employee->phone = $_POST['phone'];
        $employee->email = $_POST['email'];
        $employee->salary = $_POST['salary'];
        $employee->start_date = date('Y-m-d H:i:s');

        // create the doctor
        if($employee->create()){
            $employee_arr=array(
                "status" => true,
                "message" => "Successfully added!",
            
                "name" => $employee->name,
                "department" => $employee->department,
                "phone" => $employee->phone,
                "email" => $employee->email,
                "salary" => $employee->salary,
                "start_date" => $employee->start_date
            );
        }
        else{
            $employee_arr=array(
                "status" => false,
                "message" => "Email already exists!"
            );
            }
        print_r(json_encode($employee_arr));
    }
}
?>
// Create new manager object using the db connection handle to establish 
// the connection between this object and the db
$team = new Team($db);

// Set attribute values of manager object using information retrieved from
// user input thorugh POST request
$team->name= $_POST['team_name'];
$team->manager_id= $_POST['manager_id'];
$manager->total_members= $_POST['total_members'];


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
        "message"=> "Team already exists!"

    );
}

// Print the array to manager array to screen in json format
print_r(json_encode($team_arr));

?>