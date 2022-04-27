<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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


                        
                    

                    </li>
                  </ul>





                    </div>
                    <!-- /.box-body -->
                  </div>
                <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
?>

<!-- Start of page script -->
<script>
function TeamTreeTop(team_name) 
{
    var r = "";
    r += "<a href='#'><i class='fa fa-medkit'></i> <span>" + team_name + "</span></a>"
      +  " <ul class='treeview-menu'>"
      +  " <li><a href='/HR/Team/create.php?team_name=" +team_name + "'>Delete Team</a></li>"
      +  " <li><a href='/HR/Team/create.php?team_name=" +team_name + "'>Add new Member</a></li>"
      +  " <li><li class='treeview'>"
      +  " <a href='#'><i class='fa fa-medkit'></i> <span>Members</span>"
      +  " <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>"   
      +  " </a>"
      +  " <ul id =tree_node_parent_"+ team_name +" class='treeview-menu'></ul></li></li>"
      +  " </ul>"

      var body = document.querySelector("#team_tree");
      $(r).appendTo(body);
    
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
              
                TeamTreeTop(tn);

                var team_content = ""
                

                for(var employee in data2)
                {
                  alert(data2[employee].name);
                  team_content += EmpTreeNode(data2[employee].name,data2[employee].emp_id);
                }

                var body = document.querySelector("#tree_node_parent_" + tn);
                $(team_content).appendTo(body);
              }

          })
        }
      }
      

    });
  });

  // This function takes a parameter named id and updates the database by 
  // removing the manager record with the corresponding id
  function Remove(manager_id){
    var result= confirm("Are you sure you want to delete the Manager Record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/manager/delete.php',
        dataType: 'json',
        data: {
          manager_id: manager_id
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
            alert("Successfully Removed Manager!");
            window.location.href = '/HR/manager';

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