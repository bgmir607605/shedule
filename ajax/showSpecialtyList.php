<?php
require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
};
$query = "set names utf8";
$mysqli->query($query);

$query = "SELECT * FROM specialty";
if ($result = $mysqli->query($query)) {
	while ($row = $result->fetch_assoc()) {
		echo '<option value="'.$row["id"].'">'.$row["code"].'</option>';
	}
   $result->free();
}


$mysqli->close();
?>
