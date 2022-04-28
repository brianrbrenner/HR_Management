<?php
// This file defines the content and operation of the page which uses the
// countEmployeesInDept() to determine the number of employees in the 
// department specified by the user
// Define the content which is displayed within the master.php file
  $content = '<div>
                <p class="p1">Find Number of Employees in Department</p>
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" id="department_name" placeholder="Enter Department Name...">
                          <span class="input-group-btn">
                              <button type="submit" name="search" id="search-btn" class="btn btn-flat" onClick="searchByDept()"><i class="fa fa-search"></i>
                              </button>
                          </span>
                    </div>
                </form>
            </div>';

  include('../master.php');
?>

<!-- Start of page script -->
<script>

 // This function takes the department name input by the user through the search bar and 
  // creates a Get request with it
  function searchByDept(){
    $.ajax(
            {
                type: "POST",
                url:'../api/department/countInDept.php',
                dataType: 'json',
                data:{
                    action: "findEmployeesinDept",
                    department_name: $("#department_name").val(),
                },
                error: function (result) {
                    alert("Error");
                },
                // upon success, this function creates tuples for each employee in the table 
                // and appends them to the response variable
                success: function(data) {
                    console.log(data.num);
                    
        // appends the response to the the table whose id=employee

      }

    });
 
    
}
</script>