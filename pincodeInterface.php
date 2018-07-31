<script>
function echoHello(){
 alert("<?PHP foo(); ?>");
}
</script>

<script>
 $(document).ready(function(){
   //alert("page loaded");
       $("button").click(function(){
         //alert("button click");

         if (this.name == 'button_row') {

           var id = this.id;
           //alert(id);

           var inputText;
           input = document.getElementById('input_' + this.id);
           inputText = input.value;
           //alert(inputText);

           rowData = {
               lock_name: id,
               lock_text: inputText
           };

           $.ajax({
               url:'update_row_name.php',
               type:'post',
               data:rowData,
               success: function(response) {
                   alert(response);
               }
           });

         }

       });

 });

</script>


<?php

include "SQL_interface.php";
include "functions.php";

$tokenAuth = TokenAuth(); //3hours

//echo $tokenAuth;


$sqlInterface = new SQLInteface($lockData, $tokenAuth, $app_account);

//$sqlInterface->updateLockDataToSQL();

$locks = $sqlInterface->getLockData($app_account);

echo "<br>";
echo "<h4>Lock Details</h4>";

// echo "<br>$$<br>";
// $varme = $_SESSION['factory_name'];
// echo $varme;
// echo "<br>$$<br>";

echo "<table class='table table-bordered table-sm table'>";
  echo "<thead>";
    echo "<tr>";
      echo "<th scope='col'>Door Name</th>";
      echo "<th scope='col'>Door Number</th>";
      echo "<th scope='col'>Factory Name</th>";
      // echo "<th scope='col'>Last online</th>";
    echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
    echo "<tr>";
      echo "<td>". $_GET['door_name'] ."</td>";
      echo "<td>". $_GET['room_id'] ."</td>";
      echo "<td>". $_GET['factory_name'] ."</td>";
      // echo "<td>Monday 16th May 2018</td>";
    echo "</tr>";
  echo "</tbody>";
echo "</table>";

// echo "<br>";

// echo "<h4>Create New Pin Code</h4>";

echo "<button class='btn btn-primary' id='pincode_".$s_LockNumber."' name='create_pincode' >Create new pincode</button>";

echo "<br><br>OR<br><br>";

echo "<code>onlinetool.kas.com.au/api/pincode/startDate/endDate</code>";

echo "<br><br>";

echo "<table class=" . "table table-bordered" . " id=" . "myTable2" . ">";
echo "<thead>";
echo "<tr>";

    echo "<th onclick=''>No                             <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick=''>Remark                         <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(2)'>Start Date         <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(3)'>End Date           <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick=''>One Time                       <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick=''>Pin Code                       <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(6)'>Cancel Pin Code      </th>";
    echo "<th onclick=''>Status      </th>";

echo "</tr>";
echo "</thead>";

echo "<tbody>";

echo "</tbody>";

foreach ($locks as $value){

    echo "<tr>";
    //$result = $_GET['image'];

    echo "<td>1</td>";
    echo "<td>Josh Heslin</td>";
    echo "<td>Date Start</td>";
    echo "<td>Date End</td>";
    echo "<td>No</td>";
    echo "<td>123456</td>";
    echo "<td><button id='' name=''>Cancel</button></td>";
    echo "<td>spinner</td>";


}

echo "</table>";



function foo(){
    echo "<p>hallo</p>";
}

// function update_sql_row(){
//   //echo 'row updated successfully';
//
//   //$sqlInterface = new SQLInteface();
//
//   //$valueToUpdate = "front door 22";
//   //$lockName = "UL002077";
//
//   //$did_update = $sqlInterface->did_update_local_name_to_sql($valueToUpdate,$lockName);
//
//   $sql_update = "UPDATE lockstatus SET local_door_name='frontdoor2' WHERE lock_name='UL002870'";
//
//   if ($conn->query($sql_update) === TRUE) {
//       //echo "<br>Record updated successfully";
//       //return TRUE;
//   } else {
//       //echo "Error: " . $sql_update . "<br>" . $this->conn->error;
//       //return FALSE;
//   }
//
//   //return TRUE;
//
//   // $did_update = FALSE;
//   //
//   // if($did_update){
//   //   //echo "Name saved successfully";
//   // }else{
//   //   //echo "Save failed";
//   // }
//
//   return "";
//
// }

?>

<script>

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


<!-- <button onclick="update_all_names()">Save all names</button> -->
