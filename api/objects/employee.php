<?php
class Employee{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee";
    private $team_linking_table = "emp_team";
    
 
    // object properties
    public $id;
    public $name;
    public $department;
    public $phone;
    public $email;
    public $salary;
    public $start_date;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all employees with salary information
    function read_with_salary(){
        $query = "SELECT
            `emp_id`,`name`, `dept_name`, `phone`,`email`, `salary`, `start_date`
        FROM
            ".$this->table_name."
        ORDER BY
            emp_id DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
        $stmt->execute();
        return $stmt;
    }


    // read all employees without salary information
    // This relies on the employeeRedacted view, a view of employee without
    // the salary attribute
    function read(){
        $query = "SELECT
            `emp_id`,`name`, `dept_name`, `phone`,`email`, `start_date`
        FROM
            employeeRedacted
        ORDER BY
            emp_id DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
        $stmt->execute();
        return $stmt;
    }

    // get single employee data without salary information
    function read_single(){
    
        // select all employees from view containing no salary attribute
        $query = "SELECT
                    `emp_id`, `name`, `dept_name`, `phone`,`email`, `start_date`
                FROM
                    employeeRedacted
                WHERE
                    emp_id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }
    // Find all teams an employee belongs to
    function read_by_team_name($tn)
    {
        $query = "SELECT
            *
            FROM
                " . $this->table_name . " JOIN ". $this->team_linking_table ." ON " . $this->table_name . ".emp_id = ". $this->team_linking_table .".emp_id
             WHERE ". $this->team_linking_table .".team_name =  '".$tn."'";
    
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;

    }


      // Select all employees within the given department
      // This uses parameter binding to protect against SQL injection
      function read_by_dept_name($department_name)
      {
        $query = "SELECT
                `emp_id`,`name`, `dept_name`, `phone`,`email`, `start_date`
            FROM
                " .$this->table_name."
            WHERE
                dept_name LIKE '%".$department_name."%'

            ORDER BY
                emp_id DESC";
      
      
          // prepare query statement
          $stmt = $this->conn->prepare($query);
        
          // execute query
          $stmt->execute();
          return $stmt;
  
      }

        // Returns the number of employees in the given department
      function count_emp_in_dept($department_name)
      {
        $query = "SELECT countEmployeesInDept('".$department_name."')";
      
      
          // prepare query statement
          $stmt = $this->conn->prepare($query);
        
          // execute query
          $stmt->execute();
          return $stmt;
  
      }

    // create employee
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `dept_name`, `phone`,`email`,`salary`,`start_date`)
                  VALUES
                        ('".$this->name."', '".$this->department."', '".$this->phone."', '".$this->email."', '".$this->salary."', '".$this->start_date."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update employee 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', dept_name='".$this->department."', phone='".$this->phone."', email='".$this->email."', salary='".$this->salary."', start_date='".$this->start_date."'
                WHERE
                    emp_id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete employee
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    emp_id= '".$this->id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    function readAddableEmp($team_name)
    {
        $query = "SELECT *
        FROM employee 
        WHERE emp_id 
        NOT IN (
            SELECT emp_team.emp_id 
            FROM emp_team 
            where emp_team.team_name= '".$team_name."')";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}