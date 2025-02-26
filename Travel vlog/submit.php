<!--This is the  page which makes a connection  of the website with the database and add blogs to the databaase table named testomonials-->
<!--CS-385-->
<!--Pujan Pandey-->
<!--Spring 2024-->


<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "travel"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $testimonial = $_POST["testimonial"];

    // Prepare SQL statement to insert testimonial
    $sql = "INSERT INTO testimonials (name, testimonial) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $testimonial);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        echo "Testimonial submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
