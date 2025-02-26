<!--This is the header page of the website-->
<!--CS-385-->
<!--Pujan Pandey-->
<!--Spring 2024-->


<?php
// Start or resume session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set session timeout period (in seconds)
$session_timeout = 300; // 5 minutes

// Regenerate session ID if not already regenerated
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}

// Check last activity time and logout if session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // Expired session, destroy session and force logout
    session_unset();
    session_destroy();
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration
if(isset($_POST['register'])) {
    $reg_username = $_POST['reg_username'];
    $reg_password = $_POST['reg_password'];

    // Hash the password for security
    $hashed_password = password_hash($reg_password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $reg_username, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User does not exist!";
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>
<header>
    <div class="container">
        <div class="logo">Travel Hub</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#page2">Review</a></li>
            </ul>
        </nav>
        <div class="login-container">
            <?php
            // Check if user is already logged in
            if (isset($_SESSION['username'])) {
                // User is logged in, show user profile and logout button
                echo '<div class="user-profile">Welcome, ' . $_SESSION['username'] . '</div>';
                echo '<form action="logout.php" method="post"><button type="submit">Logout</button></form>';
            } else {
                // User is not logged in, show login and registration forms
                echo '<div id="login-form">';
                echo '<form action="" method="post">';
                echo '<input type="text" name="username" placeholder="Username" required>';
                echo '<input type="password" name="password" placeholder="Password" required>';
                echo '<button type="submit" name="login">Login</button>';
                echo '</form>';
                echo '<div class="register-text">Don\'t have an account? <a href="#" id="show-register">Register here!</a></div>';
                echo '</div>';
                
                echo '<div id="register-form" style="display: none;">';
                echo '<form action="" method="post">';
                echo '<input type="text" name="reg_username" placeholder="Username" required>';
                echo '<input type="password" name="reg_password" placeholder="Password" required>';
                echo '<button type="submit" name="register">Register</button>';
                echo '</form>';
                echo '<div class="login-text">Already have an account? <a href="#" id="show-login">Login here!</a></div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Show registration form
        $('#show-register').click(function(e) {
            e.preventDefault();
            $('#login-form').hide();
            $('#register-form').show();
        });

        // Show login form
        $('#show-login').click(function(e) {
            e.preventDefault();
            $('#login-form').show();
            $('#register-form').hide();
        });
    });
</script>
