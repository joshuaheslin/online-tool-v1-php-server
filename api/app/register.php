<?php



//importing required script
include('includes/DbOperation.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyRequiredParams(array('u_email', 'u_password', 'u_first_name', 'u_property_name'), $_REQUEST)) {
        //getting values
        $email = $_POST['u_email'];
        $password = $_POST['u_password'];
        $fname = $_POST['u_first_name'];
        $pname = $_POST['u_property_name'];

        //echo "here";

        //creating db operation object
        $db = new DbOperation();

        //adding user to database
        $result = $db->createUser($email, $password, $fname, $pname);

        //making the response accordingly
        if ($result == USER_CREATED) {
            $response['error'] = false;
            $response['message'] = 'User created successfully';
        } elseif ($result == USER_ALREADY_EXIST) {
            $response['error'] = true;
            $response['message'] = 'User already exists';
        } elseif ($result == USER_NOT_CREATED) {
            $response['error'] = true;
            $response['message'] = 'Some error occurred';
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'Required parameters are missing';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'Invalid request';
}

//function to validate the required parameter in request
function verifyRequiredParams($required_fields, $request_params)
{

    //Looping through all the parameters
    foreach ($required_fields as $field) {
        //if any requred parameter is missing
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {

            //returning true;
            return true;
        }
    }
    return false;
}

echo json_encode($response);
?>
