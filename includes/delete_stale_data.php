<?PHP
include "sqlconn.php";
$conn = connect();

//sanitize Variables

$appaccount = mysqli_real_escape_string($conn, $_POST['app_account']);
//$appaccount = "12345";

$sql = "DELETE FROM lockstatus WHERE appaccount='$appaccount'";

if (mysqli_query($conn, $sql)) {
    echo "Succesfully deleted data for $appaccount. Please refresh the page.";
    mysqli_close($conn);
    // header("location:index.php"); //redirect to the main page after sql update successful.
    // exit;
} else {
    echo "Error deleting records";
}


?>