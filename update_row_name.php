<?PHP
include("sqlconn.php");
$conn = connect('localhost','user','','mydb');

//sanitize Variables
$lockName = mysqli_real_escape_string($conn, $_POST['lock_name']);
$lockText = mysqli_real_escape_string($conn, $_POST['lock_text']);

$sql = "UPDATE lockstatus SET local_door_name='$lockText' WHERE lock_name='$lockName'";

if (mysqli_query($conn, $sql)) {
    echo "Succesfully updated lock name: $lockText for $lockName";
    mysqli_close($conn);
    //header("location:index.php"); //redirect to the main page after sql update successful.
    //exit;
} else {
    echo "Error updating record";
}


?>
