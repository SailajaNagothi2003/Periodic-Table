<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "periodictableproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "SELECT  Element, Symbol,AtomicMass,Type FROM periodic_table_of_elements WHERE AtomicNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $element = $result->fetch_assoc();
    echo json_encode($element);
} else {
    echo json_encode(array("error" => "No data found"));
}

$stmt->close();
$conn->close();
?>
