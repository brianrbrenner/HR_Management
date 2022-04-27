<?php
$content = '
            <style>
            </style>
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Employee</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        
                    <div class="form-group">
                        <label for="exampleInputName1">Department</label>
                        <select id = "dept_opt" class="form-select" aria-label="Default select example">
                            <option selected>None</option>
                        </select>                   
                    </div>
                    
                        <div class="form-group">
                          <label for="exampleInputphone">Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Salary</label>
                          <input type="text" class="form-control" id="salary" placeholder="Enter salary">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddEmployee()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
     $(document).ready(function(){
        $.ajax(
            {
                type: "POST",
                url:'../api/employee/create.php',
                dataType: 'json',
                data:{
                    action: "getDept"
                },
                success: function(data){
                    var response = "";
                    for (var dep in data)
                    {
                        response+= 
                        "<option value="+ data[dep].dept_name +">" + data[dep].dept_name + "</option>";
                    }
                    $(response).appendTo($("#dept_opt"));
                }

<<<<<<< Updated upstream
if(isset($_POST["action"]))
{
    $database = new Database();
    $db = $database->getConnection();
    if($_POST["action"] == "getDept")
    {
        
        $department = new Department($db);
        $stmt = $department->read();
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
        $employee->start_date = $_POST['start_date'];

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
=======
            }
        )
 
    
    });

  function AddEmployee(){
        $.ajax(
        {
            type: "POST",
            url: '../api/employee/create.php',
            dataType: 'json',
            data: {
                action: "create",
                name: $("#name").val(),
                department: $("#dept_opt").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),      
                salary: $("#salary").val(),
            },
            error: function (result) {
                alert("heeii");
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Manager!");
                    window.location.href = '/HR_Management/Employee';
                }
                else {
                    alert(result['message']);
                }
>>>>>>> Stashed changes
            }
        });
    }
</script>