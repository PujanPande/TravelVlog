<!--This is the page which create a form to add blogs in the main front page  of the website-->
<!--CS-385-->
<!--Pujan Pandey-->
<!--Spring 2024-->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php require_once('header.php'); ?>

    <div class="main-content">
        <?php
        // Include database connection code here

        // Retrieve testimonials from the database
        // Replace 'testimonials' with the actual name of your table
        $sql = "SELECT * FROM testimonials";
        $result = mysqli_query($connection, $sql);

        // Display testimonials
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='box'>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['testimonial'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <?php require_once('footer.php'); ?>

</body>
</html>
