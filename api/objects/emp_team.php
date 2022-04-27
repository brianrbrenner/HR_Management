<?php
class Emp_Team{

    //==============================//
    // dependencies need to be added 
    // 



 
    // database connection and table name
    private $conn;
    private $table_name = "emp_team";
 
    // object properties
    public $emp_id;
    public $team_name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all emp_team tuples
    function read(){
    
        // select all query
        $query = "SELECT
                    `emp_id`, `team_name`
                FROM
                    " . $this->table_name . " ";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single emp_team tuple
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `emp_id`, `team_name`
                FROM
                    " . $this->table_name . " 
                WHERE 
                    team_name= '".$this->team_name."' AND emp_id= '".$this->emp_id."'";  
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create new emp_team tuple
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`emp_id`, `team_name`)
                  VALUES
                        ('".$this->emp_id."', '".$this->team_name."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }
    // May delete later on; I don't think the update() function is needed for 
    // emp_team relation because all emp_team tuples are created or destroyed
    // never partially modified
    // update emp_team tuple
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

    // delete emp_team tuple
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    emp_id= '".$this->emp_id."' AND team_name= '".$this->team_name. "'";
        
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
            emp_id= '".$this->emp_id."' AND team_name= '".$this->team_name. "'";

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
}