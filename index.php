<?php echo "Hello World!"; ?>
<?php
$servername = "localhost";
$username = "web_user";
$password = "Heba2020";
$dbname = "web_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$visitor_ip = $_SERVER['REMOTE_ADDR'];
$current_time = date("Y-m-d H:i:s");

echo "Hello, visitor from IP: $visitor_ip<br>";
echo "Current server time: $current_time";

$conn->close();
?>
