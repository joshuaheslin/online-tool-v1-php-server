<?php


include('includes/DbOperation.php');

$response = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['u_email']) && isset($_POST['u_password'])) {
         //echo "hi";
        $db = new DbOperation();
        //echo "hi2";
        if ($db->userLogin($_POST['u_email'], $_POST['u_password'])) {
            $response['error'] = false;
            $response['user'] = $db->getUserIdByEmail($_POST['u_email']);
        } else {
            $response['error'] = true;
            $response['message'] = 'Invalid username or password';
        }

    } else {
        $response['error'] = true;
        $response['message'] = 'Parameters are missing';
    }

} else {
    $response['error'] = true;
    $response['message'] = "Request not allowed";
}

echo json_encode($response);
?>
