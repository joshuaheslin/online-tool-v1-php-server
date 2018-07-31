<script>
function echoHello(){
 alert("<?PHP foo(); ?>");
}

 // function update_all_names(){
 //   alert("Attemping to update all sql row in table");
 //
 //   var inputs, input, nameText, i;
 //
 //   var names = [];
 //
 //  inputs = document.getElementsByTagName('input');
 //  for (i=0; i<inputs.length; i++) {
 //     input = inputs[i];
 //     if (input.name == "doortext") {
 //         nameText = input.value;
 //         names.push(nameText);
 //         alert(nameText);
 //     }
 //  }
 //  alert(names);
 //
 //  $.ajax({
 //      url:'update_all_row_name.php',
 //      type:'post',
 //      data:names,
 //      success: function(response) {
 //          alert(response);
 //      }
 //  });
 //
 //
 // }

</script>

<!-- <script>
 $(document).ready(function(){
   alert("doc loaded");



 });
</script> -->

<script>
 $(document).ready(function(){
   //alert("page loaded");
       $("button").click(function(){
         //alert("button click");

         if (this.name == 'button_row_save') {

           var id = this.id;
           alert(id);

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

<script>
$(document).ready(function() {
  //alert("doc loaded");
    $('[name="row_spinner"]').hide();
});
</script>

<?php

include "SQL_interface.php";
include "functions.php";

$tokenAuth = TokenAuth(); //3hours

//echo $tokenAuth;

/*
WARNING: This will override ALL 'appaccount' fields in SQL table to the $app_account value set below.
*/
//$urlLocks = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/locks';

//$app_account = 'lock-264-7';
$urlLocks = 'https://lock.ufunnetwork.com/ilocks/api/apps/v1/servers/' . $app_account . '/locks';

$result = CallAPIWithToken("GET", $urlLocks, $tokenAuth, false);
$dataLocks = json_decode($result);
$lockData = $dataLocks->info;


$sqlInterface = new SQLInteface($lockData, $tokenAuth, $app_account);


$sqlInterface->updateLockDataToSQL();

$locks = $sqlInterface->getLockData($app_account);

//echo "loading... locksInterface-2.php";

echo "<table class='table table-responsive table-sm' id='myTable2'>";
echo "<thead>";

echo "<tr>";

//foreach ($infoLocks as $value){
   // $s_LockName = (string)$value-> s_lock_name;
    echo "<th onclick='sortTable(0)'>Door Name        <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick=''>                                                             </th>";
    echo "<th onclick='sortTable(2)'>ID               <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(3)'>Number           <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(4)'>Status           <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(5)'>Signal Strength  <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(6)'>Last Online      <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(7)'>GW1 Name         <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(8)'>Signal Strength  <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(9)'>Last Online      <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick='sortTable(10)'>GW2 Name         <i class='fa fa-fw fa-sort'></i></th>";
    echo "<th onclick=''>Remote Unlock</th>";
    echo "<th onclick=''>Pin Code List</th>";
    echo "<th onclick=''></th>";

   // echo "<button type=". "button" . "class=" . "btn" . ">Basic</button>";

//}

echo "</tr>";
echo "</thead>";

echo "<tbody>";

echo "</tbody>";

foreach ($locks as $value){
    $s_LockNumber = $value->name;
    $s_LocalDoorName = $value->local_door_name;
    $s_LockID = $value->room_number;

    //GW1
    $s_GW1_LockSignalStrength = $value->gateway_1_signal;
    $s_GW1_LockLastScanned = $value->gateway_1_date;
    $s_GW1_LockGWName = $value->gateway_1_id;

    //GW2
    $s_GW2_LockSignalStrength = $value->gateway_2_signal;
    $s_GW2_LockLastScanned = $value->gateway_2_date;
    $s_GW2_LockGWName = $value->gateway_2_id;

    echo "<tr>";
    //$result = $_GET['image'];
    echo "<td><input id='input_$s_LockNumber' type='text' name='doortext' placeholder='i.e Front Door' value='$s_LocalDoorName'></td>";
    echo "<td><button class='btn btn-default btn-sm' id=".$s_LockNumber." name='button_row_save'>Save</button></td>";
    echo "<td>" . $s_LockID . "</td>";
    echo "<td>" . $s_LockNumber . "</td>";

    echo "<td><img src='" . determine_lock_status_colour($s_GW1_LockSignalStrength,$s_GW1_LockLastScanned,$s_GW2_LockSignalStrength,$s_GW2_LockLastScanned) . ".png' height='22' width='22'></td>";

    echo "<td>" . $s_GW1_LockSignalStrength . "</td>";
    echo "<td>" . $s_GW1_LockLastScanned . "</td>";
    echo "<td>" . $s_GW1_LockGWName . "</td>";

    echo "<td>" . $s_GW2_LockSignalStrength . "</td>";
    echo "<td>" . $s_GW2_LockLastScanned . "</td>";
    echo "<td>" . $s_GW2_LockGWName . "</td>";

    echo "<td><button class='btn btn-primary btn-sm' onclick='remote_unlock($s_LockNumber)' id='unlock_".$s_LockNumber."' name='button_row_unlock' ".is_button_hidden($s_GW1_LockSignalStrength,$s_GW1_LockLastScanned,$s_GW2_LockSignalStrength,$s_GW2_LockLastScanned).">Unlock</button></td>";

    //echo "<form method='post' action='pincodes.php'";
    echo "<td><a href='pincodes.php?factory_name=$s_LockNumber&room_id=$s_LockID&door_name=$s_LocalDoorName'><button onclick='showSpinnerForRow($s_LockNumber)' class='btn btn-success btn-sm'  id='pincodes_".$s_LockNumber."' name='button_row_pincodes' ".is_button_hidden($s_GW1_LockSignalStrength,$s_GW1_LockLastScanned,$s_GW2_LockSignalStrength,$s_GW2_LockLastScanned).">Manage</button></a></td>";
    //echo "";

    // $_SESSION['factory_name'] = $s_lockNumber;
    echo "<td><div class='loader' id='spinner_".$s_LockNumber."' name='row_spinner' ".is_button_hidden($s_GW1_LockSignalStrength,$s_GW1_LockLastScanned,$s_GW2_LockSignalStrength,$s_GW2_LockLastScanned)."></div></td>";

}

echo "</table>";
// echo "hi";

echo "<button class='btn-default' hidden>hello</button>";

function is_button_hidden($gw1signal,$gw1date,$gw2signal,$gw2date){

  //return "";

  if ($gw1signal == 0 && $gw2signal == 0){
    return "hidden";
  } else {
    return "";
  }
}

function determine_lock_status_colour($gw1signal,$gw1date,$gw2signal,$gw2date){
  if ($gw1signal == 0 && $gw2signal == 0){
    return "red";
  } else {
    return "green";
  }
}


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

function showSpinnerForRow(id){
  //lert("show spinner");

  $("button").click(function() {
    var id = this.id;
    var res = id.split("_");
    var factory_name = res[1];
    //alert(factory_name);
    var spinner_id = '#spinner_'+factory_name;
    //alert(spinner_id);

    $(spinner_id).show();

  });

  //showing all spinners
  //$('[name="row_spinner"]').show();

}

function remote_unlock(id) {

  //alert(id);
  //alert("Attempting to unlock");

  $("button").click(function(){
       var id = this.id;
       var res = id.split("_");
       var factory_name = res[1];

       alert("Attempting to unlock " + factory_name);

       var spinner_id = '#spinner_'+factory_name;
       //alert(spinner_id);

       $(spinner_id).show();

       //showSpinnerForRow(id);

       //alert(factory_name);
       //why does this function repeat if clicked more than once for each page load?
  });

}

</script>


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
