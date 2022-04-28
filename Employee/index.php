<?php
// Define the content which is displayed within the master.php file

  $content = '      <p class="p2">Search Employees by Department:</p>
                    <div class="input-group">
                      <input type="text" name="q" class="form-control" id="department_name" placeholder="Enter Department...">
                         <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat" onClick="searchByDept()"><i class="fa fa-search"></i>
                            </button>
                          </span>
                      </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Employee List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <table id="employee" class="table table-bordered table-hover">
                          <thead>
                            <tr> 
                              <th>ID</th>
                              <th>Name</th>
                              <th>Department name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Start day</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Start day</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                <!-- /.box -->
                </div>
                <button class="button-30" role="button"><a href="/HR_ManagementEmployee/adminform.php">View Employee Salaries</button>
                
              </div>';
              
  include('../master.php');
?>

<!-- Start of page script -->
<script>
  $(document).ready(function(){
    // On document load, perform get request to load all tuples in database
    $.ajax({
      // Type specifies type of request: in this case, we are using a get request
      // to get data from a database
      type: "POST",
      // url of file which specifies how to ge the data
      url: "../api/employee/read.php",
      dataType: 'json',
      data:{action: "read"},
      // upon success, this function creates tuples for each manager in the table 
      // and appends them to the response variable
      success: function(data) {
        var response="";
        for(var user in data){
          response += 
                "<tr>"+
                "<td>"+data[user].emp_id+"</td>"+
                "<td>"+data[user].name+"</td>"+
                "<td>"+data[user].dept_name+"</td>"+
                "<td>"+data[user].phone+"</td>"+
                "<td>"+data[user].email+"</td>"+
                "<td>"+data[user].start_date+"</td>"+
                "<td><a href='update.php?id="+data[user].emp_id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].emp_id+"')>Remove</a></td>"+
                "</tr>";
                console.log(data[user].emp_id);

        }
        // appends the response to the the table whose id=employee
        $(response).appendTo($("#employee"));
      }

    });
  });
  
  // This function takes a parameter named id and updates the database by 
  // removing the employee record with the corresponding id
  function Remove(id){
    var result= confirm("Are you sure you want to delete this Employee Record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/employee/delete.php',
        dataType: 'json',
        data: {
          id: id
        },
        // if POST request fails
        error: function(result) {
          alert(result.responseText);
        },
        // If POST request succeeds
        success: function(result) {
          // if employee record was successfully removed, send message to browser
          // indicating such
          if (result['status'] == true) {
            alert("Successfully Removed Employee!");
            window.location.reload();

          }
          // Otherwise, if it could not be deleted, print the message contained within
          // the deletion failure message
          else {
            alert(result['message']);
          }
        }
      });
    }
  }


  // This function takes the department name input by the user through the search bar and 
  // creates a Get request with it
  function searchByDept(){
    $.ajax(
            {
                type: "POST",
                url:'../api/employee/readByDept.php',
                dataType: 'json',
                data:{
                    action: "employeeByDept",
                    department_name: $("#department_name").val(),
                },
                error: function (result) {
                    alert("Error");
                },
                // upon success, this function creates tuples for each employee in the table 
                // and appends them to the response variable
                success: function(data) {
                    var response="";
                    console.log("testing");
                    for(var user in data){
                      
                       response += 
                        "<tr>"+
                          "<td>"+data[user].emp_id+"</td>"+
                          "<td>"+data[user].name+"</td>"+
                          "<td>"+data[user].dept_name+"</td>"+
                          "<td>"+data[user].phone+"</td>"+
                          "<td>"+data[user].email+"</td>"+
                          "<td>"+data[user].start_date+"</td>"+
                          "<td><a href='update.php?id="+data[user].emp_id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].emp_id+"')>Remove</a></td>"+
                        "</tr>";

        }
        // appends the response to the the table whose id=employee

        var body = document.querySelector("#employee").querySelector("tbody");
        body.innerHTML = response;
      }

    });
 
    
}

</script>