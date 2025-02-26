<!--This is the code which takes the data from the submit.php and display in the main page after echoing the data into the  website-->
<!--CS-385-->
<!--Pujan Pandey-->
<!--Spring 2024-->


<?php
// Include database connection code here

// Retrieve testimonials from the database
// Replace 'your_table' with the actual name of your table
$sql = "SELECT * FROM your_table";
$result = mysqli_query($connection, $sql);

// Display testimonials
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='testimonial'>";
    echo "<p>" . $row['testimonial'] . "</p>";
    echo "<p>- " . $row['name'] . "</p>";
    echo "</div>";
}
?>
