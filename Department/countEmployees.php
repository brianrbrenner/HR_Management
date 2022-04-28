<?php
// This file defines the content and operation of the page which uses the
// countEmployeesInDept() to determine the number of employees in the 
// department specified by the user
// Define the content which is displayed within the master.php file
  $content = '<div>
                <p class="p1">Find Number of Employees in Department</p>
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search by Department Name">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>';

  include('../master.php');
?>

<!-- Start of page script -->
<script>


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
</script>