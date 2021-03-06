<?php 

// This file defines the operations used to read a specific employee tuple

// Include the database and object files such that the objects within
// those files can be referenced here
include_once '../config/database.php';
include_once '../objects/employee.php';

// Create database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new employee object, using db connection handle to establish connection
// with our database
$employee = new Employee($db);

// Get the id of the employee whose tuple is to be read
// If the id value has been set (not null or invalid), set the employees
// id equal to the provided id. Otherwise, we there's no matching
// id, so we can't read anything: kill the function with die
$employee->id = isset($_POST['emp_id']) ? $_POST['emp_id'] : die();


// select all employees tuples matching this id
$stmt = $employee->read_single();

// if there is a tuple with matching id, print its attributes to browser
if($stmt->rowCount()>0) {
    // get the selected row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Create an array containing the attributes of the selected tuple
    $employee_arr = array(
        "name" => $row['name'],
        "dept_name" => $row['dept_name'],
        "phone" => $row['phone'],
        "email" => $row['email'],
        //"salary" => $row['salary'],
        "start_date" => $row['start_date']
    );
}

// Print the json encoded employee tuple to browser
print_r(json_encode($employee_arr));

?>