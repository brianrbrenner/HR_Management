<?php
class Team{

    //==============================//
    // dependencies need to be added 
    // 



 
    // database connection and table name
    private $conn;
    private $table_name = "team";
    private $team_linking_table = "emp_team";

 
    // object properties
    public $team_name;
    public $manager_id;
    public $total_members;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all teams
    function read(){
    
        // select all query
        $query = "SELECT
                    `team_name`, `manager_id`, `total_members`
                FROM
                    " . $this->table_name . " ";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single teams data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `team_name`, `manager_id`, `total_members`
                FROM
                    " . $this->table_name . " 
                WHERE
                    team_name= '".$this->team_name."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create teams
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`team_name`, `manager_id`,`total_members`)
                  VALUES
                        ('".$this->team_name."', '".$this->manager_id."', '0')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update teams 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    team_name='".$this->team_name."', manager_id='".$this->manager_id."', total_members='".$this->total_members."'
                WHERE
                    team_name='".$this->team_name."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete teams
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    team_name= '".$this->team_name."'";
        
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
                team_name='".$this->team_name."'";

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
    function addEmployeeListToTeam($team_name, $employee_list){

        $query = "INSERT INTO 
                    ". $this->team_linking_table ."
                    (`emp_id`,`team_name`) values ";
        $values = " ";

        foreach ($employee_list as $emp_id) {
            $values.= "('".$emp_id."', '".$team_name."'),";
        }
        $values = substr($values, 0, -1);
        $query.= $values;
                
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


#region export 
function getAvailableManager()
{
    // select all query
    $query = "SELECT
    `manager_id`, `name`
    FROM manager ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
}
#endregion


}