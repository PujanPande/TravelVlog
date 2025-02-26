<!--This is the main page of the website-->
<!--CS-385-->
<!--Pujan Pandey-->
<!--Spring 2024-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Hub</title>
    <link rel="stylesheet" href="styles.css">


</head>
<body>

    <?php require_once('header.php'); ?>

    <div class="main-content">
        <div id="page1">
            <h1>Our Travel Destinations</h1>
            <div class="boxes-container">
                <div class="box">
                    <img src="images/image1.jpg" alt="Image 1">
                    <h2>Title 1</h2>
                    <p>Description 1 Beautiful Lake</p>
                    <button class="btn">Learn More</button>
                </div>
                <div class="box">
                    <img src="images/image2.jpg" alt="Image 2">
                    <h2>Title 2</h2>
                    <p>Description 2 Beautiful Architeture.</p>
                    <button class="btn">Learn More</button>
                </div>
                <div class="box">
                    <img src="images/image3.jpg" alt="Image 3">
                    <h2>Title 3</h2>
                    <p>Description 3 Beautiful Scenery.</p>
                    <button class="btn">Learn More</button>
                </div>
                <!-- Add more boxes as needed -->
            </div>
        </div>



        <div id="page2" style="display: block;">
            <h1>Blogs</h1>
            <div class="boxes-container">
                <!-- Testimonial boxes from database -->
                <!-- Display testimonials -->
                <?php
                // Include database connection code here
                $servername = "localhost"; // Change this if your database is hosted elsewhere
                $username = "root"; // Change this to your MySQL username
                $password = ""; // Change this to your MySQL password
                $database = "travel"; // Name of your database

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Retrieve testimonials from the database
                $sql = "SELECT * FROM testimonials";
                $result = mysqli_query($connection, $sql);

                // Display testimonials
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='box'>";
                    echo "<h2>" . $row['name'] . "</h2>";
                    echo "<p>" . $row['testimonial'] . "</p>";
                    echo "</div>";
                }

                // Close connection
                $connection->close();
                ?>
                <!-- End of testimonial boxes from database -->
            </div>

            <!-- Add testimonial form -->
            <div class="testimonial-form-container">
                <h2>Add  Blogs</h2>
                <button class="btn" onclick="showForm()">Add  Blogs</button>
                <div id="testimonial-form" style="display: none;">
                    <form id="addTestimonialForm" class="testimonial-form" onsubmit="return reloadPage()">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="testimonial"> Blogs:</label><br>
                        <textarea id="testimonial" name="testimonial" rows="4" required></textarea><br><br>
                       <input type="submit" value="Submit" class="btn"></a> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('footer.php'); ?>

    <script>

        function showForm() {
            document.getElementById('testimonial-form').style.display = 'block';
        }

        document.getElementById('addTestimonialForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Collect form data
            var formData = new FormData(this);

            // Send form data to the server using fetch API
            fetch('submit.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Handle successful form submission
                // For example, update the page content to display the newly added testimonial
                // Here you can reload the testimonial list or update it with AJAX
               window.location.href='index.php';
                // You can reload the page or update the testimonials list dynamically
                // window.location.reload(); // Reload the page
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
            function reloadPage()
             {
                setTimeout(function(){ location.reload(); }, 100); // Reloads the page after 1 second (1000 milliseconds)
                return true; // Allow form submission
             }
        });
    </script>

</body>
</html>
