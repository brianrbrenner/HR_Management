<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap-select.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">

<?php
  $content = 
  '<div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                     <h3 class="box-title">Team List List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div  class="box-body">
                  




                  <ul class="sidebar-menu" data-widget="tree">

                    <li id = "team_tree" class="treeview">
                    <li id = "team_tree"><li><button style="width:100%;text-align: left;" type="button" class="btn btn-info"  onClick=redirectToCreate()>Add Employee</button></li></li>
                    </li>
                  </ul>



                  <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title" id = "addEmpTitle">Add Employee To the Team </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                        <div class="modal-body"><div  style="width:100%">
                        <div class="col-md-5">
                        <select id = "adding_emp" class="selectpicker form-control" multiple >
                        
                        </select></div>
                        </div></div>   
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onClick=addEmployeeToTeam() >Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                
                  </div>
                </div>

                    </div>
                    <!-- /.box-body -->
                  </div>
                <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
  
?>
<script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    
    <script src="../js/main.js"></script>
<!-- Start of page script -->

<script>


function redirectToCreate() {
  window.location.href = '/HR_Management/Team/create.php';
}



function TeamTreeTop(team_name,data2) 
{
    var r = "";
    r += "<a href='#'><i class='fa fa-medkit'></i> <span>" + team_name + "</span></a>"
      +  " <ul class='treeview-menu'>"
      +  " <li><li><button style='width:100%;text-align: left;' type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal' onClick=changeCurrentWorkingTeam('"+team_name+"')>Add Employee</button></li></li>"
      +  " <li><a href='#' onClick=RemoveTeam('"+team_name+"')>Delete Team</a></li>"
      +  " <li><li class='treeview'>"
      +  " <a href='#'><i class='fa fa-medkit'></i> <span>Members</span>"
      +  " <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>"   
      +  " </a>"
      +  " <ul id ="+ team_name +" class='treeview-menu'></ul></li></li>"
      +  " </ul>"

      var body = document.querySelector("#team_tree");
      $(r).appendTo(body);


      var team_content = ""
      for(var employee in data2)
      {
        team_content += EmpTreeNode(data2[employee].name,data2[employee].emp_id);
      }

      var body = document.querySelector("#" + tn);
      $(team_content).appendTo(body);
    
}
function EmpTreeNode(emp_name,emp_id)
{

    var r = "";
    r += "<li><li id =" +emp_id + " class='treeview'>"
      +  "<a href='#'> <span>" +emp_name + "</span>"
      +  "<span class='pull-right-container'>"
      +  "<i class='fa fa-angle-left pull-right'></i>"
      +  "</span>"
      +  "</a>"
      +  "<ul class='treeview-menu'>"
      +  "<li><a href='/HR/Team?emp_id=" +emp_id + " '>Details</a></li>"
      +  "<li><a href='/HR/Team/create.php?emp_id=" +emp_id + "'>Remove From Team</a></li>"
      +  "</ul></li></li>"

    return r;
}




  $(document).ready(function(){
    // On document load, perform get request to load all tuples in database
    $.ajax({
      // Type specifies type of request: in this case, we are using a get request
      // to get data from a database
      type: "POST",
      // url of file which specifies how to ge the data
      url: "../api/team/read.php",
      dataType: 'json',
      data:{
          action: "readTeam"
      },
      // upon success, this function creates tuples for each manager in the table 
      // and appends them to the response variable
      success: function(data1) {
        var ar = [];
        var currentIndex = 0;
        for(var team_name in data1){
          var t_n = "";
          t_n = data1[team_name].team_name;
          ar.push(t_n);
          $.ajax({
              type: "POST",
              url: "../api/team/read.php",
              dataType: 'json',
              data:{
                action: "readEmpByTeamName",
                team_name: t_n ,
              },
              success: function(data2)
              {
                var tn = "";
                tn = ar[currentIndex];
                currentIndex += 1;
              
                TeamTreeTop(tn,data2);
              }

          })
        }
      }
      

    });
  });

  // This function takes a parameter named id and updates the database by 
  // removing the manager record with the corresponding id
  function RemoveTeam(team_name){
    var result= confirm("Are you sure you want to delete " +team_name + " record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/team/delete.php',
        dataType: 'json',
        data: {
          team_name: team_name,
        },
        // if POST request fails
        error: function(result) {
          alert(result.responseText);
        },
        // If POST request succeeds
        success: function(result) {
          // if manager record was successfully removed, send message to browser
          // indicating such
          if (result['status'] == true) {
            alert("successfully removed a team");
            window.location.href = '/HR_Management/Team';

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


  var currentWorkingTeam = "";
  function changeCurrentWorkingTeam(newV) {
    alert(newV);
    currentWorkingTeam = newV;
    $.ajax(
      {
        type: "POST",
      url: '../api/employee/read.php',
      dataType: 'json',
      data: {
        action: "readEmpToAdd",
        team_name: currentWorkingTeam,
      },
      success: function(result){
        $(".selectpicker").find("option").remove().end();
        $("#addEmpTitle").append(currentWorkingTeam);
        for(var emp in result)
        {
          $(".selectpicker").append("<option value=" + result[emp].emp_id + ">" +result[emp].name + "</option>");
        }
        $(".selectpicker").selectpicker("refresh")
        
      }

      }
    )

  }
  function addEmployeeToTeam(){
    
    var emp_id_arr = [];
    emp_id_arr =  $('.selectpicker').val();
   
    $.ajax({
      type: "POST",
      url: '../api/team/create.php',
      dataType: 'json',
      data: {
        action: "addEmpToTeam",
        team_name: currentWorkingTeam,
        emp_id_arr: emp_id_arr
      },
      success: function(result){
        alert("Successfully Add Employees to the Team " + currentWorkingTeam);
        window.location.reload();
      }

    });
  }
</script>