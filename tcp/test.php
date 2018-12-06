<?php


echo "<h2>TCP/IP Connection</h2>\n";

$hex = "019B094500001E";


$hex = pack("H*" , $hex);
$i = strlen($hex); //Length is 720 but it may differ
$byte_array = unpack("C*", pack("L", $i));
array_push($byte_array,hexdec(1)); //I add an extra byte '1' as a message type


echo $byte_array;
$service_port = 10003;
$address = gethostbyname('27.113.241.146');

    echo "Creating socket for '$address' on port '$service_port'...<br>";
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

    if ($socket === false) {
        echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "<br>";
    } 
    echo "Attempting to connect to '$address' on port '$service_port'...<br>";
    $result = socket_connect($socket, $address, $service_port);
    if ($result === false) {
        echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "<br>";
    }

//Send 5 bytes which is 4 bytes that converts to an Int, 1 byte that is the message type
socket_write( $socket, $byte_array);
print_r($byte_array);
//Send the actuall message
socket_write( $socket, $hex);

?>