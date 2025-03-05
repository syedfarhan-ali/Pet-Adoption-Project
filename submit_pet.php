<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pet_adoption";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $breed = $_POST["breed"];
    $description = $_POST["description"];
    $image = $_POST["image"];

    $sql = "INSERT INTO pets (name, age, breed, description, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisss", $name, $age, $breed, $description, $image);

    if ($stmt->execute()) {
        echo "Pet added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
